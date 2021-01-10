<?php
    // Database connection
    include('../config/db.php');
	$pdo = pdo_connect_mysql();
	$login = false;
	    global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $email_empty_err, $pass_empty_err;
		
    if(isset($_POST['login'])) {
        $email_signin        = $_POST['email'];
        $password_signin     = $_POST['password'];
		

		
		
		 // clean data 
        $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
        $pswd = $password_signin;
		
	   // Query if email exists in db
		$sql = $pdo->prepare("SELECT * From users WHERE email = :email");
		$sql->bindValue(":email", $email_signin);
		try { $sql->execute();}
		// If query fails, show the reason 
		catch(PDOException $e){echo $e->getMessage();}
		$rowCount = $sql->rowCount();
		
        if(!empty($email_signin) && !empty($password_signin)){
            if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
                $wrongPwdErr = '<div class="text-red-500">
                        Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                    </div>';
            }
			
			 // Check if email exist
            if($rowCount <= 0) {
                $accountNotExistErr = '<div class="text-red-500">
                        User account does not exist.
                    </div>';
            } else {
                // Fetch user data and store in php session
                while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $id            = $row['id'];
                    $username     = $row['username'];
                    $email         = $row['email'];
                    $pass_word     = $row['password'];
                    $token         = $row['token'];
                    $is_active     = $row['is_active'];
                }
  // Verify password
                $password = password_verify($password_signin, $pass_word);
				
				       if($email_signin == $email && $password_signin == $password) {
						$login = true;
						header("Location: ../index.php");
                       $_SESSION['id'] = $id;
                       $_SESSION['username'] = $username;
                       $_SESSION['email'] = $email;
                       $_SESSION['token'] = $token;


					   } else {
                        $emailPwdErr = '<div class="text-red-500">
                                Either email or password is incorrect.
                            </div>';
                    }
			}
			
			     } else {
            if(empty($email_signin)){
                $email_empty_err = "<div class='text-red-500'>
                            Email not provided.
                    </div>";
            }
			            if(empty($password_signin)){
                $pass_empty_err = "<div class='text-red-500'>
                            Password not provided.
                        </div>";
            } 
		}
	}		

	
			
?>
