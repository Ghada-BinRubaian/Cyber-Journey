<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};


if(isset($_POST['submit'])){     
    $mail = $_POST['email'];
    if($conn->connect_error){
        die('Connection Faild :' .$conn->connect_error);}
   
    $result = $conn->prepare("DELETE FROM `users` WHERE email=?");
    $result->execute([$mail]);
    if($result->num_rows == 1) {
        echo '<script>alert("Deleted Successfuly ")</script>';
        header("Location: aPage.html");
        exit();
}
else {
   
        echo '<script>alert("User Does NOT exist !")</script>';
        header("Location: AdminPage.php");
    exit();
}
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="sign.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script>
        function validateForm() {
            var email = document.getElementById('mail').value;
            var nameRegex = /^[a-zA-Z]+$/;
        if(!(email.endsWith("@gmail.com") || email.endsWith("@outlook.com")|| email.endsWith("@hotmail.com")|| email.endsWith("@iau.edu.sa")))
        {
            document.getElementById('error').innerHTML = 'Please enter valid domain for the e-mail , example@gmail.com';
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
        <div class="form-box">
            <h1 id="title">Delete User</h1>
            <div style="font-size: small; color: rgb(236, 20, 20); background-color:  rgb(237, 237, 237); border-color: rgb(0, 0, 0);" id="error"></div>
            <div class="input-group">
                    <div class="input-field">
            <form method="post" id="form" onsubmit="return validateForm()">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Enter User E-mail" name="email" required id="mail">
                        </div>
                <div class="btn-field">
                    <button type="link"><a style="color: #fff;" href="AdminPage.php">Back</a></button>
                    <input type="submit" class = "delete" value="Delete" name="submit" class="btn">
                
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
            </form>
            </div>
            </div>
            </div>
    </div>
    </section>
</body>

</html>