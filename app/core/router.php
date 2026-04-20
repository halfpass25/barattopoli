<?php

class Router
{
    // Valori di default: se il router non riceve esplicitamente 
    //un controller ed un metodo, punta automaticamente al LOGIN
    private string $defaultController = 'login';
    private string $defaultMethod     = 'index';

    // Nome del controller (stringa)
    private string $controllerName;
   
    // Istanza del controller (oggetto)
    private object $controller;

    // Metodo da invocare
    private string $method;

    // Parametri per il metodo
    private array $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
       
        $this->resolveController($url);
        $this->resolveMethod($url);
        $this->resolveParams($url);

        $this->dispatch();
    
    }
     

    // ============================================================
    // URL parsing
    // ============================================================
    private function parseUrl(): array
    {
        $url = $_GET['url'] ?? $this->defaultController;

        return array_values(
            array_filter(
                explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL))
            )
        );
    }

    // ============================================================
    // Controller resolution (solo nome + include)
    // ============================================================
    private function resolveController(array &$url): void
    {
        $controller = strtolower($url[0] ?? $this->defaultController);
        $file = "app/controllers/{$controller}.php";

        if (!file_exists($file)) {
            $controller = 'notfound404';
            $file = "app/controllers/{$controller}.php";
        } else {
            unset($url[0]);
        }

        //echo "REQUIRED_CONTROLLER= ".$file;
        require_once $file;

        if (!class_exists($controller)) {
            $this->failHard("Controller class '{$controller}' not found");
        }

        $this->controllerName = $controller;
    }

    // ============================================================
    // Method resolution + controller instantiation
    // ============================================================
    private function resolveMethod(array &$url): void
    {
        $this->controller = new $this->controllerName;
        

        $method = $url[1] ?? $this->defaultMethod;

        if (method_exists($this->controller, $method)) {
            $this->method = $method;
            unset($url[1]);
        } else {
            $this->method = $this->defaultMethod;
           
        }
    }

    // ============================================================
    // Params
    // ============================================================
    private function resolveParams(array $url): void
    {
        $this->params = array_values($url);
    }

    // ============================================================
    // Dispatch
    // ============================================================
    private function dispatch(): void
    {
        if ($this->controllerName === 'notfound404') {
            http_response_code(404);
        }

        call_user_func_array(
            [$this->controller, $this->method], $this->params
            );
    }

    // ============================================================
    // Hard failure (didattico)
    // ============================================================
    private function failHard(string $message): void
    {
        http_response_code(500);
        die("<strong>Router fatal error:</strong> {$message}");
    }
}
