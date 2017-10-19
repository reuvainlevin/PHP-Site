<?php
    class UsetDefaults {
        private $error;
        public function __construct() {
            $this->error = Uerror::getInstance();
        }

        public function setSiteDefaults() {
            $_SESSION['prepName'] = '';
            $_SESSION['prepPrice'] = '';
            $_SESSION['prepCategory'] = '';
            $_SESSION['prepId'] = '';
        }

        public function setDefaults() {
            if (!isset($_COOKIE['discount'])) {
                $this->error->error('Welcome back, please take a 10% discount on your next order over $75.00 .');
                setCookie('discount', 'startTime', time() + (60 * 60 * 24 * 7));
            }
            $_SESSION['firstTimeHere'] = 'no';
            $_SESSION['admin'] = 'no';
            $_SESSION['prepName'] = '';
            $_SESSION['prepPrice'] = '';
            $_SESSION['prepCategory'] = '';
            $_SESSION['prepId'] = '';
            $_SESSION['sitename'] = "Shoe";
            $_SESSION['category'] = '';
        }
    }
?>