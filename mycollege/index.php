<?php
include_once('user/includes/dbconnection.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
<title>Ma. Asuncion Rodriguez Tinga High School</title>
<link rel="stylesheet" href="css/style.css"/>
<link rel="shortcut icon" href="images/logo2.png"/>
</head>
<body>
    <section class="main" style="background-image: url(images/hero-bg.png); height:100vh;">
        <nav>
            <a href="index.php" class="logo">
                <img src="images/logo1.png" class="image1" width="320px" />
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px;">
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About </a></li>
                <li><a href="#strands">Strands</a></li>
                <li><a class="active" href="user/signup.php" onclick="document.getElementById('id01').style.display='block'" style="width:auto; border-radius: 5px; cursor: pointer;">Sign Up</a></li>
                <li><a class="active" href="user/login.php" onclick="document.getElementById('id01').style.display='block'" style="width:auto; border-radius: 5px; cursor: pointer;">sign in</a></li>
            </ul>
        </nav>
        <div class="home-content">
            <div class="home-text" >
                <h3 style="color: white; letter-spacing: 3px;">Welcome!</h3>
                <h1 style="color: white;"> MARTMHS</h1>
                <p style="color: white;">Maria Asuncion Rodriguez Tiñga Memorial High School is a child-friendly and environmentally-caring institution which aims to produce academically competitive and multi-talented learners, equipped with livelihood skills, with a sense of service to God and to humanity. </p>
            <a href="user/signup.php" class="main-login" style="border-radius: 5px;">Apply Now</a>
            </div>
            <div class="home-img" style="width: 500px;">
                <img src="images/logo2.png" width="500px" style="text-shadow: 20px 22px;"/>
            </div>
        </div>
        <section class="notification">
            <hr>
            <marquee behavior="alternate" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
                <?php $query=mysqli_query($con,"select * from tblnotice");
            while ($row=mysqli_fetch_array($query)) {
            ?>
                <a href="notice-details.php?nid=<?php echo $row['ID'];?>" target="_blank"><?php echo $row['Title'];?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                <?php } ?>
</marquee>
    </section>
    <hr>
    </section>
    <hr>
    <section class="services" id="about">
        <div class="services-heading">
            <h2>ABOUT US</h2>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="images/icon5.png">
                <font>MISSION</font>
                <p>To provide an education that will enhance the development of character to foster international understanding and deliver life long skills and knowledge to diversified learners in a changing way of environment.</p>
            </div>
            <div class="box">
                <img src="images/icon5.png">
                <font>VISION</font>
                <p>A distinctively value laden school committed to mold the character and develop world-class holistic learners responsive to the challenges of the 21st century.</p>
            </div>
            <div class="box">
                <img src="images/icon5.png">
                <font>CORE VALUES</font>
                <p>Character, Competence, Community Spirit, Culture of Excellence</p>
            </div>
            <div class="box">
                <img src="images/icon5.png">
                <font>GOALS</font>
                <p>Encourage Involvement of Diversified Learners in all undertakings. Achieve peak performance academic and non academic pursuits. Safeguard that the learning competitive and proactive to the demands of 21st century.</p>
            </div>
        </div>
    </section>
    <section class="services" id="strands">
        <div class="services-heading">
            <h2>OUR STRANDS</h2>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="images/icon5.png">
                <font>HUMSS</font>
                <p>Humanities and Social Sciences is a strand offered to senior high school students under the Academics track. The HUMSS Senior High School strand is designed for students who intend to take up journalism, communication arts, liberal arts, education, and other social-science related courses in college.</p>
                <a href="user/signup.php">Apply Now</a>
            </div>
            <div class="box">
                <img src="images/icon5.png">
                <font>GAS</font>
                <p>General Academic Strand caters students who are not yet sure of what course or degree they want to take in college. This strand was designed so that indecisive learners can proceed with any college program.</p>
                <a href="user/signup.php">Apply Now</a>
            </div>
            <div class="box">
                <img src="images/icon5.png">
                <font>TVL</font>
                <p>TVL Strand is designed to develop students' skills that is useful for livelihood and technical projects. It provides a curriculum that is a combination of Core Courses and specialized hands-on courses that meets the competency-based assessment of TESDA.</p>
                <a href="user/signup.php">Apply Now</a>
            </div>
        </div>
    </section>
    <footer>
        <p>Copyright (C) - 2021 | Developed By CS D2019</a> </p>
    </footer>
</body>
</html>