<?php

class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function registerContr(){
        $data =[
            'username' => '',
            'email' => '',
            'telephone' => '',
            'dateofbirth' => '',
            'password' => '',
            'confirmPassword' => '',
            'emailError' => '',
            'usernameError' => '',
            'telephoneError' => '',
            'dateError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'telephone' =>trim($_POST['telephone']),
                'dateofbirth' => trim($_POST['dateofbirth']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'emailError' => '',
                'usernameError' => '',
                'telephoneError' => '',
                'dateError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            if(empty($data['username'])){
                $data['usernameError'] = 'Please enter username';
            }

            if(empty($data['email'])){
                $data['emailError'] = 'Please enter email';
            }
           
            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter a password';
            }
            if(empty($data['confirmPassword'])){
                $data['confirmPasswordError'] = 'Please enter a password';
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $data['confirmPasswordError'] = 'Passwords do not match';
                }
            }

            if(empty($data['telephone'])){
                $data['telephoneError'] = 'Please enter a telephone number';
            }

            if(empty($data['dateofbirth'])){
                $data['dateError']= 'Please enter your birth date';
            }

            if(empty($data['usernameError']) &&  empty($data['emailError']) && empty($data['passwordError'] && empty($data['confirmPasswordError']) && empty($data['dateError'] && empty($data['telephoneError']))))  {
              
                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          
                if($this->userModel->register($data)){
                    header('location: ' . URLROOT . '/users/loginContr');
                    
                }else{
                    die('something went wrong');
                }
            }
        }

        $this->view('users/register', $data);
    
    }

    
    public function loginContr(){
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];

            if(empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            if(empty($data['password'])) {
                $data['passwordError']= 'Please enter a password.';
            }

            if(empty($data['usernameError']) && empty($data['passwordError'])){
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                
                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                    header('location: ' . URLROOT . '/index');
                }else{
                    $data['passwordError'] = 'Password or username is incorect.';

                    $this->view('users/login', $data);
                }
            }
            
        }else{
            $data = [
                'title' => 'Login page',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
    
        }


        $this->view('users/login', $data);
    }
    public function logoutContr(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['roll']);
        header('location: '. URLROOT . '/users/loginContr' );
    }

    public function createUserSession($user){
        $_SESSION['user_id']= $user->id;
        $_SESSION['username']= $user->username;
        $_SESSION['email']= $user->email;
        $_SESSION['roll'] = $user->type;
    }

    

    public function displayUsersContr(){
    
        $data= $this->userModel->getUsers();
        $this->view('users/displayUsers', $data);
        
    } 
    

    public function deleteUserContr(){
   
            $id=trim($_POST['usersId']);

            if($this->userModel->deleteUser($id)){
                header('location: ' . URLROOT . '/users/displayUsersContr');
            }
            else{
                $this->displayUsersContr();
            }
 
    }

}