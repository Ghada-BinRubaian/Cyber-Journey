<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};

if(isset($_POST['submit'])){
    $select_ID = $conn->prepare("SELECT Admin_id FROM `Admins`where Admin_id =?");  
    $select_ID->execute([$_SESSION['A_id']]);  
    $total_ID = $select_ID->rowCount();
    if($total_ID == 1){
        while($fetch_ID = $select_ID ->fetch(PDO::FETCH_ASSOC)){
            if($_SESSION['A_id'] ==$fetch_ID['Admin_id'] ){
                header("Location: AdminPage.php");
                exit();
            }
        }
        echo '<script>alert("Sorry the Admin ID not correct");</script>';
        header("Location: signin.html");
        exit();
    }
    else{
        echo '<script>alert("Sorry, contact the administrative to add your admin ID ");</script>';
        header("Location: signin.html");
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
    <title>Verify Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>
<video autoplay muted loop id="video-background">
        <source src="Background3.mp4" type="video/mp4">
         Your browser does not support the video tag.
        </video>
    <section class="MainHomepage">
    <div class="MainHomepage-content">
        <div class="form-box">
            <h1 id="title">Verify ADMIN </h1>
            <form method="post">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" placeholder="Enter Admin ID" name="id" required>
                <div class="btn-field">
                <button type="link"><a href="signin.html">Back</a></button>
                <input type="submit" value="Submit" name="submit">
</div>
</div>
<style>

.btn-field{
    width: 100%;
    display: flex;
    justify-content: space-between;

}

.btn-field button{
    flex-basis: 48%;
    background: rgb(32, 32, 90) ;
    color: #fff;
    height: 40px;
    border-radius: 20px;
    border: 0;
    outline: 0;
    cursor: pointer;

}
.btn-field input {
  font-size: 13px;
  font-family: sans-serif;
  flex-basis: 48%;
  background: rgb(32, 32, 90) ;
  color: #fff;
  height: 40px;
  border-radius: 20px;
  border: 0;
  outline: 0;
  cursor: pointer;

}
    </style>
            </form>
            </div>
            
            <span class="MainHomepage-imgHover"></span>
    </section>
    
</body>

</html>