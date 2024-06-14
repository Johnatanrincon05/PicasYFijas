<?php
session_start();
if (!isset($_SESSION['secret_number'])) {
    $_SESSION['secret_number'] = rand(1111,9999);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>David Rincon</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="game.php" method="post">
        <h1>Picas y Fijas</h1>
        <input type="hidden" value="<?php echo $_SESSION['secret_number']?>">
        <label id="label1" for="user">  Picas y Fijas es un juego en el que debes adivinar un número secreto de 4 dígitos. 
            Una "Fija" indica un dígito correcto en la posición correcta, 
            y una "Pica" indica un dígito correcto en la posición incorrecta. <br> <br> Ingresa un número de 4 dígitos:</label>
        <input type="text" id="user" name="user" maxlength="4" required pattern="\d{4}" title="Debe contener exactamente 4 dígitos">
        <button type="submit">! Intenta adivinar ¡</button>
        <?php
        if (isset($_SESSION['respuesta'])) {
            echo '<p>' . $_SESSION['respuesta'] . '</p>';
            unset($_SESSION['respuesta']);
        }
        ?>
    </form>
    <br>

</body>
</html>