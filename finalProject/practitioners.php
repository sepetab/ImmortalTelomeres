<!DOCTYPE html>
<html>
<head>
	<title>practitioners</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
  <!-- SEARCH BAR ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="container-header">
            <a HREF="mainpage.html"><div class="logo-container">
                <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                <p class="subtitle">HealthPortal</p>
            </div></a>
            <nav>
            <nav>
                <ul class="nav-ul">
                    <li class="nav-li"><a class="nav-a" href="mainpage.html">Home</a></li>
                    <li class="nav-li"><a class="nav-a" href="#">Information</a>
                        <ul>
                            <li><a class = "nav-a" href="patients.php">Patient List</a></li>
                            <li><a class = "nav-a" href="dietRegimes.php">Diet Regimes</a></li>
                            <li><a class = "nav-a" href="medications.php">Medication List</a></li>
                            <li><a class = "nav-a" href="#">Practitioners</a></li>
                            <li><a class = "nav-a" href="profile.php">Profile</a></li>
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
                    <li class="nav-li"><a class="nav-a" href="loginFirst.html">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- normal sign in page  -->
    <div class="formContainer">
        <h1>Practitioner list</h1>
        <form class="inputForm" method = "post" action="practitioners.php" style="margin:auto;max-width:700px">
            <input type="text" placeholder="Enter Practitioner's First Name, Last Name, UserName or ID" name="search2">
            <button style="width: 310px" class="inputBtn submit" type="submit" name="search"><i class="fa fa-search"></i> Search for practitioner</button>
        </form>
    </div>

        <div>
            <table class="table table-sortable" style="max-width:60%">
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
                    $conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
                        if(isset($_POST["search"])){
                            $query = $_POST["search2"];
                            if($query){
                                if(is_numeric($query)){
                                    $searchQ = "SELECT * FROM Practitioner WHERE PractitionerID = $query";
                                }else{
                                    $searchQ = "SELECT * FROM Practitioner WHERE UCase(UserName ) ='" . strtoupper($query) . "' OR UCase(FirstName) ='" . strtoupper($query) . "' OR Ucase(LastName) ='" . strtoupper($query) . "'";
                                }
                            }else{
                                $searchQ = "SELECT * FROM Practitioner";
                            }
                            // echo $searchQ;
                            $searchResults = odbc_exec($conn,$searchQ);
                            while ($row = odbc_fetch_array($searchResults)) {    
                                echo "<tr>";
                                echo "<td>" . $row['PractitionerID'] . "</td>";
                                echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
                                echo "<td>" . $row['UserName'] . "</td>";
                                echo "<td><img src='./Practitioners/" . $row['PractitionerID'] .".jpeg' alt='' height=100 width=100></img></td>";
                                echo "</tr>";
                            }

                        }else{
                            $practitionersQ = "SELECT * FROM Practitioner";
                            $practitioners = odbc_exec($conn,$practitionersQ);
                            while ($row = odbc_fetch_array($practitioners)) {    
                                echo "<tr>";
                                echo "<td>" . $row['PractitionerID'] . "</td>";
                                echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
                                echo "<td>" . $row['UserName'] . "</td>";
                                echo "<td><img src='./Practitioners/" . $row['PractitionerID'] .".jpeg' alt='' height=100 width=100></img></td>";
                                echo "</tr>";
                            }
                        }
                        
                    
                    ?>
                </tbody>
            </table>                
        </div>
    </div>
    <footer>
            <div class="footer-container">
                <div>
                    <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                </div>
                <div class="middle-footer">
                    <p class="footer-title">HEALTHPortal</p>
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
