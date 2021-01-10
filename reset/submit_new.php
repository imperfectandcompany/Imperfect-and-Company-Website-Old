		<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<?php
	include_once('../config/db.php');
 $pdo = pdo_connect_mysql();
global $success_msg, $_passwordErr;
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pass)) {
                    $_passwordErr = '<div class="px-1 text-sm text-red-600">
                             Password should be between 6 to 20 charcters long, contain atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
                }
if((preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/", $pass))){
                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);		

  $zql=$pdo->prepare("UPDATE users SET `password` = :pass WHERE email = :email");
  $zql->bindValue(":pass", $password_hash);
  $zql->bindValue(":email", $email);
  $zql->execute();
                $success_msg = '<div class="px-1 text-sm text-green-600">
                    Registration successful!
                </div>';			
                }
}


?>
<?php  echo $success_msg;
 ?> 
 <?php  echo $_passwordErr;
 ?>