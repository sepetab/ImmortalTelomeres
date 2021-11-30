<!DOCTYPE html>
<html>
<head>
	<title>practitioners</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
</head>
<body>
    <header>
        <div class="container-header">
            <a HREF="mainpage.php"><div class="logo-container">
                <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                <p class="subtitle">HealthPortal</p>
            </div></a>
            <nav>
            <nav>
                <ul class="nav-ul">
                    <li class="nav-li"><a class="nav-a" href="mainpage.php">Home</a></li>
                    <li class="nav-li"><a class="nav-a" href="#">Information</a>
                        <ul>
                            <li><a class = "nav-a" href="patients.php">Patient List</a></li>
                            <li><a class = "nav-a" href="dietRegimes.php">Diet Regimes</a></li>
                            <li><a class = "nav-a" href="medications.php">Medication List</a></li>
                            <li><a class = "nav-a" href="practitioners.php">Practitioners</a></li>
                            <li><a class = "nav-a" href="#">Profile</a></li>
                        </ul>
                    </li>
                    <li class="nav-li"><a class="nav-a" href="#">Forms</a>
                        <ul>
                            <li><a class = "nav-a" href="newPatient.html">New Patient</a></li>
                            <li><a class = "nav-a" href="editPatient.html">Edit Patient</a></li>
                            <li><a class = "nav-a" href="newPrescription.html">New Prescription</a></li>
                            <li><a class = "nav-a" href="editPrescription.html">Edit Prescription</a></li>
                        </ul>
                    </li>
                    <li class="nav-li"><a class="nav-a" href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- normal sign in page  -->
    <div class="formContainer">
        <h1>Your profile</h1>
    </div>
        <div class="container">
            <table class="tableAdjust table-sortable" style="max-width:60%">
                <col style="width:10%">
                <col style="width:20%">
                <col style="width:20%">
                <col style="width:50%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Profile picture</th>
                    </tr>
                </thead>
                <!-- Exemplar data -->
                <tbody> 
                    <?php 
                    session_start();
                    $username = $_SESSION['user'];
                    $conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
                    $userQ = "SELECT * FROM Practitioner WHERE UserName = '$username'";
                    $user = odbc_exec($conn,$userQ);
                    while ($row = odbc_fetch_array($user)) {    
                        echo "<tr>";
                        echo "<td>" . $row['PractitionerID'] . "</td>";
                        echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
                        echo "<td>" . $row['UserName'] . "</td>";
                        echo "<td><img src='./Practitioners/" . $row['PractitionerID'] .".jpeg' alt='' height=100 width=100></img></td>";
                        echo "</tr>";
                        break;
                    }
                    ?>
                </tbody>
            </table>               
            <button class="inputBtn submit" style="margin:0 auto;margin-bottom:12em;">Edit Profile</button> 
        </div>
        
    </div>
    <footer>
            <div class="footer-container">
                <div>
                    <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                </div>
                <div class="middle-footer">
                    <p class="footer-title">HEALTHPORTAL</p>
                    <p class="footer-copyright">&copy; 2021 ImmortalTelomeres</p>
                </div>
                <div>
                    <p class="footer-title">CONTACT US</p>
                    <p class="footer-copyright">+61 432842728</p>
                    <p class="footer-copyright"><A class="footer-mail" HREF="mailto:enquires@hackerhealth.com">enquires@hackerhealth.com</a></p>
                </div>
            </div>
        </footer>
</body>
<script src="script/scriptSignin.js"></script>
</html>




