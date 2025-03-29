<?php
session_start();
session_destroy();
header("Location: ../home/mainhome.php"); 
exit();
?>
