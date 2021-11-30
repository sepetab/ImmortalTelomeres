<!DOCTYPE html>
<?php session_start(); ?>
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <html>
        <head>
            <title>Practioner Directory</title>
            <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
            <link href="css/style.css" rel="stylesheet">
        </head>
        <body>
            <header>
                <div class="container-header">
                <a HREF="mainpage.php"><div class="logo-container">
                    <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                    <p class="subtitle">HealthPortal</p>
                    </div></a>
                    <nav>
                        <ul class="nav-ul">
                            <li class="nav-li"><a class="nav-a" href="mainpage.php">Home</a></li>
                            <li class="nav-li"><a class="nav-a" href="#">Information</a>
                                <ul>
                                    <li><a class = "nav-a" href="patients.php">Patient List</a></li>
                                    <li><a class = "nav-a" href="dietRegimes.php">Diet Regimes</a></li>
                                    <li><a class = "nav-a" href="medications.php">Medication List</a></li>
                                    <li><a class = "nav-a" href="practitioners.php">Practitioners</a></li>
                                    <li><a class = "nav-a" href="profile.php">Profile</a></li>
                                </ul>
                            </li>
                            <li class="nav-li"><a class="nav-a" href="#">Forms</a>
                                <ul>
                                    <li><a class = "nav-a" href="newPatient.php">New Patient</a></li>
                                    <li><a class = "nav-a" href="editPatient.php">Edit Patient</a></li>
                                    <li><a class = "nav-a" href="newPrescription.php">New Prescription</a></li>
                                    <li><a class = "nav-a" href="editPrescription.php">Edit Prescription</a></li>
                                </ul>
                            </li>
                            <li class="nav-li"><a class="nav-a" href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class="sepContainer">
                <div class ="filtContainer">
                    <form id="filtForm" class="filtForm" method="post" action="mainpage.php">
                        <ul class="filtFormUl">
                            <li class="filtFormLi"><input class="formInput" style="border-bottom: 2px solid rgba(109, 93, 93, 0.4)" type="date" id="filtDate" name="FilterDate" required></li>
                            <li class="filtFormLi"><select id="filtTime" name="FilterTime" required>
                                <option value="M">Morning</option>
                                <option value="A">Afternoon</option>
                                <option value="N">Evening</option>
                            </select>
                            </li>
                            <li class="filtFormLi"><select id="choiceType" name="FilterType" required>
                                <option value="Medication">Medication</option>
                                <option value="Dietary">Dietary</option>
                            </select>
                            </li>
                        </ul>
                        <button class="filterBtn submit" type="submit" name="Filter">Filter</button>
                    </form>
                </div>
                <!--div class="searchContainer">
                    <form id="searchForm" class="searchForm">
                        <li class = "filtFormLi" style="max-width:150px;"><input class="searchInput" type="text" id="searchInput" name="Searchinput" placeholder="Insert search requirements"></li>
                        <button class="searchBtn submit" style="max-width:150px;" type="submit" name="Search">Search</button>
                    </form>
                </div-->
                <div class="searchContainer">
                    <form id="searchForm" class="searchForm" method="post" action="mainpage.php">
                        <li class = "filtFormLi" style="max-width:150px;"><input class="searchInput" type="text" id="searchInput" name="Searchinput" placeholder="Insert search requirements"></li>
                        <button class="searchBtn submit" style="max-width:150px;" type="submit" name="Search">Search</button>
                    </form>
                </div>
            </div>
            <!-- <p class="mainLeg">Key for Times column: M - Morning, A - Afternoon, N - Evening</p> -->


            <div class="container">
                <?php 
                //$conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
                //using my zID instead of Aravinds
                $conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
                if(!$conn){exit("Connection Failed:". $conn);}
                
                $newSearch = 0;
                //We check if anything was search for
                if(isset($_POST["Search"])){
                    $newSearch = 0;
                    //When they search for something, we check if it is letters or numbers
                    $searchInput = $_POST["Searchinput"];
                    if($searchInput){
                        $newSearch = 1;
                    }
                };
            
            
                if(isset($_POST['Filter'])){
                    $filterTime = $_POST['FilterTime'];
                    $filterDate = $_POST['FilterDate'];
                    $type = $_POST['FilterType'];

                }else if(isset($_POST['updateSubmission'])){
                    

                    $filterTime = $_POST['ftime'];
                    $filterDate = $_POST['fdate'];
                    $type = $_POST['ftype'];

                    if($type == "Medication"){
                        $mid = $_POST['fmid'];
                    }else{
                        $did = $_POST['fdrid'];
                    }
                    
                    $performed = 0;
                    $refused = 0;
                    if(isset($_POST['performed'])){
                        // print("Switching on");
                        $performed = 1;
                    }
                    if(isset($_POST['refused'])){
                        // print("Refusal on");
                        $refused = 1;
                    }

                    $pracID = $_SESSION['userID'];


                    if(isset($_POST['Notes'])){
                        $notes = $_POST['Notes'];
                    }else{
                        $notes = " ";
                    }

                    if($type == "Medication"){
                        //this is what is should be like
                        //$updateQuery = "UPDATE MedicationScribe SET PractitionerID = $pracID , MedicationCheck = $performed, Refused = $refused, Notes = '$notes' WHERE MedID = $mid AND MedDate = #$filterDate# AND MedTime = '$filterTime'";
                        //$updateQuery = "UPDATE MedicationScribe SET PractitionerID = $pracID , MedicationCheck = $performed, Refused = $refused, Notes = '$notes' WHERE MedTime = '$filterTime' AND MedDate = #$filterDate#";
                        $updateQuery = "UPDATE MedicationScribe SET PractitionerID = $pracID , MedicationCheck = $performed, Refused = $refused , Notes = '$notes' WHERE MedID = $mid AND MedTime = '$filterTime' AND MedDate = #$filterDate#";
                        $update = odbc_exec($conn,$updateQuery);
                    }else{
                        $updateQuery = "UPDATE DRScribe SET PractitionerID = $pracID , DRCheck = $performed, Refused = $refused, Notes = '$notes' WHERE DRID = $did AND DRDate = #$filterDate# AND DRSTime = '$filterTime'";
                        $update = odbc_exec($conn,$updateQuery);
                    }
                }else{
                    $filterTime = 'M';
                    $filterDate = date("Y-m-d");
                    //changing format of date to match my database.
                    //$filterDate = date("d-m-Y");
                    $type = "Medication";
                }
                /////////////////////////////
                
                /////////////////////////////
                ?>
                <!-- Set appropriate filters -->        
                <?php if(isset($_POST['Filter'])): ?>
                    <script>
                        function setFilters(){
                            var time = "<?php echo $filterTime; ?>";
                            var date = "<?php echo $filterDate; ?>";
                            var choice = "<?php echo $type; ?>";
                            // $filterTime = $_POST['FilterTime'];
                            // $filterDate = $_POST['FilterDate'];
                            // $type = $_POST['FilterType'];
                            document.getElementById('filtTime').value = time
                            document.getElementById('filtDate').value = date
                            document.getElementById('choiceType').value = choice
                        }
                        setFilters()
                    </script>
                    <?php endif; ?> 

                <!-- Medication -->
                <script>
                        var time = "<?php echo $filterTime; ?>";
                        var date = "<?php echo $filterDate; ?>";
                        var choice = "<?php echo $type; ?>";
                        document.getElementById('filtTime').value = time
                        document.getElementById('filtDate').value = date
                        document.getElementById('choiceType').value = choice
                </script>
                <?php if($type == 'Medication'): ?>
                    <div id="MedTable">
                        <table style="border: 0" class="table table-sortable">
                            <col style="width:11%">
                            <col style="width:11%">
                            <col style="width:8%">
                            <col style="width:7%">
                            <col style="width:11%">
                            <col style="width:15%">
                            <col style="width:15%">
                            <col style="width:15%">
                            <col style="width:7%">
                            <thead>
                                <tr>
                                    <th>Practioner</th>
                                    <th>Patient</th>
                                    <th>Medication Check</th>
                                    <th>Refused</th>
                                    <th>Notes</th>
                                    <th>Medicine Name</th>
                                    <th>Dosage</th>
                                    <th>Route of Administration</th>
                                    <th class="doneCheck"></th>
                                </tr>
                            </thead>

                            <tbody> 
                                    <?php
                                    //First check if the user has searched for a number or word
                                    if($newSearch){
                                            if(is_numeric($searchInput)){
                                                //just add the patient id as an extra condition to query
                                                $MQ = "SELECT * FROM MedicationScribe WHERE MedTime = '$filterTime' AND PatientID = $searchInput AND MedDate = #$filterDate#";
                                            }
                                            if(!is_numeric($searchInput)){
                                                $MQ = "SELECT * FROM MSJoinedP WHERE MedTime = '$filterTime' AND MedDate = #$filterDate# AND (UCase(FirstName) ='" . strtoupper($searchInput) . "' OR Ucase(LastName) ='" . strtoupper($searchInput ) . "')";
                                            
                                            }
                                            $newSearch = 0;
                                    }else{
                                            $MQ = "SELECT * FROM MedicationScribe WHERE MedTime = '$filterTime' AND MedDate = #$filterDate#";
                                    }
                            
                                
                                    $ms = odbc_exec($conn,$MQ);

                                    while ($row = odbc_fetch_array($ms)) { 
                                        echo "<tr>";
                                        echo "<form id='formMed' method='post' action = 'mainpage.php'>";
                                            // Get practitioner Info
                                            if ($row['PractitionerID'] == 0){
                                                echo "<td>N/A</td>";
                                            }else{
                                                $getPrac = "SELECT * FROM Practitioner WHERE PractitionerID = " . $row['PractitionerID'];
                                                $pracs = odbc_exec($conn,$getPrac);
                                                while ($pracRow = odbc_fetch_array($pracs)) {
                                                    $inputVal = $pracRow['PractitionerID'] . " " . $pracRow['FirstName'] . " " . $pracRow['LastName'];
                                                    break;
                                                }
                                                echo "<td> $inputVal </td>";
                                            }

                                            // Get patient Info
                                            $getPat = "SELECT * FROM Patient WHERE PatientID = " . $row['PatientID'];
                                                $pats = odbc_exec($conn,$getPat);
                                                while ($patRow = odbc_fetch_array($pats)) {
                                                    $inputVal = $patRow['PatientID'] . " " . $patRow['FirstName'] . " " . $patRow['LastName'];
                                                    break;
                                                }
                                            echo "<td> $inputVal </td>";
                                            // Set Checkboxes
                                            if($row['MedicationCheck'] == 0){
                                                echo "<td><input name='performed' type='checkbox'></td>";
                                            }else{
                                                echo "<td><input name='performed' type='checkbox' checked></td>";
                                            }

                                            if($row['Refused'] == 0){
                                                echo "<td><input name='refused' type='checkbox'></td>";
                                            }else{
                                                echo "<td><input name='refused' type='checkbox' checked></td>";
                                            }

                                            // Notes
                                            echo  "<td><textarea class='noteText' name'Notes'>" . $row['Notes'] ."</textarea></td>";
                                            
                                            // Medication information - Food
                                        $getInfo = "SELECT * FROM Medication WHERE MedID = " . $row['MedID'];
                                        
                                            $infos = odbc_exec($conn,$getInfo);
                                            while ($infoRow = odbc_fetch_array($infos)) {
                                                $inputMedName = $infoRow['MedName'];
                                                $inputDosage = $infoRow['Dosage'];
                                                $inputROA = $infoRow['ROA'];
                                                break;
                                            }
                                        echo "<td> $inputMedName </td>";
                                        echo "<td> $inputDosage </td>";
                                        echo "<td> $inputROA </td>";

                                        // Get some essential information across
                                        // echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='ftime' >" . $filterTime ."</textarea></td>";
                                        echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='ftime' >" . $filterTime ."</textarea></td>";
                                        echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='fmid' >" . $row['MedID'] ."</textarea></td>";
                                        echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='ftype' >" . $type ."</textarea></td>";
                                        echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='fdate' >" . $filterDate ."</textarea></td>";
                                        /*echo "<input type='text' name='fdate' style='display:none;' value='$filterDate'>";
                                        echo "<input type='text' name='fmedid' style='display:none;' value='$MedID'>";
                                        echo "<input type='text' name='ftime' style='display:none;' value='$filterTime'>";
                                        echo "<input type='text' name='ftype' style='display:none;' value='$type'>";*/
                                        
                                        // Submit
                                        echo "<td class='doneCheck'><button class='doneBtn submit' type='submit' name='updateSubmission'>Update</button></td>";
                                        echo "</form>";
                                    echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>                
                    </div>
                </main>

                <?php else: ?>
                <!-- Dietary section -->
                    <div id = "DRTable">
                        <table style="border: 0" class="table table-sortable">
                            <col style="width:11%">
                            <col style="width:11%">
                            <col style="width:8%">
                            <col style="width:7%">
                            <col style="width:11%">
                            <col style="width:15%">
                            <col style="width:15%">
                            <col style="width:15%">
                            <col style="width:7%">
                            <thead>
                                <tr>
                                    <th>Practitioner</th>
                                    <th>Patient</th>
                                    <th>Dietary Check</th>
                                    <th>Refused</th>
                                    <th>Notes</th>
                                    <th>Food</th>
                                    <th>Exercise</th>
                                    <th>Beauty</th>
                                    <th class="doneCheck"></th>
                                </tr>
                            </thead>
                            <!-- Exemplar data -->
                            <tbody> 
                                <?php

                                //First check if the user has searched for a number or word
                                if($newSearch){
                                    if(is_numeric($searchInput)){
                                        //just add the patient id as an extra condition to query
                                        $DRQ = "SELECT * FROM DRScribe WHERE DRSTime = '$filterTime' AND PatientID = $searchNumber AND DRDate = #$filterDate#";
                                    }
                                    if(!is_numeric($searchInput)){
                                        $DRQ = "SELECT * FROM DRJoinedP WHERE DRSTime = '$filterTime' AND DRDate = #$filterDate# AND (UCase(FirstName) ='" . strtoupper($searchInput) . "' OR Ucase(LastName) ='" . strtoupper($searchInput ) . "')";
                                    
                                    }
                                    $newSearch = 0;
                                }else{
                                    $DRQ = "SELECT * FROM DRScribe WHERE DRSTime = '$filterTime' AND DRDate = #$filterDate#";
                                }
                                $drs = odbc_exec($conn,$DRQ);
                                while ($row = odbc_fetch_array($drs)) {   
                                    echo "<tr>";
                                        echo "<form id='formDR' method='post' action = 'mainpage.php'>";
                                            // Get practitioner Info
                                            if ($row['PractitionerID'] == 0){
                                                echo "<td>N/A</td>";
                                            }else{
                                                $getPrac = "SELECT * FROM Practitioner WHERE PractitionerID = " . $row['PractitionerID'];
                                                $pracs = odbc_exec($conn,$getPrac);
                                                while ($pracRow = odbc_fetch_array($pracs)) {
                                                    $inputVal = $pracRow['PractitionerID'] . " " . $pracRow['FirstName'] . " " . $pracRow['LastName'];
                                                    break;
                                                }
                                                echo "<td><a href='profile.php'> $inputVal </a></td>";
                                            }

                                            // Get patient Info
                                            $getPat = "SELECT * FROM Patient WHERE PatientID = " . $row['PatientID'];
                                            // echo $getPat;
                                                $pats = odbc_exec($conn,$getPat);
                                                while ($patRow = odbc_fetch_array($pats)) {
                                                    $inputVal = $patRow['PatientID'] . " " . $patRow['FirstName'] . " " . $patRow['LastName'];
                                                    break;
                                                }
                                            echo "<td> $inputVal </td>";

                                            // Set Checkboxes
                                            if($row['DRCheck'] == 0){
                                                echo "<td><input name='performed' type='checkbox'></td>";
                                            }else{
                                                echo "<td><input name='performed' type='checkbox' checked value=1></td>";
                                            }

                                            if($row['Refused'] == 0){
                                                echo "<td><input name='refused' type='checkbox'></td>";
                                            }else{
                                                echo "<td><input name='refused' type='checkbox' checked value=1></td>";
                                            }
                                            // Notes
                                            echo  "<td><textarea class='noteText' name='Notes' >" . $row['Notes'] ." </textarea></td>";
                                    

                                            // DR information - Food
                                            $getInfo = "SELECT * FROM DietRegime WHERE DRID = " . $row['DRID'];
                                                $infos = odbc_exec($conn,$getInfo);
                                                while ($infoRow = odbc_fetch_array($infos)) {
                                                    $inputFood = $infoRow['Food'];
                                                    $inputExercise = $infoRow['Exercise'];
                                                    $inputBeauty = $infoRow['Beauty'];
                                                    break;
                                                }
                                            echo "<td> $inputFood </td>";
                                            echo "<td> $inputExercise </td>";
                                            echo "<td> $inputBeauty </td>";


                                            echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='ftime' >" . $filterTime ."</textarea></td>";
                                            echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='fdrid' >" . $row['DRID'] ."</textarea></td>";
                                            echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='ftype' >" . $type ."</textarea></td>";
                                            echo  "<td style='display:none;'><textarea class='noteText' style='display:none;' name='fdate' >" . $filterDate ."</textarea></td>";
                                            

                                            // Submit
                                            echo "<td class='doneCheck'><button class='doneBtn submit' type='submit' name='updateSubmission'>Update</button></td>";
                                        echo "</form>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>  
                    <?php endif; ?>              
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
            <script src="script/scriptTableSort.js"></script>
            <script src="script/scriptUpdate.js"></script>
            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
        </body>
    </html>
<?php else: ?>
    <html>
        <h1>Unauthorized access, login required. Click <a href="loginFirst.html">here</a> to login.</h1>
    </html>
<?php endif; ?>
