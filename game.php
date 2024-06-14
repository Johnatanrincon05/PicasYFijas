<?php
session_start();

if (isset($_POST['user'])) {
    $user = $_POST['user'];
    $secret = $_SESSION['secret_number'];
    $respuesta = calculatePicasFijas($user, $secret);

    $_SESSION['respuesta'] = "Picas: " . $respuesta['picas'] . " | Fijas: " . $respuesta['fijas'];

    if ($respuesta['fijas'] == 4) {
        $_SESSION['respuesta'] .= " ¡ Buen trabajo, adivinaste!";
        unset($_SESSION['secret_number']);
    }
}

function calculatePicasFijas($user, $secret) {
    $picas = 0;
    $fijas = 0;
    $secretArray = str_split($secret);
    $userArray = str_split($user);

    //Fijas
    for ($i = 0; $i < 4; $i++) {
        if ($userArray[$i] == $secretArray[$i]) {
            $fijas++;
            $secretArray[$i] = null;
            $userArray[$i] = null;  
        }
    }

    //Picas
    for ($i = 0; $i < 4; $i++) {
        if ($userArray[$i] !== null && in_array($userArray[$i], $secretArray)) {
            $picas++;
            $key = array_search($userArray[$i], $secretArray);
            $secretArray[$key] = null; 
        }
    }

    return ['picas' => $picas, 'fijas' => $fijas];
}

header("Location: index.php");
exit();