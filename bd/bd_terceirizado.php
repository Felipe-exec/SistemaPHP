<?php

require_once("conecta_bd.php");

function checaTerceirizado($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "select *
              from terceirizado
              where email='$email' and
                    senha='$senhaMd5'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaTerceirizados(){
    $conexao = conecta_bd();
    $terceirizados = array();
    $query = "select *
              from terceirizado
              order by nome";

    $resultado = mysqli_query($conexao, $query);
    while ($dados = mysqli_fetch_array($resultado)){
        array_push($terceirizados, $dados);
    }
    return $terceirizados;
}

function buscaTerceirizado($email) {
    $conexao = conecta_bd();
    $query = "select * from terceirizado where email='$email'";
    return mysqli_query($conexao, $query);
    //$resultado = mysqli_query($conexao, $query);
    //$dados = mysqli_num_rows($resultado);

    //return $dados;
}

function cadastraTerceirizado($nome, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data){
    $conexao = conecta_bd();

    $query = "insert into terceirizado (nome, email, senha, cep, endereco, numero, bairro, cidade, uf, telefone, status, perfil, data) 
              values ('$nome', '$email', '$senha', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$uf', '$telefone', '$status', '$perfil', '$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    return $dados;
}

function removeTerceirizado($codigo){
    $conexao = conecta_bd();
    $query = "delete from terceirizado where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    return $dados;
}

function buscaTerceirizadoeditar($codigo){
    $conexao = conecta_bd();
    $query = "select *
              from terceirizado
              where cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarTerceirizado($codigo, $status, $data){
    $conexao = conecta_bd();
    $query = "select *
              from terceirizado
              where cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1){
        $query = "update terceirizado
                  set status = '$status', data = '$data'
                  where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

function editarSenhaTerceirizado($codigo, $senha) {
    $conexao = conecta_bd();
    $query = "update terceirizado set senha='$senha' where cod='$codigo'";
    mysqli_query($conexao, $query);
    return mysqli_affected_rows($conexao) > 0;
}

function editarPerfilTerceirizado($codigo, $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data){
    $conexao = conecta_bd();

    $query = "select *
              from terceirizado
              where cod = '$codigo'";
                     
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1)
    {
        $query = "update terceirizado
                  set nome = '$nome', email = '$email', endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', telefone = '$telefone', data = '$data'
                  where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;      
    }
}
?>