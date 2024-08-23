<?php
session_start();
require_once('../OrdemServicoComApi/bd/conecta_bd.php');

$conn = conecta_bd();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $perfil = 2;
    $telefone = $_POST['telefone'];
    $status = 1; // Definindo um valor padrão para o status
    $data = date('Y-m-d H:i:s'); // Definindo a data atual

    if ($senha !== $confirma_senha) {
        $_SESSION['texto_erro_cadastro'] = "As senhas não coincidem.";
        header("Location: cadastro.php");
        exit();
    }

    $senha_hashed = md5($senha);


    $sql = "INSERT INTO cliente (nome, email, senha, cep, endereco, numero, bairro, cidade, uf, telefone, status, perfil, data) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssss", $nome, $email, $senha_hashed, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data);

    if ($stmt->execute()) {
        $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso!";
        header("Location: index.php");
    } else {
        $_SESSION['texto_erro_cadastro'] = "Erro ao realizar o cadastro. Por favor, tente novamente.";
        header("Location: cadastro.php");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: cadastro.php");
}
