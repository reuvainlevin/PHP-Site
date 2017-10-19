<?php
    require 'uautoLoad.php';
    new Utop();
    $home = new Vhome();
    $home->render();
    new UBottom();
?>