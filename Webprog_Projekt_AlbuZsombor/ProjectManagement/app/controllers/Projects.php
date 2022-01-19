<?php

class Projects extends Controller{
    protected $projectModel;
    
    public function __construct(){
        $this->projectModel = $this->model('Project');
    }

    public function displayProjectsContr(){
      
        $data= $this->projectModel->getProjects();
        $this->view('projects/displayProjects', $data);            
        
    }

    public function newProjectContr(){
 
            $form = [
                'name' => trim($_POST['name']),
                'stage' => trim($_POST['stage']),
                'value' => trim($_POST['value']),
                'close_date' => trim($_POST['close_date'])
            ];

            if(!(empty($form['name']) && empty($form['stage']) && empty($form['value']) && empty($form['close_date']))){
                if($this->projectModel->addProject($form)){
                    header('location: ' . URLROOT . '/projects/displayProjectsContr');
                }
            }else{
                $this->displayProjectsContr();
            }
    }


    public function deleteProjectContr(){

            $id=trim($_POST['projectsId']);

            if($this->projectModel->deleteProject($id)){
                header('location: ' . URLROOT . '/projects/displayProjectsContr');
            }
            else{
                $this->displayProjectsContr();
            }   
    }


    public function editProjectContr(){
      
            $id = trim($_POST['projectId']);

            $data= $this->projectModel->getProjectById($id);

            $this->view('projects/editProjects', $data);

    }

    
    public function editProjectContr2(){
        
            $data=[
                'id' => trim($_POST['projectsId']),
                'name' => trim($_POST['name']),
                'stage'=>trim($_POST['stage']),
                'value' =>trim($_POST['value']),
                'close_date' =>trim($_POST['close_date'])
            ];

            if($this->projectModel->editProject($data)){
                header('location: ' . URLROOT . '/projects/displayProjectsContr');
            }               
    }  


    public function JSONeditProjectContr2(){
       
        $data=[
            'id' => trim($_POST['projectsId']),
            'name' => trim($_POST['name']),
            'stage'=>trim($_POST['stage']),
            'value' =>trim($_POST['value']),
            'close_date' =>trim($_POST['close_date'])
        ];

        if($this->projectModel->editProject($data)){
           echo "Successfully edited the project.";
        }         
}  


}