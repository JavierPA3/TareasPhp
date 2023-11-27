<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postigo Arévalo Javier</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>

<?php
include("config/config.php");
include("index2.php");
$score = 0;

if (isset($_GET['test'])) {
    $testToUser = $_GET['test'];
    $preguntasPruebaSeleccionada = $aTests[$testToUser]["Preguntas"];       
} 

?>

<form method="post" action="">
    <?php
    foreach ($preguntasPruebaSeleccionada as $key => $pregunta) {
        echo "Pregunta: " . $pregunta["Pregunta"] . "<br/>";
        foreach ($pregunta["respuestas"] as $respuesta) {
            echo '<input type="radio" name="respuestasUsuario['.$key.']" value="' . $respuesta . '"> ' . $respuesta . '<br/>';
        }

        $imagen = "dir_img_test" . ($testToUser + 1) . "/img" . ($key + 1) . ".jpg";

        if (file_exists($imagen)) {
            echo '<img src="' . $imagen . '" alt="Imagen de la pregunta ' . ($key + 1) . '"><br/>';
        }

        echo "<br/>";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['respuestasUsuario'])) {
            $respuestaSeleccionada = isset($_POST['respuestasUsuario'][$key]) ? $_POST['respuestasUsuario'][$key] : null;

            if ($respuestaSeleccionada !== null) {
                $primerCaracter = substr($respuestaSeleccionada, 0, 1);
                if ($aTests[$testToUser]["Corrector"][$key] == $primerCaracter) {
                    echo '<span style="color:green">&#10004; Correcto</span><br/>';
                    $score++;

                } else {
                    echo '<span style="color:red">&#10060; Incorrecto</span><br/>';
                }
            } else {
                echo '<span style="color:orange">No se ha seleccionado respuesta</span><br/>';
            }
        }
    }
    echo '<span style="color:blue">', 'Ha conseguido una puntuación de '. $score.'/10', '</span>';
    echo '<br/>';
    ?>
    <input type="submit" value="Enviar Respuesta">
</form>

</body>
</html>
