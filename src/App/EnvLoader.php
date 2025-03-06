<?php

namespace App;

use Dotenv\Dotenv;

class EnvLoader{

    private string $envPath;

    public function __construct(string $envPath)
    {
        $this->envPath = $envPath;
    }

    public function load(): void
    {
        $dotenv = Dotenv::createImmutable($this->envPath);
        $dotenv->load();
    }
    
}