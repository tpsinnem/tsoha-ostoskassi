<?php

include_once "include.php";

View::alku();
Controller::aja(clone $_POST);
View::loppu();

?>
