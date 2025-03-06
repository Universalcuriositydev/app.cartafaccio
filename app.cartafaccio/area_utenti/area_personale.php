<?php

session_start();
if (!isset($_SESSION['loggato'])|| $_SESSION['loggato']!==true) {
	header("location: ../index.php");
	exit;
}

?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Drop Down Sidebar Menu | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">CodingLab</span>
    </div>
    <ul class="nav-links">
      <li>
        <div class="iocn-link">
          <a href="index.html">
            <i class='bx bx-rocket'></i>
            <span class="link_name">Sistema solare</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Sistema solare</a></li>
          <li><a href="#">mercurio</a></li>
          <li><a href="#">venere</a></li>
          <li><a href="#">terra</a></li>
          <li><a href="#">marte</a></li>
          <li><a href="#">giove</a></li>
          <li><a href="#">saturno</a></li>
          <li><a href="#">urano</a></li>
          <li><a href="#">nettuno</a></li>
        </ul>
      </li>
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="img/man.png" alt="profileImg">
      </div>

      <div class="name-job">
        <div class="profile_name"><?php echo"Ciao ".$_SESSION['username']; ?></div>
        <div class="job">...</div>
      </div>
      <a href="../logout/logout.php">
      <i class='bx bx-log-out' ></i>
    </a>

    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Drop Down Sidebar</span>
    </div>
  </section>

  <script src="script.js"></script>

</body>
</html>
