<?php 

namespace Controllers;

use Models\Patients;
use Psr\Container\ContainerInterface; 
use Slim\Http\Request; 
use Slim\Http\Response; 

class PatientController 
{
    protected $container;
    protected $render; 

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container; 
        $this->render = $this->container->get('renderer'); 
    }

    public function index(Request $request, Response $response) {
        $patients = ['patients' => Patients::all()];

        $this->render->render($response, 'header.phtml'); 
        $this->render->render($response, 'patients/index.phtml', $patients);         
    }

    public function new(Request $request, Response $response) {
        $this->render->render($response, 'header.phtml'); 
        $this->render->render($response, 'patients/new.phtml');         
    }

    public function store(Request $request, Response $response) {
        $data = [           
            'name' => filter_input(INPUT_POST, 'name'),
            'age' => filter_input(INPUT_POST, 'age'), 
            'telephone' => filter_input(INPUT_POST, 'telephone')            
        ];       

        $patient = new Patients();
        $patient->name = $data['name'];
        $patient->age = $data['age'];
        $patient->telephone = $data['telephone']; 
        
        $permitted_chars = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 4);
        $permitted_number = substr(str_shuffle('0123456789'), 0, 4);         
        $patient->registration = $permitted_chars . '' . $permitted_number; 

        if($patient->save()) {
            return $response->withRedirect('/patients?m=1'); 
        }
        return $response->withRedirect('/patients?m=4'); 
    }

    public function formUpdate(Request $request, Response $response, $args) {
        $id = $args['id']; 
        $patient = ['patient' => Patients::find($id)];        

        $this->render->render($response, 'header.phtml'); 
        $this->render->render($response, 'patients/update.phtml', $patient);         
    }
    
    public function storeUpdate(Request $request, Response $response) { 
        $data = [
            'id' => filter_input(INPUT_POST, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'age' => filter_input(INPUT_POST, 'age'), 
            'telephone' => filter_input(INPUT_POST, 'telephone')            
        ]; 
        
        $patient = Patients::find($data['id']);

        $patient->name = $data['name']; 
        $patient->age = $data['age']; 
        $patient->telephone = $data['telephone'];

        $CurrentDate = new \DateTime("NOW"); 
        $patient->updated_at = $CurrentDate->format('Y-m-d h:i:m');
        
        if($patient->save()) {
            return $response->withRedirect('/patients?m=2'); 
        }
        return $response->withRedirect('/patients?m=3'); 
    }

    public function remove(Request $request, Response $response, $args) {
        $id = (int) filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);         
        $patient = Patients::find($id); 
        if($patient->delete()) {
            return $response->withRedirect('/patients?m=5'); 
        }
        return $response->withRedirect('/patients?m=6'); 
    }   

    public function formImport(Request $request, Response $response)  {
        $this->render->render($response, 'header.phtml'); 
        $this->render->render($response, 'patients/import.phtml');         
    }

    public function import(Request $request, Response $response) {
                
        $uploadFile = $request->getUploadedFiles();
        $file = $uploadFile['patients']; 

        $strName = explode(".", $file->getClientFilename()); 
        if($strName[1] != 'txt') {
            return $response->withRedirect('/patients/import?m=2'); 
        }       
        
        $data = file($file->file);         
        
        foreach($data as $key => $line) {            
            $line = trim($line); 
            $value = explode('  ', $line); 

            $patient = new Patients; 
            $patient->name = $value[0];
            $patient->age = $value[1]; 
            $patient->telephone = $value[2];
            $patient->registration = $value[3];                         
            
            $patient->save();
            unset($patient); 
        }

        $insertions = $key + 1;
        return $response->withRedirect('/patients/import?m=1&t=' . $insertions); 
    }


}