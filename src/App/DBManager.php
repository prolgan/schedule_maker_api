<?php
namespace App;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManagerInterface;

class DBManager{
    
    private EntityManager $entityManager;

    public function __construct(){
        $isDevMode = true;  // TODO DEV MOD FOR FIXES
        $path = [__DIR__ . "/../src/Model"];
        $config = ORMSetup::createAttributeMetadataConfiguration($path, $isDevMode);

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'] ,
            'dbname' => $_ENV['DB_NAME'], 
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ], $config);
        
        
        
        $this->entityManager = new EntityManager($connection, $config);
    }

    public function getEntityManager(): EntityManagerInterface 
    {
        return $this->entityManager;
    }
    
}