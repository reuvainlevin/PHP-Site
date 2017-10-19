<?php
    require 'uautoLoad.php';

    class Madmin {
        private static $instance;
        private $db;
        private $error;

        public function __construct() {
            $this->db = Uconnect::getInstance();
            $this->error = Uerror::getInstance();
            if (!empty($_POST["prepItem"])) {
                $_SESSION['prepId'] = $_POST["prepItem"];
            }
        }

        public static function getInstance() {
            if (empty(self::$instance)) {
                self::$instance = new Madmin();
            }
            return self::$instance;
        }

        public function create() {
            if ($_SESSION['admin'] === 'yes') {
                    if (!empty($_POST['name'])) {
                        $name = $_POST['name'];
                    } else {
                        $this->error->error('Name needs to be filled out.');
                    }
                    if (!empty($_POST['price']) and is_numeric($_POST['price'])){
                        $price = $_POST['price'];
                    } else {
                        $this->error->error('Price needs to be a number.');
                    }
                    if (!empty($_POST['category'])) {
                        $category = $_POST['category'];
                    } else {
                        $this->error->error('Category needs to be filled out.');
                    }
                    if (!empty($_POST["name"]) and !empty($_POST["price"]) and is_numeric($_POST['price']) and !empty($_POST["category"])){
                        $query = "INSERT INTO stores (name, price, category, store) VALUES(?, ?, ?, ?)";
                        $preparedStatement = $this->db->prepare($query);
                        $preparedStatement->bindValue(1, $name);
                        $preparedStatement->bindValue(2, $price);
                        $preparedStatement->bindValue(3, $category);
                        $preparedStatement->bindValue(4, $_SESSION['sitename']);
                        $preparedStatement->execute();
                    }
            }else {
                $this->error->error('You need to be signed in to create an item.');
            }
        }

        public function prepVal() {
            $query = "SELECT * FROM stores WHERE id = ?";
            $preparedStatement = $this->db->prepare($query);
            $preparedStatement->bindValue(1, $_SESSION['prepId']);
            $preparedStatement->execute();
            $item = $preparedStatement->fetch();
            $_SESSION['prepName'] = $item["name"];
            $_SESSION['prepPrice'] = $item["price"];
            $_SESSION['prepCategory'] = $item["category"];
        }

        public function update() {
            if ($_SESSION['admin'] === 'yes') {
                if (!empty($_POST['name'])) {
                    $name = $_POST['name'];
                } else {
                    $this->error->error('name needs to be filled out.');
                }
                if (!empty($_POST['price']) and is_numeric($_POST['price'])){
                    $price = $_POST['price'];
                } else {
                    $this->error->error('Price needs to be a number.');
                }
                if (!empty($_POST['category'])) {
                    $category = $_POST['category'];
                } else {
                    $this->error->error('Category needs to be filled out.');
                }
                if (!empty($_POST["name"]) and is_numeric($_POST["price"]) and !empty($_POST["category"]) and !empty($_POST["prepId"])) {
                    $query = "UPDATE stores SET name = ?, price = ?, category = ? WHERE id = ?";
                    $preparedStatement = $this->db->prepare($query);
                    $preparedStatement->bindValue(1, $name);
                    $preparedStatement->bindValue(2, $price);
                    $preparedStatement->bindValue(3, $category);
                    $preparedStatement->bindValue(4, $_POST["prepId"]);
                    $preparedStatement->execute();
                }
            }else {
                $this->error->error('You need to be signed in to update an item.');
           }
        }

        public function delete() {
            if ($_SESSION['admin'] === 'yes') {
               echo ' <form class="form" action="index.php" method="post">
                    <input type="hidden" name="prepId" value=" ' . $_SESSION['prepId'] . ' ">
                    <input class="btn btn-primary" type="submit" name="confirmDelete" value="Confirm Delete">	
                </form> ';
            }
        }

        public function deleteWarning() {
            if ($_SESSION['admin'] === 'yes') {
                $this->error->error('Make sure to hit the confirmDelete button to delete the chosen item.');
            }else {
                $this->error->error('You need to be signed in to delete an item.');
            }
        }

        public function confirmDelete() { 
            if (!empty($_POST["prepId"])) {
                $query = "DELETE FROM stores WHERE id = ?";
                $preparedStatement = $this->db->prepare($query);
                $preparedStatement->bindValue(1, $_POST["prepId"]);
                $preparedStatement->execute();
            }
        }
    }
?>