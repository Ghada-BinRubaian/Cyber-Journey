<?php
include 'connect.php';


session_start();

if (!isset($_SESSION['id'])) {
    header("Location: signin.html");
    exit();
};
$select_User = $conn->prepare("SELECT * FROM `users` where id=?");
$select_User->execute([$_SESSION['id']]);
$total_info= $select_User->rowCount();
if(isset($_POST['submit'])){
  $fname= $_POST['Fname'];
  $fname = filter_var($fname, FILTER_SANITIZE_STRING);
  $lname = $_POST['Lname'];
  $lname = filter_var($lname, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $update_User = $conn->prepare("UPDATE `users` SET id=?,firstname=?,lastname=?,email=? WHERE id=? ");
  $update_User->execute([$_SESSION['id'],  $fname, $lname,$email,$_SESSION['id']]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Journey User</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header class="header">
        <a href="HomeLogin.html" class="logo">Cyber Journey</a>
    </header>
    <section class="MainHomepage">
        <div class="MainHomepage-content">
        <div class="form-box">
          <?php
            if($select_User->rowCount() > 0){
            while($fetch_content = $select_User->fetch(PDO::FETCH_ASSOC)){
            ?>
            
        <form action="" method="post" enctype="multipart/form-data" id="form">
      
          <h1>User Account</h1>
          <h4>First name: </h4>
          <input type="text" name="Fname" placeholder="Firstname" value='<?= $fetch_content['firstname']; ?>' class="input-field">
          <h4>Last name: </h4>
          <input type="text" name="Lname" placeholder="LastName" value='<?= $fetch_content['lastname']; ?>' class="input-field">
          <h4>Email: </h4>
          <input type="email" name="email" placeholder="Email" value='<?= $fetch_content['email']; ?>' class="input-field">
          <?php
                    }
                }
            else{
            echo '<p class="empty">no user Info </p>';
            }
            ?>
                 <div class="btn-field">
                    <button type="link"><a style="color: #fff;" href="HomeLogin.html">Back</a></button>
                    <input type="submit" class = "update" value="Update" name="submit" class="btn">
                    <style>
       .form-box h4{
        text-align: left;
       }               
.btn-field .update{
    flex-basis: 48%;
    background: rgb(30, 32, 90) ;
    font-size: 13px;
    color: #ffff;
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
</body>
</html>
