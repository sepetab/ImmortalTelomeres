<!DOCTYPE html>
<html>
    <head>
        <!-- Title of webpage -->
        <title>Bioinformatics Workshop</title> 
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet"/>
    </head> 
    <body>
        <header>
            <!--Container for the main content, but container-header in regards to additional parameters -->
            <div class="container container-header"> 
                <div class="title">
                    <img src="images/gearbrain.png" class="imagelogo"/>  
                    <h1 class='title'>HealthHacker</h1> 
                </div>
                <nav class="link-right"> 
                    <ul class="btn-ul">
                        <li class="btn-li"><a class="btn-a" href ='index.html'>Home</a></li>
                        <li class="btn-li"><a class="btn-a" href="timetable.html">Workshop Timetable</a></li>
                    </ul>
                </nav>
            </div> 
        </header>

        <div class = "valContainer2">
        <?php 
            //You have been successfully registered, firstName!
            //You have already registered, firstName!
            //You have been banned, firstName!

            // get data from the validation form 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $conn = odbc_connect('z5206712', '', '', SQL_CUR_USE_ODBC);
                if(!$conn){exit("Connection Failed:". $conn);}
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $dateOfBirth = $_POST['dateOfBirth'];
                    $dateOfBirthSplit = explode('/', $dateOfBirth); // breaks into D/M/Y , varaible[0,1,2]
                    $dobyear = $dateOfBirthSplit[2];
                    $gender = $_POST['gender']; 
                    $today = date("d/m/Y");
                    
                    // find if users exists
                    $sqlExists = "SELECT * FROM Registration WHERE (UCase(lastName)='".strtoupper($lastName)."' AND UCase(firstName)='".strtoupper($firstName)."') OR (UCase(email) ='".strtoupper($email)."')";

                    $exists = odbc_exec($conn,$sqlExists);
                    if(odbc_fetch_row($exists)){
                        $exists = odbc_exec($conn,$sqlExists);
                        while ($row = odbc_fetch_array($exists)) {    
                            if($row['banned'] == 1){
                                echo "<h2 style=\"text-align: center; font-weight: bold;\">Sorry, you are a banned user, $firstName $lastName!</h2>";    
                            }else{ // tell user of registration status from name, and provide details from validation form 
                                echo "<h2 style=\"text-align: center; margin-top:1em; font-weight: bold;\">You are already registered, $firstName $lastName!</h2>";    
                                echo "<h2 style=\"text-align: center; margin:1em auto; font-weight: bold;\">Registered details:</h2>";    
                                echo "<p>Name: &nbsp&nbsp&nbsp <span>$firstName $lastName</span></p>";
                                echo "<p>Email: &nbsp&nbsp&nbsp <span>$email</span></p>";
                                echo "<p>Date of Birth: &nbsp&nbsp&nbsp <span> xx/xx/$dobyear</span></p>";
                                echo "<p>Gender: &nbsp&nbsp&nbsp <span>$gender</span></p>";
                                echo "<p style=\" margin-bottom:10px;\">Registration date:  &nbsp&nbsp&nbsp <span>$today</span></p>";
                                echo "<p style=\" margin-bottom:2em;\"> If you are unsure of your registered details, change current account details or wish to make a new account, please email us at enquiries@hackerhealth.com - Thank you!</p>";
                            }
                         break;
                        }  
                    }else{
                        // place name and email into mySQL database - sync
                        $sqlAddNewUser = "INSERT INTO Registration (firstName, lastName, email) VALUES ('$firstName','$lastName','$email')";
                        $confirmregister = "<p>Your details have been registered on our databases. If your mistyped or want to change details, please email us at enquiries@hackerhealth.com</p>";
                        $added = odbc_exec($conn,$sqlAddNewUser);
                        if($added){echo $confirmregister;}else{
                            print("Execution failed:\n");
                            print("   State: ".odbc_error($conn)."\n");
                            print("   Error: ".odbc_errormsg($conn)."\n");
                            // echo odbc_error($added);
                            // echo $added;
                            // echo "NOTHING HERE?";
                            // echo $sqlAddNewUser;
                        }
                        // show information that were inputted via form
                        echo "<h2 style=\"text-align: center; margin:1em auto; margin-top:2em; font-weight: bold;\">Your registration is confirmed, $firstName!</h2>";    
                        echo "<h2 style=\"text-align: center; font-weight: bold;\">Details:</h2>";    
                        echo "<p>Name: &nbsp&nbsp&nbsp <span>$firstName $lastName</span></p>";
                        echo "<p>Email: &nbsp&nbsp&nbsp <span>$email</span></p>";
                        echo "<p>Date of Birth: &nbsp&nbsp&nbsp <span> xx/xx/$dobyear</span></p>";
                        echo "<p>Gender: &nbsp&nbsp&nbsp <span>$gender</span></p>";
                        echo "<p style=\" margin-bottom:4em;\">Registration date:  &nbsp&nbsp&nbsp <span>$today</span></p>";
                    }

                }
                // show list of unbanned users
                $sqlQueryRegistrants = "SELECT * FROM Registration WHERE banned=0;";
                $registrants = odbc_exec($conn,$sqlQueryRegistrants);
                echo '<h2 style="text-align: center; margin:auto auto; font-weight: bold;">Registered users:</h2>';
                while ($row = odbc_fetch_array($registrants)) {    
                    print($row['firstName']." ".$row['lastName']. str_repeat('&nbsp;', 5) . '-'. str_repeat('&nbsp;', 5).$row['email']."\n");
                    echo "<br>";
                  }  
            }
            
            ?>

        </div>
        
<!-- Footer is consistent for all pages available in this web-browser-->
    <footer>
        <div class = "container">
        <p class="footer-title">CONTACT US</p>
        <p><strong>HACKERHEALTH</strong></p>
        <p>+61 410 157 962 </p>
        <!-- Creates a link for the email, so user can click and message right away -->
        <a href="mailto:enquiries@hackerhealth.com">enquiries@hackerhealth.com</a>
        </div>
    </footer>
</body>
</html>