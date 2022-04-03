<?php
    require_once("../config/config.php");
    include_once("../models/User.php");
    
   session_start();

    $user = $_SESSION["user"];

    //TODO
    //[]Cambiar o borrar graphicModel.php para hacer bien las conexiones con la bd
    //[]graphic_controler.php darle una vuelta igual se puede quitar
    //[]Crear procedimiento en sql para mostrar las medias de los datos importantes
    //[]poner bien el estilo de las graficas
    //[]refactorizar codigo (posibilidad de hacer funciones con parámetros para que quede más limpio y mostrar varias gráficas)

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pacientes</title>
        <link rel="stylesheet" href="../css/forms.css"/>
        <link rel="stylesheet" href="../css/registerPetitions.css"/>
        <?php include_once("../common/includes.php");?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/formUserProfile.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css>
       

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <script src="http://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    </head>
    <body>
        <div class="header">
            <?php include_once("../common/header.php");?>
        </div>   
        <div class="card-body">
            <canvas id="myChart" width="400" height="400"></canvas>
            <script>
            function cargarDatos(){
                $.ajax({
                    url:'graphic_controler.php',
                    type:'POST'
                }).done(function(resp){
                    if(resp.length() > 0){
                        var data = JSON.parse(resp); 
                        var x = [];
                        var y = []
                        for(var i=0; i < data.length();i++){
                            x.push(resp[i][1]); //se refiere a fila i columna 1, habría que crear un procedimiento en sql para las medias de lo que queremos
                            y.push(resp[i][2])
                        }
                    }
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: x,
                        datasets: [{
                            label: '# of Votes',
                            data: y,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                    })
                }
            </script>

    </body>
</html>