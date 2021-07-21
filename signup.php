<?php
 include 'connection.php';

// Define variables and initialize with empty values
$mail = $password = $confirm_password = $name = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST["mail"]))){
        $username_err = "Please enter a mail.";

     } 
     //elseif(!preg_match('/^[a-zA-Z0-9@]+$/', trim($_POST["mail"]))){
    //     echo "running 2";
    //     $username_err = "Username can only contain letters, numbers, and underscores.";
    // } 
    else{
        // Prepare a select statement

        $sql = "SELECT mail FROM users WHERE mail = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            //"s" corresponds to type string
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["mail"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $mail = trim($_POST["mail"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 1){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    $name=$_POST["name"];


    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) ){
        // echo $username_err .$password_err .$confirm_password_err;
        // Prepare an insert statement
        $sql = "INSERT INTO users (mail, name, password) VALUES (?, ?, ?)";
 
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_name, $param_password,);
            
            // Set parameters
            $param_username = $mail;
            $param_name = $name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                function consoleLog($msg) {
                    echo '<script type="text/javascript">' .'console.log("' . $msg . '");</script>';
                }
                
                consoleLog('Registered');
                header("location: signin.php");
                
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

    }
    // else{
    //     print_r($username_err .$password_err .$confirm_password_err);
    // }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>body  
{  
    margin: 0;  
    padding: 0;  
    background-color:#956cd8ba;  
    font-family: 'Arial';  
}  
.login{  
        width: 382px;  
        overflow: hidden;  
        margin: auto;  
        margin: 20 0 0 450px;  
        padding: 80px;  
        background: #3d214e;  
        border-radius: 15px ;  
        text-align: center;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 60px 40px -7px;
        }  
.login:hover{
    box-shadow: rgba(0, 0, 0, 0.4) 0px 22px 70px 4px;
    transform: scale(1.01);
}
    
h2{  
    text-align: center;  
    color: #770021;  
    padding: 20px;  
}  
label{  
    color: #ff7070;  
    font-size: 17px;  
}  

#Uname{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
}  
#Pass{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
      
}  
#log{  
    width: 150px;  
    height: 30px;  
    border: none;  
    border-radius: 17px;  
    padding-left: 7px;  
    color: black; 
    font-size:16px; 
    font-weight: bold;
  
}  
#log:hover{ 
    background-color: #ff7070;  
}

span{  
    color: white;  
    font-size: 17px;  
}  
a{  
    float: right;  
    background-color: grey;  
}  </style>
</head>
<body>    
    <h2>LOGIN PAGE</h2><br>    
    <div class="login">    
    <form id="login" method="post">    
        <label><b>Email</b></label>    <br>
        <input type="text" name="mail" id="Uname" placeholder="E-mail">    
        <br><br>    
        <label><b>Password</b></label>    <br>
        <input type="Password" name="password" id="Pass" placeholder="Password">    
        <br><br> 
        <label><b>Confirm Password<b></label>    <br>
        <input type="Password" name="confirm_password" id="Pass" placeholder="Password">    
        <br><br>    
        <label><b>Name</b></label>     <br>
        <input type="text" name="name" id="Uname" placeholder="Your Name">    
        <br><br> 
        <button type="submit" id="log" name="login"> Sign Up</button>
        <br><br>     
    </form>     
</div>    
</body>
</html>