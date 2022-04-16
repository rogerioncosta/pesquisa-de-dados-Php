<?php 

session_start();

$conectDb = new mysqli('localhost', 'root', '', 'pesquisadados') or die(mysqli_error($conectDb));

$id = 0;
$atualizar = false;
$nomePlaca = '';
$cpfRenavam = '';

//se o botão salvar for pressionado
if (isset($_POST['salvar'])) {
    //armazena nome e cpf dentro das variáveis
    $nomePlaca = $_POST['nomeplaca'];
    $cpfRenavam = $_POST['cpfrenavam'];

    //insere registro no banco
    $conectDb->query("INSERT INTO dados (nomeplaca, cpfrenavam) VALUES('$nomePlaca', '$cpfRenavam')") or die($conectDb->error);

    //redireciona para index.php
    header("location: lista.php");
}

//se o botão apagar for pressionado
if (isset($_GET['apagar'])) {
    $id = $_GET['apagar'];

    //apaga registro no banco
    $conectDb->query("DELETE FROM dados WHERE id=$id") or die($conectDb->error);

    //redireciona para index.php
    header("location: lista.php");
}

    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];

        //botão atualizar, caso o botão editar seja pressionado
        $atualizar = true;
        $result = $conectDb->query("SELECT * FROM dados WHERE id=$id") or die($conectDb->error);

        if (mysqli_num_rows($result) > 0) {
            $linha = $result->fetch_array();
            $nomePlaca = $linha['nomeplaca'];
            $cpfRenavam = $linha['cpfrenavam'];
        }

        /*
        if (is_countable($result) && count($result)==1) {
            $linha = $result->fetch_array();
            $nomePlaca = $linha['nomeplaca'];
            $cpfRenavam = $linha['cpfrenavam'];
        }*/
    }

        //se o botão atualizar for pressionado
        if (isset($_POST['atualizar'])) {
            $id = $_POST['id'];
            $nomePlaca = $_POST['nomeplaca'];
            $cpfRenavam = $_POST['cpfrenavam'];

            $conectDb->query("UPDATE dados SET nomeplaca='$nomePlaca', cpfrenavam='$cpfRenavam' WHERE id=$id") or die($conectDb->error);
        

            //redireciona para index.php
            header("location: lista.php");
        }

?>