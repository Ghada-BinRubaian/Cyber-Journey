<?php

include 'connect.php';


session_start();

if (!isset($_SESSION['id'])) {
    header("Location: signin.html");
    exit();
};if (isset($_GET['searchBar'])) {
  // Sanitize the input to prevent SQL injection
  $searchBar = htmlspecialchars($_GET['searchBar']);
  // Fetch certifications from the database that match the search query
  $select_certifecate = $conn->prepare("SELECT * FROM `certifications` WHERE `title` LIKE ?");
  $select_certifecate->execute(["%$searchBar%"]);
} else {
  // If no search query is provided, fetch all certifications
  $select_certifecate = $conn->prepare("SELECT * FROM `certifications`");
  $select_certifecate->execute();
}

$total_certifecates = $select_certifecate->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certifications</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="header">
        <a href="HomeLogin.html" class="logo">Cyber Journey</a>
        <nav class="navbar">
            <a href="HomeLogin.html" >Home</a>
            <a href="CertificationsUser.php" class="active">Certifications</a>
            <a href="CoursesUser.php">Courses</a>
            <a href="InternshipUser.php">Internships</a>
            <div class="dropdown">
              <button>UserAccount</button>
              <div class="content">
                <a href="UserProfile.php">User Profile</a>
                <a href="signout.php">Sign Out</a>
            </div>
            </div>
          </nav>
      </div>
      <br>
      <br>
</div>

    <section class="home">
	      <div class="home-content">
			      <h1>Popular Certifications</h1> <br> <br>
			      <h3>Discover the most sought-after Cybersecurity Certifications that can significantly bolster your career in the field. These certifications are designed to equip you with the essential skills and knowledge.</h3>
            <form id="searchForm" method="GET">
            <div class="search-container" style= "margin-left:110px;">
              <label  for="searchBar" >Search:</label>
              <input type="text" id="searchBar" name="searchBar" placeholder="Search for certification" value="<?php echo isset($_GET['searchBar']) ? $_GET['searchBar'] : ''; ?>">
              <button type="submit">Search</button>
            
          </div>
          </form>
          <style>
            
.search-container {
  position: relative;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 200px;
  height: 100%;
  background: transparent;
  border: 1px solid #ffffff;
  border-radius: 15px;
  font-size: 19px;
  color: #ffffff;
  text-decoration: none;
  font-weight: 400;
  letter-spacing: 1px;
  z-index: 1;
}

.search-container {
    display: flex;
    align-items: center;
}

.search-container label {
    color: #ffffff;
    font-weight: bold;
    font-size: 24px;
    margin-right: 10px;
}

.search-container input[type=text] {
    width: 300px;
    padding: 10px;
    outline: none;
    color: #ffffff;
    font-size: 16px;
    background-color: transparent;
}

.search-container input[type=text]::placeholder {
    color: #ffffff;
    opacity: 0.5;
}

.search-container button {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    background-color: #00abf0;
    color: #002F63;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

          </style>
</div>
</section>
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
				  <p><?=   $fetch_content['description'] ?></p>
			</div>
            <?php
           
        }
    }
   else{
echo '<p class="empty">no certifications added yet!</p>';
 }
?>
			
	</section>

    <footer class="footer-distributed">

        <div class="footer-left">
  
          <a class="logo">Cyber Journey</span></a>
          <p class="footer-links">
            <a href="HomeLogin.html" class="active">Home</a>
            <a href="CertificationsUser.php">Certifications</a>
            <a href="CoursesUser.php">Courses</a>
            <a href="InternshipUser.php">Internships</a>
            <a href="AboutUs.html">About Us</a>
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
