<?php
    require 'uautoLoad.php';

    class Mpassword {
        private $user;
        private $password;
        private $db;
        private $error;

        public function __construct() {
            $this->db = Uconnect::getInstance();
            $this->error = Uerror::getInstance();
        }

        public function logout() {
             $_SESSION['admin'] = 'no';
        }


        public function verifyPassword () {
            if ($_SESSION['admin'] === 'yes') {
                $this->error->error('An Admin is allready logged in.');
            } else {          
                if (!empty($_POST['user'])) {
                    $this->user = $_POST['user'];
                } else {
                    $this->error->error('User Name needs to be filled out.');
                };

                if (!empty($_POST['password'])) {
                    $this->password = $_POST['password'];
                } else {
                    $this->error->error('Password needs to be filled out.');
                }
                if (!empty($_POST['password']) and !empty($_POST['user'])) {
                    $query = 'SELECT password FROM users WHERE name = ?';
                    $statement = $this->db->prepare($query);
                    $statement->bindValue(1, $this->user);
                    $statement->execute();
                    $passed = $statement->fetch();

                    if (!password_verify($this->password , $passed['password'])) {   
                        $this->error->error('User Name or Password is inccorect.');           
                    }else {
                        $_SESSION['admin'] = 'yes';
                    }
                }
            }
        }
  
    }

?>