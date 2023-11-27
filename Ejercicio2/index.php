<?php
include("config/config.php");
include("index2.php");
$score = 0;

if (isset($_GET['test'])) {
    $testToUser = $_GET['test'];
    $preguntasPruebaSeleccionada = $aTests[$testToUser]["Preguntas"];       
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['respuestasUsuario'])) {
        $respuestas = $_POST['respuestasUsuario'];
        $cont = 0;
        foreach ($respuestas as $respuesta) {
            $primerCaracter = substr($respuesta, 0, 1);
            if ($aTests[$testToUser]["Corrector"][$cont] == $primerCaracter) {
                echo $cont+1 ,'.<span>&#10004;</span></br/>'; 
                $score++;
            } else {
                echo $cont+1 ,'<span>&#10060;</span><br/>'; 
            }
            $cont++;
        }
        echo "La puntuacion es de " . $score;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postigo Arévalo Javier</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>

<form method="post" action="">
    <?php
   foreach ($preguntasPruebaSeleccionada as $key => $pregunta) {
    echo "Pregunta: " . $pregunta["Pregunta"] . "<br/>";
    foreach ($pregunta["respuestas"] as $respuesta) {
        echo '<input type="radio" name="respuestasUsuario['.$key.']" value="' . $respuesta . '"> ' . $respuesta . '<br/>';
    }

    $imagen = "dir_img_test" . $testToUser+1 . "/img" . ($key + 1) . ".jpg";

    if (file_exists($imagen)) {
        echo '<img src="' . $imagen . '" alt="Imagen de la pregunta ' . ($key + 1) . '"><br/>';
    }

    echo "<br/>";
}

    
    ?>
    <input type="submit" value="Enviar Respuesta">
</form>

</body>
</html>
