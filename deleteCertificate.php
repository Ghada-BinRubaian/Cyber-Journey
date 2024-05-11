<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};


if(isset($_POST['submit'])){ 
    $id=$_POST['id'];  
    if($conn->connect_error){
        die('Connection Faild :' .$conn->connect_error);}
    else{
        $result = $conn->prepare("DELETE FROM `certifications` WHERE AdminID=? and id=?");
        $result->execute([$_SESSION['A_id'] , $id]);
        if($result->num_rows == 1) {
            echo '<script>alert("Deleted Successfuly ")</script>';
            header("Location: CertificationsAdmin.php");
            exit();}
        else {
            echo '<script>alert("User Does NOT exist !")</script>';
            header("Location: CertificationsAdmin.php");
            exit();
        
}
}
}

?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete certification</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>

<body>

    <header class="header">
        <a href="AdminPage.php" class="logo">Cyber Journey</a>

    </header>

    <section class="home">
        <div class="form-box">
            <h1 id="title">Delete certification</h1>
            <div style="font-size: small; color: rgb(236, 20, 20); background-color:  rgb(237, 237, 237); border-color: rgb(0, 0, 0);" id="error"></div>
            <div class="input-group">
                    <div class="input-field">
            <form method="post" id="form">
            <input type="text" class="text" name="id" maxlength="100" required placeholder="enter the ID to delete" class="box">
</div>
                <br>
                <div class="btn-field">
                    <button type="link"><a style="color: #fff;" href="CertificationsAdmin.php">Back</a></button>
                    <input type="submit" style ="background: rgb(32, 32, 90) ;"class = "delete" value="Delete" name="submit" class="btn">
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
            </form>
            </div>
    
    </div>
    </section>
</body>

</html>