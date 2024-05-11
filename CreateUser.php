<?php

session_start();

include 'connect.php';

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};


if(isset($_POST['submit'])){
    $id= unique_id() ;
    $firstname = $_POST['firstname'];
    $lasttname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($conn->connect_error){
        die('Connection Faild :' .$conn->connect_error);
    }
    else
    {
        $stmtEmail = $conn->prepare("SELECT * FROM users WHERE email=? ");
        $stmtEmail->execute([$email]);
        if($stmtEmail->rowCount() > 0){
            echo "<script>document.getElementById('error').innerHTML = 'Email already exists. Please choose a different email.';</script>";
            header("Location: signup.html");
    }
    else{
        $stmt = $conn->prepare("INSERT INTO users(id,firstname, lastname, gender, email, password) values(?,?, ?, ?, ?, ?)");
        $stmt->execute([$id,$firstname, $lasttname, $gender, $email, $password]);
        echo '<script>alert("Account Created Successfully, Now sign in")</script>';
        header("Location: AdminPage.php");
        $stmt->close();
        $conn->close();
    };
};
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="sign.css">
    <script src="https://kit.fontawesome.com/ab3520cc60.js" crossorigin="anonymous"></script>
    <script>
        function validateForm() {
            var fname = document.getElementById('Fname').value;
            var lname = document.getElementById('Lname').value;
            var email = document.getElementById('mail').value;
            var password = document.getElementById('pass').value;
            var nameRegex = /^[a-zA-Z]+$/;

            if (!nameRegex.test(fname) || !nameRegex.test(lname)) {
                document.getElementById('error').innerHTML = 'Invalid input. Please enter alphabetic characters only For The name ';
                return false;
            }

            
        if(!(email.endsWith("@gmail.com") || email.endsWith("@outlook.com")|| email.endsWith("@hotmail.com")|| email.endsWith("@iau.edu.sa")))
        {
            document.getElementById('error').innerHTML = 'Please enter valid domain for the e-mail , example@gmail.com';
                return false;
        }
           if( pass.value.length < 7){
            document.getElementById('error').innerHTML = 'Password Too short , Should be 8 chars or more';
            return false;
            // messages.push('Password Too short , Should be 8 chars or more')
        }
        if (!pass.value.match(/[a-zA-Z]/)){
            document.getElementById('error').innerHTML = 'Password Should 1 char or more';
            return false;
                // messages.push('Password Must Include At Least ONE Letter')
            }
       if (!pass.value.match(/[0-9]/) ){
                // messages.push('Password Must Include At Least ONE Number')
                document.getElementById('error').innerHTML = 'Password Should1 digit or more';
                return false;
            }


            return true;
        }
    </script>
</head>
<body>
<video autoplay muted loop id="video-background">
  <source src="Background3.mp4" type="video/mp4">
  Your browser does not support the video tag.
  </video>

  <section class="MainHomepage">
        <div class="MainHomepage-content">
<div class="MainHomepage-container">
    <div class="form-box">
        <h1 id="title">Create Account </h1>
        <div style="font-size: small; color: rgb(236, 20, 20); background-color:  rgb(237, 237, 237); border-color: rgb(0, 0, 0);" id="error"></div>
        <div class="input-group">
         <form method="post" id="form" onsubmit="return validateForm()">
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Enter First name" name="firstname" id="Fname">
    </div>
    <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Enter Last name" name="lastname" id="Lname">
    </div>
    <div class="radioBtn" id="Gen">
                    <i class="fa-solid fa-person-half-dress"> Gender: </i>
                    <label for="gender">
                        <label for="male"><input type="radio" name="gender" value="M" id="male" required>Male</label>
                        <label for="female"><input type="radio" name="gender" value="F" id="female" required>Female</label>
                    </label>
                </div>
                    <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="Enter E-mail" name="email" id='mail' >
    </div>
    <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Enter Password " name="password" id="pass">
    </div>
            </div>
            <div class="btn-field">
            <button type="link"><a style="color: #fff;" href="AdminPage.php">Back</a></button>
            <input type="submit" class = "delete" value="Create" name="submit" class="btn">
                </div>
             <style>
.delete{
    flex-basis: 48%;
    background: rgb(32, 32, 90) ;
    color: #fff;
    height: 40px;
    border-radius: 20px;
    border: 0;
    outline: 0;
    cursor: pointer;
    transition: background 1s;
    
}
             </style>                
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>
</body>

</html>

