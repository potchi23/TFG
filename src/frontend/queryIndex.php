<!DOCTYPE html>

<?php
    include_once("models/User.php");
    session_start();

    if (!isset($_SESSION["user"])){
        header("Location: /index.php");
    }
?>

<html>
    <head>
        <title>Realizar consulta</title>

        <?php include_once("common/includes.php");?>
        <link rel="stylesheet" href="/css/common.css">
        <script language="javaScript">          
            function toggleCB(op) { 
                op.disabled = !op.disabled;
            }

            function submitForm(){
                var form = document.getElementById("queryForm");
                form.submit();
                alert("Your Query Was Sent");
            }
        </script>
    </head>
    <body>  
        <div class="header">
            <div class="fixed-top">
                <?php include_once("common/header.php");?>
            </div>
        </div>    
        <div class="sidebar-container">
            <?php include_once("querys/sidebarQuery.php")?>
        </div>

        <div class="content-container">
            <div class="container-fluid">
                <!-- Main component for a primary marketing message or call to action -->
                <div class="jumbotron" id="indexQuery">
                    <h1 style="font-weight: 600">Realizador de consultas</h1>
                    <hr class="my-4">
                    <h5>Para realizar una consulta debe rellenar los filtros deseados de la barra lateral izquierda.</h5>
                    <h5>A continuación deberá presionar el botón de realizar consulta.</h5>
                </div>
                
                <form id="queryForm" action="requests/getQuery.php" method="GET">            
                    <div id="queryCIR">
                        <?php include_once("querys/queryCIR.php")?>
                    </div>

                    <div id="querySociodemographic">
                        <?php include_once("querys/querySociodemographic.php")?>
                    </div>

                    <div id="queryClinic">
                        <?php include_once("querys/queryClinic.php")?>
                    </div>

                    <div id="queryBiopsy">
                        <?php include_once("querys/queryBiopsy.php")?>
                    </div>

                    <div id="queryProstate">
                        <?php include_once("querys/queryProstate.php")?>
                    </div>

                    <div id="queryEvolve">
                        <?php include_once("querys/queryEvolve.php")?>
                    </div>

                    <div id="queryMarkers">
                        <?php include_once("querys/queryMarkers.php")?>
                    </div>
                </form>
            </div>
        </div>

        <footer class="bg-light text-center text-lg-start">
            <?php include_once("common/footer.php")?>
        </footer>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>