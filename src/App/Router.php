<?php
namespace App;
use App\Controller\Auth;
use FastRoute;
class Router{

    private $dispatcher;

    public function __construct($entityManager){
        $this->defineRoutes($entityManager);
    }

    private function defineRoutes($entityManager){
        $this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($entityManager){
            $r->post('/graphql', function() use ($entityManager){
               return Controller\GraphQL::handle($entityManager);
            });

            $r->post('/auth', function() use ($entityManager) {
                return Auth::handle($entityManager);
            });

            
            $r->get('/', function() {
                return 'Hello, API!';
            });
        
        });

    }

    public function dispatch($reqMethod,$reqURI)
    {
        $routeInfo = $this->dispatcher->dispatch($reqMethod,$reqURI);
        
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                echo $handler($vars);
                break;
        }
    }
    
}