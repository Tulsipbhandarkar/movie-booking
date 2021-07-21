<?php

include 'connection.php';
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 

// Define variables and initialize with empty values
$username = $password =  $name="";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["mail"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["mail"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT mail, password, name FROM users WHERE mail = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password,$name);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;  
                            $_SESSION["name"] = $name; 
                            // $s= "SELECT name FROM users WHERE mail = $username ";
                            // if($result = mysqli_query($link, $s)){
                            //     if(mysqli_num_rows($result) > 0){
                                    
                            // while($row = mysqli_fetch_array($result)){                 
                            
                            // }}}
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Login Form</title>    
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
} 
</style>   
</head>    

<body>    
    <h2>Login Page</h2><br>    
    <div class="login">    
    <form id="login" method="post">    
        <label><b>User Name     
        </b>    
        </label>    
        <input type="text" name="mail" id="Uname" placeholder="E-mail">    
        <br><br>    
        <label><b>Password     
        </b>    
        </label>    
        <input type="Password" name="password" id="Pass" placeholder="Password">    
        <br><br>    
        <button type="submit" id="log" name="login"> Login</button>
        <br><br>     
    </form>     
</div>    
</body>    
</html> 