<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['A_id'])) {
    header("Location: signin.html");
    exit();
};
$selectUser = $conn->prepare ("SELECT * From users");
$selectUser->execute();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
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
    <div class="containerWhite">
    <table>
    <thead>
      <tr>
        <th>User Id</th>
        <th>First Name</th>
        <th>last Name</th>
        <th>Gender</th>
        <th>E-mail</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <?php
                     while ($row = $selectUser->fetch(PDO::FETCH_ASSOC)) {
                     ?> 
                     <td><?php echo $row["id"]; ?></td>
                     <td><?php echo $row["firstname"]; ?></td>
                     <td><?php echo $row["lastname"]; ?></td>
                     <td><?php echo $row["gender"]; ?></td>
                     <td><?php echo $row["email"]; ?></td>
                     </tr>
                     <?php
                     }
                    ?>
        </tbody>
      </table>

        <br><br><br>
        <div class="btn-field">
             <a  href="AdminPage.php">Back</a>  
            
        </div>
            
   

      </div>
      </div>
      
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




<!--
       <div class="row">
         <div class="col">
           <div class="card">
             <div class="card-header">
                <h2 class="display-6 text-center">The Users Rigestered</h2>
             </div>
             <div class="card-body">
                <table class="table table-bordred text-center">
                    <tr class="bg-dark text-white">
                        <td> # </td>
                        <td> First Name</td>
                        <td> last Name</td>
                        <td> Gender </td>
                        <td> E-mail </td>
                    </tr>
                    <tr>
                    <?php
                     while ($row = $selectUser->fetch(PDO::FETCH_ASSOC)) {
                     ?> 
                     <td><?php echo $row["id"]; ?></td>
                     <td><?php echo $row["firstname"]; ?></td>
                     <td><?php echo $row["lastname"]; ?></td>
                     <td><?php echo $row["gender"]; ?></td>
                     <td><?php echo $row["email"]; ?></td>
                     </tr>
                     <?php
                     }
                    ?>
                </table>
             </div>
           </div>
         </div>
       </div>
    </div> 
    <button type="link" style="
    position: center;
    background: rgb(14, 14, 43) ;
    color: #fff;
    height: 45px;
    width: 1270px;
    border-radius: 20px;
    border-color: #fff;
    cursor: pointer;
    transition: background 1s;"><a style="color: #fff;" href="aPage.html">Back</a></button>
 </div>
    <div class="btn-field" style="right: 80px;">
      -->