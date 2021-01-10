<?php
   
    // Database connection    
    include_once('../config/db.php');
	    $pdo = pdo_connect_mysql();
    
    // Error & success messages
    global $success_msg, $email_exist, $tos_err, $user_exist, $u_NameErr, $_emailErr, $_passwordErr;
    global $uNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $cpasswordEmptyErr, $passMatchErr, $email_verify_err, $email_verify_success;
    
    // Set empty form vars for validation mapping
    $_user_name = $_email = $_password = "";

    if(isset($_POST["submit"])) {
        $username      = $_POST["username"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];
		$cpassword 	   = $_POST['confirmpass'];
		$emailCount;
        // check if email already exist
		$esql = $pdo->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = :email");
		$esql->bindValue(":email", $_POST["email"]);
		$esql->execute();

        // check if user already exist
		$usql = $pdo->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username` = :username");
		$usql->bindValue(":username", $_POST["username"]);
		$usql->execute();
		
        // Verify if form values are not empty
        if(!empty($username) && !empty($email) && !empty($password) && !empty($cpassword) && isset($_POST['checkbox'])){
            
            // check if user email already exists
            if($esql->fetchColumn() > 0) {
                $email_exist = '
                    <div class="px-1 text-sm text-red-600">
                        User with email already exist!
                    </div>';
			}
            elseif($usql->fetchColumn() > 0) {
                $user_exist = '
                    <div class="px-1 text-sm text-red-600">
                        Username already taken!
                    </div>
                ';
			}
            elseif($password !== $cpassword){
                $passMatchErr = '<div class="px-1 text-sm text-red-600">
                    Password and confirm password do not match.
                </div>';					
            } else {
                // clean the form data before sending to database
                $_user_name = $username;
                $_email = $email;
                $_password = $password;

                // perform validation
                if(!preg_match("~^[a-z0-9]{1}[a-z0-9._-]{3,18}[a-z0-9]{1}$~i", $_user_name)) {
                    $u_NameErr = '<div class="px-1 text-sm text-red-600">
                            <ol>
							<li>Accept only letters or numbers at the beginning and end of the string</li>
							<li>accept periods, dashes, underscores, letters, numbers</li>							
							<li>Must have a length between 5-20 characters</li>
							</ol>
                        </div>';
				}
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="px-1 text-sm text-red-600">
                            Email format is invalid.
                        </div>';
                }	
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="px-1 text-sm text-red-600">
                            Email format is invalid.
                        </div>';
                }	
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                    $_passwordErr = '<div class="px-1 text-sm text-red-600">
                             Password should be between 6 to 20 charcters long, contain atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
                }
                
                // Store the data in db, if all the preg_match condition met
                if((preg_match("/^[a-zA-Z ]*$/", $_user_name)) &&
                 (filter_var($_email, FILTER_VALIDATE_EMAIL)) && 
                 (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/", $_password))){

                    // Query
                    $sql = $pdo->prepare("INSERT INTO users (username, email, password, token, is_active,
                    date_time) VALUES (:username, :email, :password, 
                    :token, '0', now())");
                    
                    // Generate random activation token
                    $token = md5(rand().time());

                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);					
					
                    // Create mysql query
					//bind placeholders to actual variable values
					$sql->bindValue(":username", $username);
					$sql->bindValue(":email", $email);
					$sql->bindValue(":password", $password_hash);
					$sql->bindValue(":token", $token);
                    // Execute query
                    $sql->execute(); 
                $success_msg = '<div class="px-1 text-sm text-green-600">
                    Registration successful!
                </div>';					
                }
            }
        } else {
            if(empty($username)){
                $uNameEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Username cannot be blank.
                </div>';
					}
            if(empty($email)){
                $emailEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Email cannot be blank.
                </div>';
					}
            if(empty($password)){
                $passwordEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Password cannot be blank.
                </div>';
					}    
				if(empty($cpassword)){
                $cpasswordEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Confirm password cannot be blank.
                </div>';
				} 
			if (!isset($_POST['checkbox'])) { 
			$tos_err = '                    <div class="px-1 text-sm text-red-600">
                        You must accept the terms and conditions along with the information data policy!</div>';
			}				
        }
    }
?>