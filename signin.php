<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db_name = 'mysql:host=localhost;dbname=cyberjourney';
    $user_name = 'root';
    $user_password = '';
    $conn = new PDO($db_name, $user_name, $user_password);
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare and execute the query for users
    $query = "SELECT  id , email , password FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header("Location: HomeLogin.html");
            exit();
        }
    }
}

    // Prepare and execute the query for admins
    $query = "SELECT  Admin_id, email , password FROM admins WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['A_id'] = $admin['Admin_id'];
        header("Location: VerifyAdmin.php");
        exit();
    } else {
        echo '<script>alert("E-mail or Password Entered incorrect, please try again");</script>';
        $_SESSION = array();
        session_destroy();
        header("Location: signin.html");
    }

    $conn = null; // Close the connection
?>
