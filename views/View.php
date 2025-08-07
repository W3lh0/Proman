<?php

namespace views;

class view {

    private string $viewPath;
    private array $data = [];

    public function __construct($viewPath, $data = []) 
    {
        $this->viewPath = $viewPath;
        $this->data = $data;
    }

    public function setData(string $key, string $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function withData(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function render(): string
    {
        $filePath = __DIR__ . '/render/' . $this->viewPath . '.php';

        if (!file_exists($filePath)) {
            throw new \Exception("Can't find '{$filePath}'.");
        }

        extract($this->data);
        ob_start();
        include $filePath;
        return ob_get_clean();
    }
}