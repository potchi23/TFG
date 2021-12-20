<?php
    include_once("../models/User.php");
    session_start();
    
    $user = $_SESSION["user"];

    $ch = curl_init();
    
    $patch_req = array(
        "id" => $_POST["id"]
    );

    $token = $user->get_token();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-access-token: $token"));

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/register_petitions");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $patch_req);

    $response = curl_exec($ch);
    
    curl_close($ch);
   
    if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 200) {
        $data = json_decode($response)->data[0];
        $email = $data->email;
        $name = $data->name;

        $subject = 'Estado de solicitud de registro';
        
        $msg = "Hola $name. Te informamos que hemos aceptado tu solicitud de registro.";
        $headers = 'From: tfg@ucm.es' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        //mail($email, $subject, $msg, $headers);

        header("Location: ../registerPetitions.php");
    }
    else{
        echo "<h1>Hubo un error</h1>";
    }
?>
