<?php
    require 'uautoLoad.php';

    class Mhome {
        private $db; 
        
        public function __construct() {     
            $this->db = Uconnect::getInstance();
            if (!empty($_POST["Shoe"])) {
                $_SESSION['sitename'] = $_POST["Shoe"];
                $defaults = new Usetdefaults();
                $defaults->setSiteDefaults();
            }
            if (!empty($_POST["Computer"])) {
                $_SESSION['sitename'] = $_POST["Computer"];
                $defaults = new Usetdefaults();
                $defaults->setSiteDefaults();
            }
            if (!empty($_POST["category"])) {
                $_SESSION['category'] = $_POST["category"];
            }
        }


        public function getCategorys () {
            $query = "SELECT DISTINCT category FROM stores WHERE store = ?";
            $preparedStatement = $this->db->prepare($query);
            $preparedStatement->bindValue(1, $_SESSION['sitename']);
            $preparedStatement->execute();
            $categorys = $preparedStatement->fetchall();
            return $categorys;
        }


         public function getRows () {
            $query = "SELECT  id, name, price, category FROM stores WHERE store = ?";
            $preparedStatement = $this->db->prepare($query);
            $preparedStatement->bindValue(1, $_SESSION['sitename']);
            if (!empty($_POST["category"])) {
                $query .= " AND category = ? ";
                $preparedStatement = $this->db->prepare($query);
                $preparedStatement->bindValue(1, $_SESSION['sitename']);
                $preparedStatement->bindValue(2, $_SESSION['category']);
            }
            $preparedStatement->execute();
            $selectedItems = $preparedStatement->fetchall();
            return $selectedItems;
         }

         public function getSiteNames () {
            $query = "SELECT DISTINCT store FROM stores";
            $site = $this->db->query($query)->fetchall();
            return $site;
         }


          public function getSiteName () {
                return  $_SESSION['sitename'];
          }
    }
?>