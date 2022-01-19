<?php
class Dashboard{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getSumValue(){
        $this->db->query('SELECT SUM(value) FROM projects');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAvgValue(){
        $this->db->query('SELECT AVG(value) FROM projects');

        $result = $this->db->resultSet();

        return $result;
    }


    public function getCountKész(){
        $this->db->query('SELECT COUNT(projects.id) FROM projects WHERE projects.stage="Kész"');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getCountBefejezetlen(){
        $this->db->query('SELECT COUNT(projects.id) FROM projects WHERE projects.stage="Befejezetlen"');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getCountFolyamatban(){
        $this->db->query('SELECT COUNT(projects.id) FROM projects WHERE projects.stage="Folyamatban"');

        $result = $this->db->resultSet();

        return $result;
    }
	

	
    
    

}