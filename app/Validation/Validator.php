<?php

namespace App\Validation;

use App\Http\Request;

class Validator {
    private Request $request;
    private array $rules;
    private array $errors = [];
    private array $data = [];

    public function __construct(Request $request, array $rules) {
        $this->request = $request;
        $this->rules = $rules;
    }

    public function validate(): array {
        $this->data = $this->request->all();

        foreach ($this->rules as $field => $fieldRules) {
            $rules = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;
            
            foreach ($rules as $rule) {
                $this->validateField($field, $rule);
            }
        }

        return [
            'valid' => empty($this->errors),
            'errors' => $this->errors,
            'data' => array_intersect_key($this->data, array_flip(array_keys($this->rules)))
        ];
    }

    private function validateField(string $field, string $rule): void {
        $ruleParts = explode(':', $rule);
        $ruleName = trim($ruleParts[0]);
        $ruleParams = isset($ruleParts[1]) ? $ruleParts[1] : null;

        $value = $this->data[$field] ?? null;

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, "{$field} is required");
                }
                break;

            case 'email':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "{$field} must be a valid email");
                }
                break;

            case 'min':
                if (!empty($value) && strlen($value) < (int)$ruleParams) {
                    $this->addError($field, "{$field} must be at least {$ruleParams} characters");
                }
                break;

            case 'max':
                if (!empty($value) && strlen($value) > (int)$ruleParams) {
                    $this->addError($field, "{$field} must not exceed {$ruleParams} characters");
                }
                break;

            case 'numeric':
                if (!empty($value) && !is_numeric($value)) {
                    $this->addError($field, "{$field} must be numeric");
                }
                break;

            case 'confirmed':
                $confirmField = "{$field}_confirmation";
                if ($value !== ($this->data[$confirmField] ?? null)) {
                    $this->addError($field, "{$field} confirmation does not match");
                }
                break;

            case 'unique':
                // Placeholder for database check
                // Implementation depends on your database setup
                break;

            case 'regex':
                if (!empty($value) && !preg_match($ruleParams, $value)) {
                    $this->addError($field, "{$field} format is invalid");
                }
                break;

            case 'in':
                $allowed = explode(',', $ruleParams);
                if (!empty($value) && !in_array($value, $allowed)) {
                    $this->addError($field, "{$field} is not a valid option");
                }
                break;

            case 'date':
                if (!empty($value) && !strtotime($value)) {
                    $this->addError($field, "{$field} must be a valid date");
                }
                break;
        }
    }

    private function addError(string $field, string $message): void {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function hasError(string $field): bool {
        return isset($this->errors[$field]);
    }

    public function getFieldError(string $field): ?string {
        return $this->errors[$field][0] ?? null;
    }
}
