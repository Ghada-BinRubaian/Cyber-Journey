<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};
$select_certifecate = $conn->prepare("SELECT * FROM `certifications` WHERE AdminID=?");
$select_certifecate->execute([$_SESSION['A_id']]);

$total_certifecates = $select_certifecate->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Journey certifications</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <header class="header">
        <a href="AdminPage.php" class="logo">Cyber Journey</a>

        <nav class="navbar">
            <a href="AdminPage.php" >Home</a>
            <a href="CertificationsAdmin.php" class="active">Certifications</a>
            <a href="CoursesAdmin.php" >Courses</a>
            <a href="InternshipAdmin.php">Internships</a>
            <div class="dropdown">
              <button>Admin Account</button>
              <div class="content">
                  <a href="signout.php">Sign Out</a>
              </div>
        </nav>
    </header>

     <section class="home">
	    <div class="home-content">
			<h1>Popular Certefication</h1> <br> <br>
			<h3>Discover the most sought-after Cybersecurity Certifications that can significantly bolster your career in the field. These certifications are designed to equip you with the essential skills and knowledge.</h3>
      <br>
            <div class="btn-box">
                <a href="add_Certificate.php">add Certificate</a> 
                <a href="deleteCertificate.php">delete Certificate</a>
            </div>
            </div>
       
	</section>
    <br><br><br>
    <section class="categories"> 
  <div class="categories-content">
  <br><br><br>
		            <?php
            if($select_certifecate->rowCount() > 0){
            while($fetch_content = $select_certifecate->fetch(PDO::FETCH_ASSOC)){
            ?>  
        <div class="box">
				<a href=<?= $fetch_content['URL']; ?>> 
                    <img src='images/<?= $fetch_content['Photo']; ?>' alt="Clickable Image">
				<h3><?=  $fetch_content['title']; ?></h3>   
				<p><?=   $fetch_content['description'] ?></p></a>       
			</div>
            <?php
           
        }
    }
   else{
    echo '<h2 class="empty">no courses added yet!</h2>';
  }
?>
</div>
			
	</section>

    <footer class="footer-distributed">

        <div class="footer-left">
  
          <a class="logo">Cyber Journey</span></a>
          <p class="footer-links">
            <a href="HomeLogin.html" class="active">Home</a>
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
