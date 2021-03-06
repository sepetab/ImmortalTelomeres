<!DOCTYPE html>
<?php session_start(); ?>
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <html>
        <head>
            <title>Edit Patient Registration Form</title>
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
                                    <li><a class = "nav-a" href="#">Edit Patient</a></li>
                                    <li><a class = "nav-a" href="newPrescription.php">New Prescription</a></li>
                                    <li><a class = "nav-a" href="editPrescription.php">Edit Prescription</a></li>
                                </ul>
                            </li>
                            <li class="nav-li"><a class="nav-a" href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class='container formContainer'> 
                <h1>Edit Patient Registration Form</h1>
                <form class="inputForm" id="editPatientForm" onsubmit="return validateEditPatient()" method="post" action="patients.php" enctype="multipart/form-data"> 
                    <div class = "inputField">
                        <label for="patientID">Patient ID</label> 
                        <input class="formInput" type="text" placeholder="Enter Patient ID" name="PatientID" id="patientID" onfocusout="validatePatientID()"/>
                        <span class="errorTxt"></span>
                    </div>
                    <div class = "inputField">
                        <label for="firstName">First Name</label> 
                        <input class="formInput" type="text" placeholder="Enter your first name" name="FirstName" id="firstName" onfocusout="validateFirstName()"/>
                        <span class="errorTxt"></span>
                    </div>
                    <div class = "inputField">
                        <label for="lastName">Last Name</label>
                        <input class="formInput" type="text" placeholder="Enter your last name" name="LastName" id="lastName" onfocusout="validateLastName()"/>
                        <span class="errorTxt"></span>
                    </div>
                    <div class = "inputField"> 
                        <label for="roomNumber">Room Number</label>
                        <input class="formInput" type="text" placeholder="Enter assigned patient number" name="RoomNumber" id="roomNumber" onfocusout="validateRoomNumber()"/> 
                        <span class="errorTxt"></span>
                    </div>
                    <div>
                        <label for="patientProfile">Patient Photo</label>
                        <input class="formInput" type="file" name="PatientPicture" id="patientPicture" accept="image/*">
                        <div class="imagePreview" id="imagePreview">
                            <img src="" alt="Image Preview" class="imagePreviewSample"> 
                            <span class="imagePreviewText">Image Preview</span>
                        </div>
                    </div>
                    <button class="inputBtn submit" type="submit" name="editPatient">Submit</button>
                    <button class="inputBtn submit" type="submit" name="removePatient" style="background:red;">Remove patient</button>
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
        <script src="script/scriptPatient.js"></script>
    </html>
<?php else: ?>
    <html>
        <h1>Unauthorized access, login required. Click <a href="loginFirst.html">here</a> to login.</h1>
    </html>
<?php endif; ?>

