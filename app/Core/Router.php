<?php 
    namespace App\Core;

    use App\Http\Request;
    use App\Http\Response;

    class Router {
        private array $routes = [];
        private array $middleware = [];
        private array $groups = [];

        public function addRoute(string $method, string $path, callable|array $callback): self {
            $method = strtoupper($method);
            $pattern = $this->compilePattern($path);
            
            $this->routes[$method][$pattern] = [
                'callback' => $callback,
                'middleware' => [],
                'original_path' => $path
            ];

            return $this;
        }

        public function get(string $path, callable|array $callback): self {
            return $this->addRoute('GET', $path, $callback);
        }

        public function post(string $path, callable|array $callback): self {
            return $this->addRoute('POST', $path, $callback);
        }

        public function put(string $path, callable|array $callback): self {
            return $this->addRoute('PUT', $path, $callback);
        }

        public function delete(string $path, callable|array $callback): self {
            return $this->addRoute('DELETE', $path, $callback);
        }

        public function middleware(string|array $middleware): self {
            if (is_string($middleware)) {
                $this->middleware[] = $middleware;
            } else {
                $this->middleware = array_merge($this->middleware, $middleware);
            }
            return $this;
        }

        private function compilePattern(string $path): string {
            $pattern = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $path);
            return "#^$pattern/?$#";
        }

        public function resolve(Request $request, Response $response): mixed {
            $method = $request->getMethod();
            $path = $request->getPath();
            
            foreach ($this->routes[$method] ?? [] as $pattern => $routeData) {
                if (preg_match($pattern, $path, $matches)) {
                    $params = array_filter(
                        $matches, 
                        fn($key) => !is_numeric($key),
                        ARRAY_FILTER_USE_KEY
                    );

                    $callback = $routeData['callback'];

                    // Execute middleware
                    foreach ($routeData['middleware'] as $middlewareClass) {
                        $middleware = new $middlewareClass();
                        $result = $middleware->handle($request, $response);
                        if ($result !== true) {
                            return $result;
                        }
                    }

                    // Execute route callback
                    if (is_array($callback)) {
                        [$controller, $method] = $callback;
                        $controllerInstance = new $controller($request, $response);
                        return $controllerInstance->$method(...array_values($params));
                    }

                    return $callback($request, $response, ...$params);
                }
            }

            return $response->notFound('Route not found');
        }
    }