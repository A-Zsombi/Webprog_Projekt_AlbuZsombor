<?php
class Project{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getProjects(){
        $this->db->query('SELECT * FROM projects');

        $result = $this->db->resultSet();

        return (json_encode($result));
    }

    public function addProject($data){
        $this->db->query('INSERT INTO projects(name, stage, value, close_date) VALUES(:name, :stage, :value, :close_date)');


        $this->db->bind(":name", $data['name']);
        $this->db->bind(":stage", $data['stage']);
        $this->db->bind(":value", $data['value']);
        $this->db->bind(":close_date", $data['close_date']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    public function deleteProject($id){
        $this->db->query('DELETE FROM projects WHERE projects.id = :id');

        $this->db->bind(":id", $id);

        return $this->db->execute();
      
    }





    public function getProjectById($id){
        $this->db->query('SELECT * FROM projects WHERE projects.id = :id');

        $this->db->bind(":id", $id);

        return $this->db->single();
    }

    public function editProject($data){
        $this->db->query('UPDATE projects SET name = :name, stage = :stage, value = :value, close_date = :close_date WHERE id = :id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':stage', $data['stage']);
        $this->db->bind(':value', $data['value']);
        $this->db->bind(':close_date', $data['close_date']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function addProjectGetId($data){
        if($this->addProject($data)){
            return $this->db->lastInsert();
        }
        return -1;

    }
   
}


