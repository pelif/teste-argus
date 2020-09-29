<?php 

namespace Controllers;

use Illuminate\Database\Eloquent\Collection;
use Models\Users; 
use Psr\Container\ContainerInterface; 
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController 
{
    protected $container; 
    protected $render; 

    public function __construct(ContainerInterface $container) {
        $this->container = $container; 
        $this->render = $this->container->get('renderer'); 
    }
    
    public function index(Request $request, Response $response) {
        $this->render->render($response, 'header_login.phtml');         
        $this->render->render($response, 'login.phtml');                 
    }

    public function logInto(Request $request, Response $response) {
        
        $email = filter_input(INPUT_POST, 'email'); 
        $password = filter_input(INPUT_POST, 'password');         
        
        if(($email == null || $password == null) ||  
           ($email == '' || $password == '')) {

             return $response->withRedirect('/login?m=2');
        }        

        $password = sha1($password);  
        
        $user = Users::select('id', 'name', 'email')
                    ->where('email', '=', $email)
                    ->where('password', '=', $password)
                    ->get();        
        
        if($user instanceof Collection && sizeof($user) > 0) {
            $_SESSION['user'] = $user;             
            return $response->withRedirect('/'); 
        }
        
        return $response->withRedirect('/login?m=3'); 
    }

    public function logout(Request $request, Response $response) {
        session_destroy();      
        return $response->withRedirect('/login');         
    }

}