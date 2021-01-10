<?php
include_once('../config/db.php');
$pdo = pdo_connect_mysql();

global $accountNotFoundErr, $accountFoundSucc;
        $lemail     = $_POST['email'];

if(isset($_POST['submit_email']) && $_POST['email'])
{	
  $sql = $pdo->prepare("SELECT COUNT(id) FROM users where `email` = :email");
  $sql->bindValue(":email", $_POST['email']);
  $sql->execute();
  
  
  if($sql->fetchColumn() == 1)
 {  
  $qsql = $pdo->prepare("SELECT `email`, `password` FROM users where `email` = :email");
  $qsql->bindValue(":email", $_POST['email']);
  $qsql->execute();
  while ($row = $qsql->fetch()) {
  $email=md5($row['email']);
  $pass=md5($row['password']); 
  $remail=$row['email'];

  }
  
 $link="<a href='www.imperfectandcompany.com/reset/secret.php?key=".$email."&reset=".$pass."'>Click to reset password</a>"; 

ini_set("SMTP", "mail.nfoservers.com");
ini_set("sendmail_from", "reach@imperfectandcompany.com");
ini_set("smtp_port","587");

		
$msg = $link;
$subject = "Reset your password.";


// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <reach@imperfectandcompany.com>' . "\r\n";

// send email
mail($remail, $subject, $msg, $headers);
                $accountFoundSucc = '<div class="text-green-500">
                        Please check your email for account verification.
                    </div>';
    } else {
        // Not verified - show form error
                $accountNotFoundErr = '<div class="text-red-500">
                        Sorry, something went wrong. Please retry your email.
                    </div>';
    }
}
	if(empty($lemail)) {
                $accountNotFoundErr = '<div class="text-red-500">
                        Email cannot be blank.
                    </div>';	
		 }	
			



?>