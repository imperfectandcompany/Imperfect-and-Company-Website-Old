<?php
   
    // Database connection
    include('../config/db.php');
    
    // Error & success messages
    global $success_msg, $email_exist, $tos_err, $user_exist, $u_NameErr, $_emailErr, $_passwordErr;
    global $uNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;
    

	
    // Set empty form vars for validation mapping
    $_user_name = $_email = $_password = "";

    if(isset($_POST["submit"])) {
        $username     = $_POST["username"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];

        // check if email already exist
        $email_check_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' ");
        $emailCount = mysqli_num_rows($email_check_query);

        // check if user already exist
        $user_check_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}' ");
        $userCount = mysqli_num_rows($user_check_query);

        // PHP validation
        // Verify if form values are not empty
        if(!empty($username) && !empty($email) && !empty($password)){
            
            // check if user email already exist
            if($emailCount > 0) {
                $email_exist = '
                    <div class="px-1 text-sm text-red-600">
                        User with email already exist!
                    </div>
                ';
			}
            if($userCount > 0) {
                $user_exist = '
                    <div class="px-1 text-sm text-red-600">
                        Username is already taken!
                    </div>
                ';	
            } else {
                // clean the form data before sending to database
                $_user_name = mysqli_real_escape_string($conn, $username);
                $_email = mysqli_real_escape_string($conn, $email);
                $_password = mysqli_real_escape_string($conn, $password);

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
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/", $_password)) {
                    $_passwordErr = '<div class="px-1 text-sm text-red-600">
                             Password must contain atleast one special chacter, lowercase, uppercase and digit.
                        </div>';
                }
                
                // Store the data in db, if all the preg_match condition met
                if((preg_match("/^[a-zA-Z ]*$/", $_user_name)) &&
                 (filter_var($_email, FILTER_VALIDATE_EMAIL)) && 
                 (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/", $_password))){

                    // Generate random activation token
                    $token = md5(rand().time());

                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    // Query
					if (isset($_POST['checkbox'])) {
                    $sql = "INSERT INTO users (username, email, password, token, is_active,
                    date_time) VALUES ('{$username}', '{$email}', '{$password_hash}', 
                    '{$token}', '0', now())";
                    
					//set success message, in the future wait for verification email
					$success_msg = '                    <div class="px-1 text-sm text-red-600">
                        Mission Success!</div>';
                    // Create mysql query
                    $sqlQuery = mysqli_query($conn, $sql);
					                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($conn));
                    } 
    // Checkbox isn't selected
} else {
					$tos_err = '                    <div class="px-1 text-sm text-red-600">
                        You must accept the terms and conditions along with the information data policy!</div>';
   // Alternate code
}
				
                    


/*                     // Send verification email
                    if($sqlQuery) {
                        $msg = 'Click on the activation link to verify your email. <br><br>
                          <a href="http://localhost/hah/register/user_verification.php?token='.$token.'"> Click here to verify email</a>
                        ';

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        ->setUsername('your_email@gmail.com')
                        ->setPassword('your_email_password');

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('Please Verify Email Address!'))
                        ->setFrom([$email => $firstname . ' ' . $lastname])
                        ->setTo($email)
                        ->addPart($msg, "text/html")
                        ->setBody('Hello! User');

                        // Send the message
                        $result = $mailer->send($message);
                          
                        if(!$result){
                            $email_verify_err = '<div class="alert alert-danger">
                                    Verification email coud not be sent!
                            </div>';
                        } else {
                            $email_verify_success = '<div class="alert alert-success">
                                Verification email has been sent!
                            </div>';
                        }
                    } */
                }
            }
        } else {
            if(empty($firstname)){
                $uNameEmptyErr = '<div class="px-1 text-sm text-red-600">
                    First name can not be blank.
                </div>';
            }
            if(empty($lastname)){
                $lNameEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Last name can not be blank.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Email can not be blank.
                </div>';
            }
            if(empty($password)){
                $passwordEmptyErr = '<div class="px-1 text-sm text-red-600">
                    Password can not be blank.
                </div>';
            }            
        }
    }
?>