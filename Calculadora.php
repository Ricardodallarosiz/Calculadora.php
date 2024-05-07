<?php
session_start();

$numero1 = 0;
$numero2 = 0;
$resultado = '';
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
        case 'fatorar':
            $resultado = 1;
            for($i = 1; $i <= $numero1; $i++){
                $resultado *= $i;
            }
            $operador = '!';
            break;
        case 'potencia':
            $resultado = pow($numero1, $numero2);
            $operador = '^';
            break;
        default:
            $resultado = 'Operação inválida.';
    }

    $_SESSION['resultado'] = "$numero1 $operador $numero2 = $resultado";
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

        $historico = $_SESSION['historico'] ?? [];
        $historico[] = $_SESSION['resultado'];
        $_SESSION['historico'] = $historico;
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
    <div class="meme">
        <img src="https://pbs.twimg.com/media/FwvE1DIXsAIaC4Y.jpg:large" alt="alalakakkakakakakaakakka">
    </div>
    <form>
        
        <input type="number" name="numero1" value="<?= $numero1 ?>" required/>
        <select name ="calcular">
            <option id="corzinhadossinais" value ="somar" <?= $calcular == 'somar' ? 'selected' : '' ?>>+</option>
            <option id="corzinhadossinais" value ="subtrair" <?= $calcular == 'subtrair' ? 'selected' : '' ?>>-</option>
            <option id="corzinhadossinais" value ="multiplicar" <?= $calcular == 'multiplicar' ? 'selected' : '' ?>>x</option>
            <option id="corzinhadossinais" value ="dividir" <?= $calcular == 'dividir' ? 'selected' : '' ?>>÷</option>
            <option id="corzinhadossinais" value ="fatorar" <?= $calcular == 'fatorar' ? 'selected' : '' ?>>n!</option>
            <option id="corzinhadossinais" value ="potencia" <?= $calcular == 'potencia' ? 'selected' : '' ?>>x^y</option>
        </select>
 
        <input type="number" name="numero2" value="<?= $numero2 ?>" required/>
       
    <input id= "bah" type="submit" value="Calcular"/>
    <input id= "bah" type="submit" name="apagar" value="Apagar Histórico"/>
    <input id= "bah" type="submit" name="memoria" value="M"/>

    <p id="resultado">resultado: <?= $resultado ?> </p>
    </form>

<div id="container">
    <div id = "historico">
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

    </div>
</div>
</body>
</html>

<style>
    img{
        width: 300px;
        margin-top: 100px;
    }

      body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
}

form {
    width: 300px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    margin-top: -430px;
}

input[type="number"], select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: none;
    color: #fff;
    background-color: #007BFF;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

#resultado {
    text-align: center;
    padding: 10px;
    margin-top: 20px;
    border-radius: 4px;
    background-color:blue;
    color: #fff;
}

#corzinhadossinais {
    color: #007BFF;
}
#bah{
    color:black;
}
input[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #000000; 
    color: #fff;
    background-color: #d3d3d3;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
    border-color:blue; 
}
#historico {
    width: 10%;
    background-color: #D3D3D3;
    padding: 20px;
    text-align: center;

    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

#container {
    display: flex;
    justify-content: space-around;
    padding: 20px;
}
#meme{
    display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
}
    </style>