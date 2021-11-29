<!DOCTYPE html>
<html>
<head>
	<title>DietRegimes</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
  <!-- SEARCH BAR ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php 
$conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
if(!$conn){exit("Connection Failed:". $conn);}
if(isset($_POST["NewDR"])){
    $pid = $_POST["PatientID"];
    $sDate = $_POST["startDate"];
    $fDate = $_POST["finishDate"];
    $morning = $_POST["morning"];
    $afternoon = $_POST["afternoon"];
    $evening = $_POST["evening"];
    $food = $_POST["Food"];
    $exercise = $_POST["Exercise"];
    $beauty = $_POST["Beauty"];

    echo $sDate;

    $time = "";
    if($morning=="on"){
        $morning = "M";
        $time = $time.$morning;
    }
    if($afternoon=="on"){
        $afternoon = "A";
        $time = $time.$afternoon;
    }
    if($evening=="on"){
        $evening = "N";
        $time = $time.$evening;
    }
    $insertQuery = "INSERT INTO DietRegime (DRID, PatientID, StartDate, EndDate, DietTime, Food, Exercise, Beauty) VALUES (1,'$pid','$sDate','$fDate','$time','$food','$exercise','$beauty')";
    $insert = odbc_exec($conn,$insertQuery);

    // Input Into DRScribe

    // Date array
    $begin = new DateTime($sDate);
    $end = new DateTime($fDate);
    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);


    // Time array
    $times = str_split($time);

    // Current DRID
    $getDid = "SELECT @@IDENTITY AS DID FROM DietRegime";
    $dide = odbc_exec($conn,$getDid);
    while ($row = odbc_fetch_array($dide)) {
        $did =  $row['DID'];
        break;
    }

    foreach ($period as $dt) {
        foreach ($times as $t){
            $dateToInsert = $dt->format("Y-m-d");
            
            //$insertQuery = "INSERT INTO DRScribe (PractitionerID,PatientID, DRDate, DRSTime, DRCheck, Refused,Notes, DRID) VALUES (0,'$pid','$dateToInsert','$t','ON','ON','','$did')";
            $dummyNotes = "hello";
            $insertQuery = "INSERT INTO DRScribe (PractitionerID,PatientID, DRDate, DRSTime, DRCheck, Refused,Notes, DRID) VALUES ('4','$pid','$dateToInsert','$t',1,1,'$dummyNotes','2')";
            //echo $insertQuery;
            $insert = odbc_exec($conn,$insertQuery);
        }
    }

}else if(isset($_POST["editDR"])){
    $pid = $_POST["PatientID"];
    $did = $_POST["DietID"];
    $sDate = $_POST["startDate"];
    $fDate = $_POST["finishDate"];
    $morning = $_POST["morning"];
    $afternoon = $_POST["afternoon"];
    $evening = $_POST["evening"];
    $food = $_POST["Food"];
    $exercise = $_POST["Exercise"];
    $beauty = $_POST["Beauty"];

    $time = "";
    if($morning=="on"){
        $morning = "M";
        $time = $time.$morning;
    }
    if($afternoon=="on"){
        $afternoon = "A";
        $time = $time.$afternoon;
    }
    if($evening=="on"){
        $evening = "N";
        $time = $time.$evening;
    }

    $updateQuery = "UPDATE DietRegime SET PatientID = $pid, StartDate = '$sDate', EndDate = '$fDate', DietTime = '$time' , Food = '$food' , Exercise = '$exercise' , Beauty = '$beauty' WHERE DRID = $did";
    $update = odbc_exec($conn,$updateQuery);

    // Edit DRScribe

    // Delete linked DRs
    $deleteQ = "DELETE * FROM DRScribe WHERE DRID=$did";
    $delete = odbc_exec($conn,$deleteQ);

    // Insert new info
     // Date array
     $begin = new DateTime($sDate);
     $end = new DateTime($fDate);
     $interval = DateInterval::createFromDateString('1 day');
     $period = new DatePeriod($begin, $interval, $end);
 
 
     // Time array
     $times = str_split($time);

     foreach ($period as $dt) {
        foreach ($times as $t){
            $dateToInsert = $dt->format("Y-m-d");
            $insertQuery = "INSERT INTO DRScribe (PatientID, DRDate, DRSTime, DRID, PractitionerID, DRCheck, Refused,Notes) VALUES ('$pid','$dateToInsert','$t','$did',0,0,0,' ')";
            $insert = odbc_exec($conn,$insertQuery);
        }
    }

}else if(isset($_POST["removeDR"])){
    $did = $_POST["DietID"];
    $deleteQuery = "DELETE * FROM DietRegime WHERE DRID = $did";
    $delete = odbc_exec($conn,$deleteQuery);

     // Delete linked DRs
     $deleteQ = "DELETE * FROM DRScribe WHERE DRID=$did";
     $delete = odbc_exec($conn,$deleteQ);
} 
?>


