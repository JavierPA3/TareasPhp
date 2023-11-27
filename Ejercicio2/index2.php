<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['test'])) {
        $testToUser = intval($_POST['test']);
    
        header("Location: prueba.php?test=$testToUser");
        exit; 
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
<form method="post">
<select name="test">
                <option value="0">Test 1</option>
                <option value="1">Test 2</option>
                <option value="2">Test 3</option>
</select>
<input type="Submit" name="enviar" value="Enviar">
</form>
</body>
</html>