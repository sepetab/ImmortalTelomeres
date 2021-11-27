<!DOCTYPE html>
<html>
    <head>
      <!--Referencing style sheet-->
        <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body> 
      <header>
          <div class="container-header">
            <a HREF="index.html"><div class="logo-container">
                <img src="img/blender_heart_logo.png" class="logo" alt="a deco"/>
              </div></a>
              <nav>
                  <ul class="nav-ul">
                    <!--Inserting links to go back to home and schedule webpage-->
                      <li class="nav-li"><a class="nav-a" href="index.html">Home</a></li>
                      <li class="nav-li"><a class="nav-a" href="schedule.html">Schedule</a></li>
                      
                  </ul>
              </nav>
          </div>
      </header>
      <!--Paragraphs of info about HL7-->
      <div class="container" style="display:block">
      <!--First we check if the registration failed or not-->
      <?php
      //First we check make a connection to database
      $conn = odbc_connect('z5115189','','',SQL_CUR_USE_ODBC);
      //Now we extract the names and email of those whose are banned
      $bannedUsers = "SELECT FirstName + ' ' +LastName as Name, email
                      FROM Registration WHERE Banned = 1";
      //execute the command above and get response
      $rs = odbc_exec($conn,$bannedUsers);
      //print out all banned users 
      $i = 0;
      while (odbc_fetch_row($rs))
      {
        //iterate across all banned people.
        $Bname=odbc_result($rs,"Name");
        $Bemail=odbc_result($rs,"email");
        
        //check if a banned users name or email matches the registrant
        //echo $_POST["email"];
        //echo $_POST["FirstName"];
        //echo "<br />";
        //echo $Bemail;
        //If the person is banned we twll them that their registration was unsuccessful
        if(strtoupper($_POST["email"])==strtoupper($Bemail)||strtoupper($_POST["FirstName"])." ".strtoupper($_POST["LastName"])==strtoupper($Bname)){
          echo("Registration Failed!\n");
          echo "<br />";
          echo $_POST["FirstName"]." ".$_POST["LastName"]." ".'('.$_POST["email"].')'." "."YOU ARE BANNED\n";
          $i++;
        }
      }
      //Now that we sorted out the banned users, we can check for duplicate entries
      $duplicateUsers = "SELECT FirstName + ' ' +LastName as Name, email
      FROM Registration WHERE Banned = 0";

      $rss = odbc_exec($conn,$duplicateUsers);
      
      while (odbc_fetch_row($rss)){
        //iterate across all non-banned people.
        $Bname=odbc_result($rss,"Name");
        $Bemail=odbc_result($rss,"email");
        //If the person already exist in data base we will tell them
        if(strtoupper($_POST["email"])==strtoupper($Bemail)||strtoupper($_POST["FirstName"])." ".strtoupper($_POST["LastName"])==strtoupper($Bname)){
          echo("Duplicate Registration!\n");
          echo "<br />";
          echo $_POST["FirstName"]." ".$_POST["LastName"]." ".'('.$_POST["email"].')'." "."YOU HAVE PREVIOUSLY REGISTERED\n";
          $i++;
          //if a duplicate person we also print out all registered users
          //great now we can print out all registered users
          $Users = "SELECT FirstName + ' ' +LastName as Name, email
          FROM Registration WHERE Banned = 0";
          $rs = odbc_exec($conn,$Users);
          echo "<br /><br /><br />";
          echo "Registered Users:";
          echo "<br />";
          echo"   Name                 Email";
          echo "<br />";
          while (odbc_fetch_row($rs)){
            $name=odbc_result($rs,"Name");
            $email=odbc_result($rs,"email");
            echo $name."     ".$email;
            echo "<br />";
          }
          }

      }
      //if my $i is still 0 I know that there is no duplicates
      $dob = $_POST["dob"];
      $fn = $_POST["FirstName"];
      $ln = $_POST["LastName"];
      $em = $_POST["email"];
      if($i==0){
        echo("Congratulations!\n");
        echo "<br />";
        echo "your registration was successful";
        echo "<br />";
        echo "Details:";
        echo "<br />";
        echo "Name:"." ".$_POST["FirstName"]." ".$_POST["LastName"];
        echo "<br />";
        echo "DOB: xx/xx/".substr($dob, 6,10);
        echo "<br />";
        echo "Email: ".$_POST["email"];
        //." ".'('.$_POST["email"].')'." "."You are registered!\n";
        //Now I can go ahead and add this person to the data base
        $sqlAddNewUser = "INSERT INTO Registration (FirstName, LastName, Email, Banned) VALUES ('$fn','$ln','$em',0)";
        $added = odbc_exec($conn,$sqlAddNewUser);
        //great now we can print out all registered users
        $Users = "SELECT FirstName + ' ' +LastName as Name, email
        FROM Registration WHERE Banned = 0";
        $rs = odbc_exec($conn,$Users);
        echo "<br /><br /><br />";
        echo "Registered Users:";
        echo "<br />";
        echo"   Name                 Email";
        echo "<br />";
        while (odbc_fetch_row($rs)){
          $name=odbc_result($rs,"Name");
          $email=odbc_result($rs,"email");
          echo $name."     ".$email;
          echo "<br />";
        }
      }


      ?>
    </div>


        <footer>
          <!--Inserting contact details at bottom of page-->
            <div class="footer-container">
                <div>
                    <img src="img/blender_heart_logo.png" class="logo" alt="a deco"/>
                </div>
                <div>
                    <p class="footer-title">Telemedicine & Disease Categorisation Workshop</p>
                    <p class="footer-copyright">&copy; 2021 ImmortalTelomeres</p>
                </div>
                <div>
                    <p class="footer-title">CONTACT US</p>
                    <p class="footer-copyright">+61 123456789</p>
                    <p class="footer-copyright"><A class="footer-mail" HREF="mailto:enquires@biomedX.com">enquires@biomedX.com</a></p>
                </div>
            </div>
        </footer>
    </body>
</html>

