<?php
session_start();

include 'connect.php';
if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};

if(isset($_POST['submit'])){

   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $provider = $_POST['provider'];
   $provider = filter_var($provider, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/'.$rename;
   $URL = $_POST['URL'];
   $URL = filter_var($URL, FILTER_SANITIZE_STRING);

   $add_Course = $conn->prepare("INSERT INTO `certifications`( AdminID, title, description, id, Photo, URL, status, Provider) VALUES(?,?,?,?,?,?,?,?)");
   $add_Course->execute([$_SESSION['A_id'], $title, $description,$id, $rename, $URL , $status,$provider]);

   move_uploaded_file($image_tmp_name, $image_folder);

   $message[] = 'new Certificate uploaded!';  
   header("Location: CertificationsAdmin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Certificate</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="sign.css">

</head>
<body>  
    <video autoplay muted loop id="video-background">
        <source src="Background3.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div id="video-content">
        <section class="MainHomepage">
            <div class="MainHomepage-content">
                <div class="MainHomepage-container">
                    <div class="form-box">
                    <h1 id="title">Add Certificate</h1>
                    <div style="font-size: small; color: rgb(236, 20, 20); background-color:  rgb(237, 237, 237); border-color: rgb(0, 0, 0);" id="error"></div>
                    <form action="" method="post" enctype="multipart/form-data" id="form">
                    <pre>Certificate status: <select name="status" required>
                    <option value="" selected disabled>-- select status</option>
                    <option value="active">active</option>
                    <option value="deactive">deactive</option>
                    </select>
                    </pre>
                  
                    <input type="text" class="text" name="title" maxlength="100" required placeholder="enter Certificate Title" class="box">
                    <input type="text" class="text" name="provider" maxlength="100" required placeholder="enter Certificate provider" class="box">

                    
                    <input type="text" class="text" name="description" class="box" maxlength="1000" required placeholder="write description" >
                    
                    <pre>Certificate Photo:    <input type="file" class="text" name="image" accept="image/*" >
                    </pre>
                    <input type="url"  class="text" name="URL" maxlength="100" required placeholder="enter Certificate Link" class="box">
                    
                    <div class="btn-field">
                    <button type="link"><a style="color: #fff;" href="CertificationsAdmin.php">Back</a></button>
                    <input type="submit" class = "add" value="Add Certificate" name="submit" class="btn">
                    </div>
                <style>
            pre{
    color: #999;
    font-size: 15px;
    background: #eaeaea;
    margin: 15px 0;
    border-radius: 3px;
    display: flex;
    align-items: center;
    max-height: 65px;
    transition: max-height 0.5s;
    overflow: hidden;
}
            .text{
    background: #eaeaea;
    margin: 15px 0;
    border-radius: 3px;
    display: flex;
    align-items: center;
    max-height: 65px;
    transition: max-height 0.5s;
    overflow: hidden;
}
.add{
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
select{
    background: #eaeaea;
    margin: 15px 0;
    border-radius: 3px;
    display: flex;
    align-items: center;
    max-height: 65px;
    transition: max-height 0.5s;

}
        /* Added CSS */
        .radioBtn label {
            display: inline-block;
            margin-right: 20px;
        }

        .radioBtn input[type="radio"] {
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
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

<script src="../js/admin_script.js"></script>

</body>
</html>