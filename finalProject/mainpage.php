<!DOCTYPE html>
<html>
    <head>
        <title>Practioner Directory</title>
        <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet"> 
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="container-header">
              <a HREF="mainpage.html"><div class="logo-container">
                  <img src="img/logo2.png" class="logo" alt="Heart with stethoscope"/>
                  <p class="subtitle">HealthPortal</p>
                </div></a>
                <nav>
                    <ul class="nav-ul">
                        <li class="nav-li"><a class="nav-a" href="#">Home</a></li>
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
        <div class="sepContainer">
            <div class ="filtContainer">
                <form id="filtForm" class="filtForm" method="post" action="mainpage.php">
                    <ul class="filtFormUl">
                        <li class="filtFormLi"><input class="formInput" style="border-bottom: 2px solid rgba(109, 93, 93, 0.4)" type="date" id="filtDate" name="FilterDate"></li>
                        <li class="filtFormLi"><select id="filtTime" name="FilterTime">
                            <option value="M">Morning</option>
                            <option value="A">Afternoon</option>
                            <option value="N">Evening</option>
                        </select>
                        </li>
                        <li class="filtFormLi"><select id="choiceType" name="FilterType">
                            <option value="Medication">Medication</option>
                            <option value="Dietary">Dietary</option>
                        </select>
                        </li>
                    </ul>
                    <button class="filterBtn submit" type="submit" name="Filter">Filter</button>
                </form>
            </div>
            <div class="searchContainer">
                <form id="searchForm" class="searchForm">
                    <li class = "filtFormLi"><input class="searchInput" type="text" id="searchInput" name="Search input" placeholder="Insert search requirements"></li>
                    <button class="searchBtn submit" type="submit" name="Search">Search</button>
                </form>
            </div>
        </div>
        <p class="mainLeg">Key for Times column: M - Morning, A - Afternoon, N - Evening</p>


        <div class="container">
            <?php 
            $conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
            if(!$conn){exit("Connection Failed:". $conn);}

            if(isset($_POST['Filter'])){
                $filterTime = $_POST['FilterTime'];
                $filterDate = $_POST['FilterDate'];
                $type = $_POST['FilterType'];

            }else if(isset($_POST['updateSubmission'])){
                

                $filterTime = $_POST['ftime'];
                $filterDate = $_POST['fdate'];
                $type = $_POST['ftype'];

                if($type == "Medication"){

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
                $notes = $_POST['Notes'];
                if($type == "Medication"){

                }else{
                    $updateQuery = "UPDATE DRScribe SET DRCheck = $performed, Refused = $refused, Notes = '$notes' WHERE DRID = $did AND DRDate = #$filterDate# AND DRSTime = '$filterTime'";
                    $update = odbc_exec($conn,$updateQuery);
                }
            }else{
                $filterTime = 'M';
                $filterDate = date("Y-m-d");
                $type = "Medication";
            }
            ?>
            <!-- Medication -->
            <?php if($type == 'Medication'): ?>
                <div id="MedTable">
                    <table style="border: 0" class="table table-sortable">
                        <col style="width:11%">
                        <col style="width:11%">
                        <col style="width:8%">
                        <col style="width:7%">
                        <col style="width:30%">
                        <col style="width:7%">
                        <col style="width:7%">
                        <col style="width:10%">
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
                        <!-- Exemplar data -->
                        <tbody> 
                            <tr>
                                <form id="formM">
                                    <td>5 FENG Clayton</td>
                                    <td>26 SMITH John</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><textarea class="noteText">He likes to swim.</textarea></td>
                                    <td>Pills</td>
                                    <td>2</td>
                                    <td>Oral</td> 
                                    <td class="doneCheck"><button class="doneBtn submit" type="submit" name="Submit Details">Update</button></td>  
                                </form>
                            </tr>
                            <tr>
                                <form id="formMM">
                                    <td>8 DUCKY Mark</td>
                                    <td>62 PLANT Soil</td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><textarea class="noteText">He hates germs!</textarea></td>
                                    <td>Antibotics</td>
                                    <td>1</td>
                                    <td>Syringe</td> 
                                    <td class="doneCheck"><button class="doneBtn submit" type="submit" name="Submit Details">Update</button></td>  
                                </form>
                            </tr>
                        </tbody>
                    </table>                
                </div>


            <?php else: ?>
            <!-- Dietary section -->
                
                
                
                
                <!-- Set appropriate filters -->        
                <script>
                    var time = "<?php echo $filterTime; ?>";
                    var date = "<?php echo $filterDate; ?>";
                    var choice = "<?php echo $type; ?>";
                    // $filterTime = $_POST['FilterTime'];
                    // $filterDate = $_POST['FilterDate'];
                    // $type = $_POST['FilterType'];
                    console.log(choice)
                    document.getElementById('filtTime').value = time
                    document.getElementById('filtDate').value = date
                    document.getElementById('choiceType').value = choice
                </script>
                <!-- Diet Regime (hidden) -->
                <div id = "DRTable">
                    <table style="border: 0" class="table table-sortable">
                        <col style="width:11%">
                        <col style="width:11%">
                        <col style="width:8%">
                        <col style="width:7%">
                        <col style="width:30%">
                        <col style="width:7%">
                        <col style="width:7%">
                        <col style="width:10%">
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
                            
                            $DRQ = "SELECT * FROM DRScribe WHERE DRSTime = '$filterTime' AND DRDate = #$filterDate#";
                            $drs = odbc_exec($conn,$DRQ);
                            while ($row = odbc_fetch_array($drs)) {   
                                echo "<tr>";
                                    echo "<form id='formDR' method='post' action = 'mainpage.php'>";
                                        // Get practitioner Info
                                        if ($row['Practitioner'] == 0){
                                            echo "<td>N/A</td>";
                                        }else{
                                            $getPrac = "SELECT * FROM Practitioner WHERE PractitionerID = " . $row['Practitioner'];
                                            $pracs = odbc_exec($conn,$getPrac);
                                            while ($pracRow = odbc_fetch_array($pracs)) {
                                                $inputVal = $pracRow['PractitionerID'] . " " . $pracRow['FirstName'] . " " . $pracRow['lastName'];
                                                break;
                                            }
                                            echo "<td> $inputVal </td>";
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
    </body>
</html>