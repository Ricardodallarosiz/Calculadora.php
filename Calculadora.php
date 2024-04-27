<?php
session_start();

$numero1 = 0;
$numero2 = 0;
$resultado = 0;
$calcular = 'somar';
$mostrarHistorico = false;

if (isset($_GET['numero1'], $_GET['numero2'], $_GET['calcular'])) {
    $numero1 = $_GET['numero1'];
    $numero2 = $_GET['numero2'];
    $calcular = $_GET['calcular'];

    $operador = '';
    switch($calcular) {
        case 'somar':
            $resultado = $numero1 + $numero2;
            $operador = '+';
            break;
        case 'subtrair':
            $resultado = $numero1 - $numero2;
            $operador = '-';
            break;
        case 'multiplicar':
            $resultado = $numero1 * $numero2;
            $operador = '*';
            break;
        case 'dividir':
            if($numero2 != 0) {
                $resultado = $numero1 / $numero2;
                $operador = '/';
            } else {
                $resultado = 'Divisão por zero não é permitida.';
            }
            break;
        default:
            $resultado = 'Operação inválida.';
    }

    $historico = $_SESSION['historico'] ?? [];
    $historico[] = "$numero1 $operador $numero2 = $resultado";
    $_SESSION['historico'] = $historico;
}

if (isset($_GET['apagar'])) {
    unset($_SESSION['historico']);
}

if (isset($_GET['memoria'])) {
    if(isset($_SESSION['memoria'])) {
        $numero1 = $_SESSION['memoria']['numero1'];
        $numero2 = $_SESSION['memoria']['numero2'];
        $calcular = $_SESSION['memoria']['calcular'];
        $mostrarHistorico = true;
    } else {
        $_SESSION['memoria'] = ['numero1' => $numero1, 'numero2' => $numero2, 'calcular' => $calcular];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora php</title>
</head>
<body>
    <form>
        
        <input type="number" name="numero1" value="<?= $numero1 ?>" required/>
        <select name ="calcular">
            <option value ="somar" <?= $calcular == 'somar' ? 'selected' : '' ?>>+</option>
            <option value ="subtrair" <?= $calcular == 'subtrair' ? 'selected' : '' ?>>-</option>
            <option value ="multiplicar" <?= $calcular == 'multiplicar' ? 'selected' : '' ?>>x</option>
            <option value ="dividir" <?= $calcular == 'dividir' ? 'selected' : '' ?>>÷</option>
        </select>
 
        <input type="number" name="numero2" value="<?= $numero2 ?>" required/>
       
    <input type="submit" value="Calcular"/>
    <input type="submit" name="apagar" value="Apagar Histórico"/>
    <input type="submit" name="memoria" value="M"/>

    <p>resultado: <?= $resultado ?> </p>
    </form>

    <?php
    if($mostrarHistorico && isset($_SESSION['historico'])) {
        echo "<h2>Histórico:</h2>";
        echo "<ul>";
        foreach($_SESSION['historico'] as $operacao) {
            echo "<li>$operacao</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
