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
  
        $presc_id = $_POST["prescription_id"];
        
        echo $presc_id;
        echo("\n");
     
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