<body>
    <header>
        <div class="container-header">
            <a HREF="mainpage.html"><div class="logo-container">
                <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                <p class="subtitle">HealthPortal</p>
            </div></a>
            <nav>
                <ul class="nav-ul">
                    <li class="nav-li"><a class="nav-a" href="mainpage.html">Home</a></li>
                    <li class="nav-li"><a class="nav-a" href="#">Information</a>
                        <ul>
                            <li><a class = "nav-a" href="patients.php">Patient List</a></li>
                            <li><a class = "nav-a" href="#">Diet Regimes</a></li>
                            <li><a class = "nav-a" href="medications.php">Medication List</a></li>
                            <li><a class = "nav-a" href="practitioners.php">Practitioners</a></li>
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
        <h1>Diet Regimes</h1>
        <form class="inputForm" method = "post" action="dietRegimes.php" style="margin:auto;max-width:700px">
            <input type="text" placeholder="Enter Diet Regime ID" name="search2">
            <button class= "inputBtn submit" type="submit" name="search"><i class="fa fa-search"></i> Search for Diet Regime</button>
        </form>
    </div>
        <div>
            <p style="text-align:center;margin:0;">Key for Times column: M - Morning, A - Afternoon, N - Evening</p>
            <table class="tableAdjust table-sortable" style="max-width:90%">
                <col style="width:5%">
                <col style="width:8%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:7%">
                <col style="width:20%">
                <col style="width:20%">
                <col style="width:20%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Times</th>
                        <th>Food</th>
                        <th>Exercise</th>
                        <th>Beauty</th>
                        
                    </tr>
                </thead>
                <!-- Exemplar data -->
                <tbody> 
                    <?php 
                        if(isset($_POST["search"])){
                            $query = $_POST["search2"];
                            if(is_numeric($query)){
                                $searchQ = "SELECT * FROM DietRegime WHERE DRID = $query";
                            }else{
                                $searchQ = "SELECT * FROM DietRegime";
                            }
                            // echo $searchQ;
                            $searchResults = odbc_exec($conn,$searchQ);
                            while ($row = odbc_fetch_array($searchResults)) {    
                                echo "<tr>";
                                echo "<td>" . $row['DRID'] . "</td>";
                                echo "<td>" . $row['PatientID'] . "</td>";
                                echo "<td>" . $row['StartDate'] . "</td>";
                                echo "<td>" . $row['EndDate'] . "</td>";
                                echo "<td>" . $row['DietTime'] . "</td>";
                                echo "<td>" . $row['Food'] . "</td>";
                                echo "<td>" . $row['Exercise'] . "</td>";
                                echo "<td>" . $row['Beauty'] . "</td>";
                                echo "</tr>";
                            }

                        }else{
                            $DRsQ = "SELECT * FROM DietRegime";
                            $DRs = odbc_exec($conn,$DRsQ);
                            while ($row = odbc_fetch_array($DRs)) {    
                                echo "<tr>";
                                echo "<td>" . $row['DRID'] . "</td>";
                                echo "<td>" . $row['PatientID'] . "</td>";
                                echo "<td>" . $row['StartDate'] . "</td>";
                                echo "<td>" . $row['EndDate'] . "</td>";
                                echo "<td>" . $row['DietTime'] . "</td>";
                                echo "<td>" . $row['Food'] . "</td>";
                                echo "<td>" . $row['Exercise'] . "</td>";
                                echo "<td>" . $row['Beauty'] . "</td>";
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
