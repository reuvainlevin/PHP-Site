<?php
    class Uerror {
        private static $instance;
        public function __construct() {

        }

        public function error($error) {
            echo '<div class="alert alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                    ' . $error . '.
            </div>';
        }

        public static function getInstance() {
            if (empty(self::$instance)) {
                self::$instance = new Uerror();
            }
            return self::$instance;
        }
    }
?>