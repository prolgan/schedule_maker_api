<?php

namespace App;

class App{

    private DBManager $dbManager;
    private Router $router;

    public function __construct(){
        $envLoader = new EnvLoader(__DIR__ . '/../../');
        $envLoader->load();

        $this->dbManager = new DBManager();

        $this->router = new Router($this->dbManager->getEntityManager());
    }

    public function run()
    {
        $this->router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
    
}