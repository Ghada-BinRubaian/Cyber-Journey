<?php
session_start();

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome ADMIN </title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <video autoplay muted loop id="video-background">
    <source src="Background3.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
    <div id="video-content">
        <a href="AdminPage.php" class="logo">Cyber Journey</a>
        <nav class="navbar">
            <a href="AdminPage.php" class="active">Home</a>
            <a href="CertificationsAdmin.php">Certifications</a>
            <a href="CoursesAdmin.php">Courses</a>
            <a href="InternshipAdmin.php">Internships</a>
            <div class="dropdown">
              <button>Admin Account</button>
              <div class="content">
                  <a href="signout.php">Sign Out</a>
              </div>
        </nav>
</div>
    <section class="MainHomepage">
        <div class="MainHomepage-content">
            <h1>Welcome ADMIN </h1>
            <h2>Please select option to proceed </h2>
            <br><br>
            <div class="btn-box">
                <a href="createUser.php">Create User</a>
                <a href="viewUsers.php">View Users</a>
                <a href="DeleteUser.php">Delete User</a>
                </div>
        </div>
        <span class="MainHomepage-imgHover"></span>
    </section>

    <footer class="footer-distributed">
        <div class="footer-left">
          <a class="logo">Cyber Journey</span></a>
          <p class="footer-links">
            <a href="HomePage.html" class="active">Home</a>
            <a href="CertificationsUser.php">Certifications</a>
            <a href="CoursesUser.php">Courses</a>
            <a href="InternshipUser.php">Internships</a>
          </p>
  
          <p class="footer-company-name">Cyber Journey © 2024</p>
        </div>

        <div class="footer-center">
          <div>
            <i class="fa fa-map-marker"></i>
            <p><span>AlKhobar</span>Eastren Province, Saudi Arabia</p>
          </div>
  
          <div>
            <i class="fa fa-phone"></i>
            <p>+966566621866</p>
          </div>
  
          <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:support@company.com">support@CyberJourney.com</a></p>
          </div>
        </div>
  
        <div class="footer-right">
          <p class="footer-company-about">
            <span>About US</span>Cyber Journey will guide you to expand your knowledge in Cybersecurity field .
          </p>
        </div>
      </footer>
</body>

</html>