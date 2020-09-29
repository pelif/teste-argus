<?php

$auth = function ($request, $response, $next) {
    // if($_SESSION['user'] && is_array($_SESSION['user'])) {
    //     $response = $next($request, $response); 
    // } else {
    //     $response = $response->withStatus(401)->write('Page Protected'); 
    // }

    $response->getBody()->write('ANTES'); 
    $response = $next($request, $response); 
    $response->getBody()->write('DEPOIS'); 
    return $response;     
}; 

// return function ($app, $request, $response, $next) {  
    
//     $response->getBody()->write('ANTES'); 
//     $response = $next($request, $response); 
//     $response->getBody()->write('DEPOIS'); 
//     return $response;       
// };

// use Slim\App;

// $auth = function (App $app) {
//     // e.g: $app->add(new \Slim\Csrf\Guard);

//     $authentication = function ($request, $response, $next) {
    
//         if($_SESSION['user'] && is_array($_SESSION['user'])) {
//             $response = $next($request, $response); 
//         } else {
//             $response = $response->withStatus(401)->write('Page Protected'); 
//         }
        
//         return $response; 

//         // $response->getBody()->write('ANTES'); 
//         // $response = $next($request, $response); 
//         // $response->getBody()->write('DEPOIS'); 
//         // return $response; 
//     };     
    
//     // $app->add($auth); 

// };

// return $auth; 



