<?php

use Illuminate\Database\Eloquent\Collection;

$container = $app->getContainer();

// Middleware of anthentication
$auth = function ($request, $response, $next) {
    
    if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Collection) {
        return $next($request, $response);
    } 
    
    return $response->withRedirect('/login?m=1');
};
  

//End points of Login
$app->map(['GET','POST'], '/login', '\Controllers\LoginController:index'); 
$app->post('/log-into', '\Controllers\LoginController:logInto'); 
$app->get('/logout', '\Controllers\LoginController:logout'); 

//End poit of users
$app->get('/', '\Controllers\HomeController:index')->add($auth); 
$app->get('/users', '\Controllers\UserController:index')->add($auth);    
$app->post('/users', '\Controllers\UserController:create')->add($auth); 
$app->get('/users/{id}', '\Controllers\UserController:remove')->add($auth); 

//End Points of Patients
$app->get('/patients', '\Controllers\PatientController:index')->add($auth); 
$app->get('/patients/update/{id}', '\Controllers\PatientController:formUpdate')->add($auth);
$app->post('/patients/update', '\Controllers\PatientController:storeUpdate')->add($auth);
$app->get('/patients/new', '\Controllers\PatientController:new')->add($auth); 
$app->post('/patients/insert', '\Controllers\PatientController:store')->add($auth); 
$app->get('/patients/remove/{id}', '\Controllers\PatientController:remove')->add($auth); 
$app->get('/patients/import', '\Controllers\PatientController:formImport')->add($auth); 
$app->post('/patients/import', '\Controllers\PatientController:import')->add($auth); 



    
    

