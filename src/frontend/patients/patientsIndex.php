<!DOCTYPE html>

<?php
    require_once("../models/User.php");
    session_start();
?>

<html>
    <head>
        <title>Entorno pacientes</title>
        <?php include_once("../common/includes.php");?>
    </head>
    <body>  
        <div class="header">
            <?php require("../common/header.php");?>
        </div>
        <div class="sidebar-container">
            <?php require("../patients/sidebarPatients.php")?>
        </div>
        <div class="content-container">
            <div class="container-fluid">
    
                <div class="jumbotron">
                    <h1>Entorno de pacientes</h1>
                    <p>Seleccione en las opciones de su derecha la acción que desea realizar.</p>
                </div>
                <div id="viewPatient">
                    <?php require("viewPatient.php")?>
                </div>
            </div>
        </div>  
        <footer class="bg-light text-center text-lg-start">
            <?php require("../common/footer.php")?>
        </footer>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
