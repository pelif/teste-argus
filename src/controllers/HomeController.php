<?php 

namespace Controllers; 

use Psr\Container\ContainerInterface; 
use Models\Users; 
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController 
{
    protected $container; 

    public function __construct(ContainerInterface $container) {
        $this->container = $container; 
        $this->render = $this->container->get('renderer'); 
    }

    public function index(Request $request, Response $response, $args) {
        $this->render->render($response, 'header.phtml');
        $this->render->render($response, 'index.phtml');        
    }
}
