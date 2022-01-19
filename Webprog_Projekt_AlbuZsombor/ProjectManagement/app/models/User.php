<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('INSERT INTO users (username, password, telephone, email, dateofbirth) VALUES(:username, :password, :telephone, :email, :dateofbirth)');

            //Bind values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':telephone', $data['telephone']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':dateofbirth', $data['dateofbirth']);

            //Execute function
            if($this->db->execute()){
                return true;
            }
            return false;
        }
        public function login($username, $password){
            $this->db->query('SELECT * FROM users WHERE username = :username');

            $this->db->bind(':username', $username);

            $row= $this->db->single();

            $hashedPassword= $row->password;

            if(password_verify($password, $hashedPassword)){
                return $row;
            } else{
                return false;
            }
        }





        public function getUsers(){
            $this->db->query('SELECT * FROM users');
    
            $result = $this->db->resultSet();
    
            return (json_encode($result));
        }


        public function deleteUser($id){
            $this->db->query('DELETE FROM users WHERE users.id = :id');
    
            $this->db->bind(":id", $id);
    
            return $this->db->execute();
        }
        

       
        
    }
