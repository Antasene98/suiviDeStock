<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location:src/view/accueil");
    exit;
}
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'stock');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
     // Check if username is empty
     if(empty(trim($_POST["email"]))){
         $email_err = "Please enter email.";
     } else{
         $email = trim($_POST["email"]);
     }
     
     // Check if password is empty
     if(empty(trim($_POST["password"]))){
         $password_err = "Please enter your password.";
     } else{
         $password = trim($_POST["password"]);
     }
     
     // Validate credentials
     if(empty($email_err) && empty($password_err)){
         // Prepare a select statement
         $sql = "SELECT id, email, password FROM users WHERE email = ?";
         
         if($stmt = $mysqli->prepare($sql)){
             // Bind variables to the prepared statement as parameters
             $stmt->bind_param("s", $param_email );
             
             // Set parameters
             $param_email = $email;
             $param_password = $password;
             
             // Attempt to execute the prepared statement
             if($stmt->execute()){
                 // Store result
                 $stmt->store_result();
                 
                 // Check if email exists, if yes then verify password
                 if($stmt->num_rows == 1){                    
                     // Bind result variables
                     $stmt->bind_result($id, $email, $hashed_password);
                     if($stmt->fetch()){
                        if($password == $hashed_password){
                            // Password is correct, so start a new session
                             session_start();
                             
                             // Store data in session variables
                             $_SESSION["loggedin"] = true;
                             $_SESSION["id"] = $id;
                             $_SESSION["email"] = $email;          // Redirect user to welcome page
                             header("location:src/view/accueil");
                            } else{
                                ?>
                                <script type="text/JavaScript">
            alert("Ce mot de passe est erroné");
           </script>
           <?php
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        ?>
                        <script type="text/JavaScript">
    alert("Ce utilisateur n'exite pas!");
   </script>
   <?php                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                $stmt->close();
            }
        }
        
    
     
     
     // Close connection
     $mysqli->close();
 }                    
                            
                             
?>
<!DOCTYPE html>
 <html lang="fr">
   <head>
        <meta charset="UTF-8" />
        <title>SuiviStocks</title>

        <link rel="stylesheet" href="public/css/bootstrap.css"> 
            <link href ="public/css/index.css" rel="stylesheet">
            <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.js"></script>
            <link href ="public/css/index.css" rel="stylesheet">
    </head>

  <body>
  <div class="login-wrap">

	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">SuiviStocks</label>
		<input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab"></label>
		<div class="login-form">
		<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Username or Email</label>
					<input id="user" type="text"  name="email" class="input">
                         <span class="invalid-feedback"><?php echo $email_err; ?></span>

				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" name="password" class="input" data-type="password">
                         <span class="invalid-feedback"><?php echo $password_err; ?></span>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Se connecter">
				</div>
				<div class="hr"></div>
			</div>
			<div class="for-pwd-htm">
				<div class="group">
					<label for="user" class="label">Username or Email</label>
					<input id="user" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Reset Password">
				</div>
				<div class="hr"></div>
			</div>
		</form>
		</div>
	</div>
</div>
</body>
