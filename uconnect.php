<?php
    class Uconnect {
        private static $instance;
        private $db;
			public function __construct() {
                $cs = 'mysql:host=localhost;dbname=phpTestDB';
                $user = 'phpuser';
                $password = 'p@$$ward';
                try {
                    $this->db = new PDO($cs, $user, $password);
                } catch(PDOException $e) {
                    die($e->getMessage());
                }	
			}
            public static function getInstance() {
                if (empty(self::$instance)) {
                    self::$instance = new Uconnect();
                }
                return self::$instance;
            }
            public function getDb () {
                return  $this->db;
            }
            public function prepare($query) {
                return $this->db->prepare($query);
            }
            public function query($query) {
                return $this->db->query($query);
            }
    }
?>

