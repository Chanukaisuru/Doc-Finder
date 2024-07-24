<?php

session_start();
session_destroy();
header('Location: home.html');// go to home page
exit();
?>
