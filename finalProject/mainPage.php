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
                  <img src="img/logo2.png" class="logo" alt="Hearth with stethoscope"/>
                  <p class="subtitle">HealthHacker</p>
                </div></a>
                <nav>
                    <ul class="nav-ul">
                        <li class="nav-li"><a class="nav-a" href="patients.php">Patients</a>
                        <li class="nav-li"><a class="nav-a" href="#">Forms</a>
                            <ul>
                                <li><a class = "nav-a" href="newPatient.html">New Patient</a></li>
                                <li><a class = "nav-a" href="editPatient.html">Edit Patient</a></li>
                                <li><a class = "nav-a" href="newPrescription.html">New Prescription</a></li>
                                <li><a class = "nav-a" href="editPrescription.html">Edit Prescription</a></li>
                            </ul>
                        </li>
                        <li class="nav-li"><a class="nav-a" href="">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="container">
            <div>
                <table class="table table-sortable">
                    <col style="width:7%">
                    <col style="width:10%">
                    <col style="width:15%">
                    <col style="width:6%">
                    <col style="width:8%">
                    <col style="width:10%">
                    <col style="width:50%">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Medication/Dietary</th>
                            <th>Given</th>
                            <th>Accepted</th>
                            <th>Dispensing practioner</th>
                            <th>Notes for medication status</th>
                        </tr>
                    </thead>
                    <!-- Exemplar data -->
                    <tbody> 
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
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
                    <p class="footer-title">HEALTHHACKER WORKSHOP</p>
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