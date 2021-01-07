<?php
	    session_start();
    $_SESSION['jobs']=$_GET['listing'];
    header("Location: ../opportunities");
?>