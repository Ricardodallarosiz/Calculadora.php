<?php

    $numero1 = 0;
    $numero2 = 0;
    $resultado = 0;
    $calcular = 'somar';

    if (isset($_GET['numero1'], $_GET['numero2'], $_GET['calcular'])) {
        $numero1 = $_GET['numero1'];
        $numero2 = $_GET['numero2'];
        $calcular = $_GET['calcular'];

        switch($calcular) {
            case 'somar':
                $resultado = $numero1 + $numero2;
                break;
            case 'subtrair':
                $resultado = $numero1 - $numero2;
                break;
            case ',multiplicar':
                $resultado = $numero1 * $numero2;
                break;
            case ',dividir':
                $resultado = $numero1 / $numero2;
                break;    
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
        Primeiro Número <br />
        <input type="number" name="numero1" required/><br />
        Segundo Número <br />
        <input type="number" name="numero2" required/><br /><br />
        <select name ="calcular">
            <option value ="somar">Somar</option>
            <option value ="subtrair">Subtrair</option>
            <option value ="multiplicar">Multiplicar</option>
            <option value ="dividir">Dividir</option>
        </select>
    <br /><br />
    <input type="submit" value="Calcular"/>
    <br /><br /> 
    <p> O resulatado é <?= $resultado?> ?></p>
    </form>
    
</body>
</html>

