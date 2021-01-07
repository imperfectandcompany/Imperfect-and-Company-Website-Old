<?php
    include('../config/db.php');
if (isset($_SESSION['jobs'])) {
	
if ($_SESSION['jobs'] == 1) {
include('id/1.php');
}

elseif ($_SESSION['jobs'] == 2) {
include('id/2.php');

} else {
include('invalid.php');
}

} else {
		include('id/0.php');	
}
?>