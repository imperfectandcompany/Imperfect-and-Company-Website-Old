<?php
    session_start();
    $_SESSION['listing']=$_GET['listing'];
    header("Location: ../opportunities");
?>