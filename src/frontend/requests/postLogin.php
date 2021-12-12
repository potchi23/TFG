<?php
    $ch = curl_init();

    $post_req = array(
        "email" => $_POST["email"], 
        "password" => $_POST["password"]
    );

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/login");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
    $response_array = json_decode($response,true);
    $name = $response_array["name"];
    $surname_1 = $response_array["surname_1"];
    $user_exists = $response_array["user_exists"];

    if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 200) {
        header("Location: ../dashboard.php?name=$name&surname_1=$surname_1");
    }
    else if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 404){
        if($user_exists)
            header("Location: ../login.php?error=Email%20o%20password%20incorrectos");
        else{
            header("Location: ../login.php?error=El%20usuario%20no%20existe");
        }
    }
?>
