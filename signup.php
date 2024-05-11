<?php

function unique_id() {
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $rand = array();
    $length = strlen($str) - 1;
    for ($i = 0; $i < 20; $i++) {
        $n = mt_rand(0, $length);
        $rand[] = $str[$n];
    }
    return implode($rand);
};

$firstname = $_POST['firstname'];
$lasttname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = unique_id();

$conn = new mysqli('localhost','root','','cyberjourney');
$sql_email = "SELECT * FROM users WHERE email= '$email' ";
$res_e=mysqli_query($conn,$sql_email) or die (mysqli_error($conn));
if( mysqli_num_rows($res_e) > 0) {
        echo "<script>document.getElementById('error').innerHTML = 'Email already exists. Please choose a different email.';</script>";
        header("Location: signup.html");
    }
else {
        if($conn->connect_error){
            die('Connection Faild :' .$conn->connect_error);
        }
        else{
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users(id, firstname, lastname, gender, email, password) values(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $id, $firstname, $lasttname, $gender, $email, $hashed_password);
            $stmt->execute();
            echo '<script>alert("Account Created Successfully, Now sign in")</script>';
            header("Location: signin.html");
            $stmt->close();
            $conn->close();
    };

};


?>