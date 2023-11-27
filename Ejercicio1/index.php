<?php
$firstIf = false;
include("config/config.php");
$score = 0;
$numeroverbos = 0;
$npregunta = 0;

if (isset($_POST["numeroverbos"]) && isset($_POST["numeropreguntas"])) {
    $numeroverbos = (int) $_POST["numeroverbos"];
    $numeropreguntas = $_POST["numeropreguntas"];
    if ($numeropreguntas === "facil") {
        $npregunta = 1;
    } elseif ($numeropreguntas === "medio") {
        $npregunta = 2;
    } else {
        $npregunta = 3;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier Postigo Arévalo</title>
</head>

<body>
    <?php
    if ($numeroverbos < 1 && !$firstIf) {
        $firstIf = true;
        ?>
        <form method="post">
            <label>Cuantos verbos quieres</label>
            <input type="text" name="numeroverbos">
            <br />
            <label>Nº preguntas por verbos</label>
            <select name="numeropreguntas">
                <option value="facil">Fácil</option>
                <option value="medio">Medio</option>
                <option value="dificil">Dificil</option>
            </select>
            <br />
            <br />
            <input type="submit" id="enviar" name="enviar">
        </form>
    <?php } elseif ($numeroverbos > 0) {
        ?>
        <form method='post'>
            <table>
                <tr>
                    <th>Verbo</th>
                    <th>Conjugación</th>
                </tr>
                <?php
                for ($i = 0; $i < $numeroverbos; $i++) {
                    $randomNumber = mt_rand(0, count($irregular_verbs) - 1);
                    $verbo = $irregular_verbs[$randomNumber];
                    $keys = array_keys($verbo);
                    $positionsToEmpty = (array) array_rand($keys, $npregunta);
                    $cont = 1;

                    echo '<tr>';
                    foreach ($keys as $key) {
                        var_dump($verbo);
                        echo '<td>';
                        echo '</td>';
                        echo '<td>';
                        if (in_array($cont - 1, $positionsToEmpty)) {
                            $verbo[$key] = "";
                        }
                        echo '<input type="text" name="' . $key . '" value="' . $verbo[$key] . '">';
                        echo '</td>';
                        $cont++;
                    }
                    echo '</tr>';

                }
                // echo '<input type="hidden" name="miVariable" value="' . htmlspecialchars(json_encode($verbo)) . '">';
                ?>
            </table>
            <input type="submit" id="enviar2" name="enviar2">
        </form>
    <?php }
    ?>
</body>

</html>