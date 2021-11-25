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
        if (isset($_POST["morning"])){
          $morning = $_POST["morning"];
          echo $morning;
          echo("\n");
        }
        if (isset($_POST["afternoon"])){
          $afternoon = $_POST["afternoon"];
          echo $afternoon;
          echo("\n");
        }
        if (isset($_POST["night"])){
          $night = $_POST["night"];
          echo $night;
          echo("\n");
        }
        $presc_type = $_POST["prescription_type"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

        echo $presc_type;
        echo("\n");
        echo $start_date;
        echo("\n");
        echo $end_date;
     
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

