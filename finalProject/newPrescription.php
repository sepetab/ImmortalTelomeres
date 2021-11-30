<!DOCTYPE html>
<?php session_start(); ?>
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <html>
        <head>
            <title>New Prescription Form</title>
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
                                    <li><a class = "nav-a" href="#">New Prescription</a></li>
                                    <li><a class = "nav-a" href="editPrescription.php">Edit Prescription</a></li>
                                </ul>
                            </li>
                            <li class="nav-li"><a class="nav-a" href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class='container formContainer'> 
                <h1>New Prescription Form</h1>
                <form class="inputForm" id="prescriptionForm" method="post" action="medications.php" onsubmit="return validateNewMedPrescription()"> 
                    <div class = "inputField">
                        <label for="prescriptionType">Type of Prescription:</label> 
                        <select id= "prescriptionOption" name="Prescription Options" class="required" onchange="OptionsToggler()" autocomplete="off" required>
                            <!-- <option hidden disabled selected value>(Select Option)</option> -->
                            <option value="med">Medication</option>
                            <option value="diet">Dietary</option>
                        </select>
                        <!--select id= "prescriptionOption" name="Prescription Options" class="required" autocomplete="off">
                            <option hidden disabled selected value>(Select Option)</option>
                            <option value="med">Medication</option>
                            <option value="diet">Dietary</option>
                        </select-->
                        <span class="errorTxt"></span>
                    </div>
                    <div>
                        <label for="patientID">Patient ID</label> 
                        <input class="formInput" type="text" placeholder="Enter Patient ID" name="PatientID" id="patientID" onfocusout="validatePatientID()"/>
                        <span class="errorTxt"></span>
                    </div>
                    <div> 
                        <label for="startDate">Start Date</label> 
                        <input class="formInput" type="date" name="startDate" max="" id="startDate" onfocusout="validatePrescriptionDate"/>
                        <span class="errorTxt"></span>
                        <label for="finishDate">Finish Date</label>
                        <input class="formInput" type="date" name="finishDate" max="" id="finishDate" onfocusout="validatePrescriptionDate"/>
                        <span class="errorTxt"></span>
                    </div>
                    <div class = "inputField">
                        <label class="inputField">Time</label>
                        <label class="optionBox">Morning
                            <input class="formInput" type="checkbox" name="morning" id="morning">
                            <span class="checkmark"></span>   
                        </label>
                        <label class="optionBox">Afternoon
                            <input class="formInput" type="checkbox" name="afternoon" id="afternoon">
                            <span class="checkmark"></span>     
                        </label>
                        <label class="optionBox">Evening
                            <input class="formInput" type="checkbox" name="evening" id="evening">
                            <span class="checkmark"></span>     
                        </label>
                    </div>
                    <!-- Medication regime -->
                    <div class='inputField medOpt'>
                        <label for="medName">Medication Name</label>
                        <input class="formInput" type="text" placeholder="Enter Medication Name" name="MedicationName" id="medName" onfocusout="validateMedName()"/>
                        <span class="errorTxt"></span>
                    </div>
                    <div class='inputField medOpt'>
                        <label for="dosage">Dosage</label>
                        <input class="formInput" type="text" placeholder="Enter dosage amount" name="Dosage" id="dosage" onfocusout="validateDosage()"/>
                        <span class="errorTxt"></span>
                    </div> 
                    <div class='inputField medOpt'>
                        <label for="routeAdmin">Route of Administration</label>
                        <input class="formInput" type="text" placeholder="Enter Route of Administration" name="RouteofAdministration" id="routeAdmin" onfocusout="validateRouteAdmin()"/>
                        <span class="errorTxt"></span>
                    </div>
                    <!-- Diet Regime -->
                    <div class='inputField DROpt' style="display:none;">
                        <label class="formInput" for="food">Food</label>
                        <!-- <p class="subtitle">Add "none" if unapplicable</p> -->
                        <textarea style="resize: none" type="text" placeholder="Enter food requirements" name="Food" id="food" rows="8" cols="67" onfocusout=""/></textarea>
                        <p style="font-weight:bold;" class="errorTxt"></p>
                    </div>
                    <div class='inputField DROpt' style="display:none;">
                        <label class="formInput" for="exercise">Exercise</label>
                        <!-- <p class="subtitle">Add "none" if unapplicable</p> -->
                        <textarea style="resize: none" type="text" placeholder="Enter exercise requirments" name="Exercise" id="exercise" rows="8" cols="67" onfocusout=""/></textarea>
                        <p style="display:none;" class="errorTxt"></p>
                    </div>
                    <div class='inputField DROpt' style="display:none;">
                        <label class="formInput" for="beauty">Beauty</label>
                        <!-- <p class="subtitle">Add "none" if unapplicable</p> -->
                        <textarea style="resize: none" type="text" placeholder="Enter beauty requirments" name="Beauty" id="beauty" rows="8" cols="67" onfocusout=""/></textarea>
                        <p style="display:none;" class="errorTxt"></p>
                    </div>
                    <button class="inputBtn submit medOpt" type="submit" name="NewMedication" onclick="validateNewMedPrescription()">Submit New Medication</button>
                    <button class="inputBtn submit DROpt" style="display:none;" type="submit" name="NewDR">Submit New Diet Regime</button>
                </form>
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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="script/scriptPrescription.js"></script>
    </html>
<?php else: ?>
    <html>
        <h1>Unauthorized access, login required. Click <a href="loginFirst.html">here</a> to login.</h1>
    </html>
<?php endif; ?>

