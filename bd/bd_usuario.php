<?php

require_once("conecta_bd.php");

function checaUsuario($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "select *
              from usuario
              where email='$email' and
                    senha='$senhaMd5'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    mysqli_close($conexao);
    return $dados;
}

function listaUsuarios(){
    $conexao = conecta_bd();
    $usuarios = array();
    $query = "select *
              from usuario
              order by nome";
   
    $resultado = mysqli_query($conexao, $query);
    while($dados = mysqli_fetch_array($resultado)) {
        array_push($usuarios, $dados);
    }

    mysqli_close($conexao);
    return $usuarios;
}

function buscaUsuario($email) {
    $conexao = conecta_bd();
    $query = "select * from usuario where email='$email'";
    return mysqli_query($conexao, $query);
}

function cadastraUsuario($nome, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data){
    $conexao = conecta_bd();
    $query = "insert into usuario (nome, email, senha, cep, endereco, numero, bairro, cidade, uf, telefone, status, perfil, data) 
              values ('$nome', '$email', '$senha', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$uf', '$telefone', '$status', '$perfil', '$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    mysqli_close($conexao);
    return $dados;
}

function removeUsuario($codigo){
    $conexao = conecta_bd();
    $query = "delete from usuario where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    mysqli_close($conexao);
    return $dados;
}

function buscaUsuarioeditar($codigo){
    $conexao = conecta_bd();
    $query = "select *
              from usuario
              where cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    mysqli_close($conexao);
    return $dados;
}

function editarUsuario($codigo, $status, $data){
    $conexao = conecta_bd();
    $query = "select *
              from usuario
              where cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1){
        $query = "update usuario
                  set status = '$status', data = '$data'
                  where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);

        mysqli_close($conexao);
        return $dados;
    }
}

function editarSenhaUsuario($codigo, $senha) {
    $conexao = conecta_bd();
    $query = "update usuario set senha='$senha' where cod='$codigo'";
    mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao) > 0;
    mysqli_close($conexao);
    return $dados;
}

function editarPerfilUsuario($codigo, $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data){
    $conexao = conecta_bd();

    $query = "select *
              from usuario
              where cod = '$codigo'";
                     
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1) {
        $query = "update usuario
                  set nome = '$nome', email = '$email', endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', telefone = '$telefone', data = '$data'
                  where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);

        mysqli_close($conexao);
        return $dados;      
    }
}
?>