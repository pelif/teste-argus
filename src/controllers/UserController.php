<?php 

namespace Controllers;

use Models\Users;
use Psr\Container\ContainerInterface; 
use Slim\Http\Request;
use Slim\Http\Response;

class UserController 
{
    protected $container;     
    protected $render; 

    public function __construct(ContainerInterface $container) {
        $this->container = $container;             
        $this->render = $this->container->get('renderer');         
    }

    public function index(Request $request, Response $response) {
        $users = ['users' => Users::all()];

        $this->render->render($response, 'header.phtml'); 
        $this->render->render($response, 'users/index.phtml', $users);         
    }

    public function create(Request $request, Response $response) {
        $data = [
            'name' => filter_input(INPUT_POST, 'name'),
            'email' => filter_input(INPUT_POST, 'email'),
            'password' => filter_input(INPUT_POST, 'password')
        ];      

        $data['password'] = sha1($data['password']); 

        $user = new Users($data); 
        if($user->save()) {
            return $response->withStatus(302)->withHeader('Location', '/users?m=1'); 
        }
        return $response->withStatus(302)->withHeader('Location', '/users?m=2');         
    }

    public function remove(Request $request, Response $response, $args) {
        $id = $args['id']; 
        $user = Users::find($id);         
        if($user->delete()) {
            return $response->withStatus(302)->withHeader('Location', '/users?m=3'); 
        }
        return $response->withStatus(302)->withHeader('Location', '/users?m=4');         
    }


}