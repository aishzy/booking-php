<?php

namespace App\Models;

class User extends BaseModel {
    protected string $table = 'users';
    protected array $fillable = ['name', 'email', 'password'];
    protected array $hidden = ['password']; // Don't expose password
}
