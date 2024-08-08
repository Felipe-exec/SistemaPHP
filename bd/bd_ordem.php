<?php

require_once("conecta_bd.php");

function listaOrdem()
{
    $conexao = conecta_bd();

    $ordens = array();

    $query = "select o.cod, c.nome as nome_cliente, t.nome as nome_terceirizado, s.nome as nome_servico, s.valor as valor_servico, o.data_servico, o.status
              from ordem o
              join cliente c on o.cod_cliente = c.cod
              join terceirizado t on o.cod_terceirizado = t.cod
              join servico s on o.cod_servico = s.cod
              order by o.data_servico desc";

    $resultado = mysqli_query($conexao, $query);
    while ($dados = mysqli_fetch_assoc($resultado)) {
        array_push($ordens, $dados);
    }

    mysqli_close($conexao);
    return $ordens;
}

function buscaOrdem($codigo)
{
    $conexao = conecta_bd();

    $query = "select * from ordem where cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    mysqli_close($conexao);
    return $dados;
}

function cadastraOrdem($cod_cliente, $cod_servico, $cod_terceirizado, $data_servico, $status, $data)
{
    $conexao = conecta_bd();

    $checkQuery = "select cod from servico where cod = '$cod_servico'";
    $resultado = mysqli_query($conexao, $checkQuery);

    if (mysqli_num_rows($resultado) > 0) {
        $query = "insert into ordem (cod_cliente, cod_terceirizado, cod_servico, data_servico, status, data) values ('$cod_cliente', '$cod_terceirizado', '$cod_servico', '$data_servico', '$status', '$data')";
        $resultado = mysqli_query($conexao, $query);
        $affectedRows = mysqli_affected_rows($conexao);
    } else {
        $affectedRows = "error: cod_servico does not exist in servico table";
    }

    mysqli_close($conexao);
    return $affectedRows;
}

function buscaOrdemadd()
{
    $conexao = conecta_bd();

    $query = "select c.nome as nome_cliente, t.nome as nome_terceirizado, s.nome as nome_servico, s.valor as valor_servico, o.data_servico, o.status
              from ordem o
              join cliente c on o.cod_cliente = c.cod
              join terceirizado t on o.cod_terceirizado = t.cod
              join servico s on o.cod_servico = s.cod
              order by o.data_servico desc";

    $resultado = mysqli_query($conexao, $query);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
    } else {
        $dados = [];
    }

    mysqli_close($conexao);

    return $dados;
}

function removeOrdem($codigo)
{
    $conexao = conecta_bd();
    $query = "delete from ordem where cod = '$codigo'";
    mysqli_query($conexao, $query);
    $affectedRows = mysqli_affected_rows($conexao);

    mysqli_close($conexao);
    return $affectedRows;
}

function buscaOrdemeditar($codigo)
{
    $conexao = conecta_bd();

    $query = "select o.cod, c.nome as nome_cliente, c.cod as cod_cliente, t.nome as nome_terceirizado, s.nome as nome_servico, o.data_servico, o.status, o.cod_terceirizado, o.cod_servico
              from ordem o
              join cliente c on o.cod_cliente = c.cod
              join terceirizado t on o.cod_terceirizado = t.cod
              join servico s on o.cod_servico = s.cod
              where o.cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados;
}

function editarOrdem($cod, $cod_cliente, $cod_terceirizado, $cod_servico, $data_servico, $status, $data)
{
    $conexao = conecta_bd();

    $checkQuery = "select cod from servico where cod = '$cod_servico'";
    $resultado = mysqli_query($conexao, $checkQuery);
    $dados = mysqli_num_rows($resultado);
    if ($dados == 1) {
        $query = "update ordem
                  set cod_cliente = '$cod_cliente', cod_terceirizado = '$cod_terceirizado', cod_servico = '$cod_servico', data_servico = '$data_servico', status = '$status', data = '$data'
                  where cod = '$cod'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        mysqli_close($conexao);
        return $dados;
    }
}

function consultaStatusUsuario($status)
{
    $conexao = conecta_bd();
    $query = "select count(*) as total from ordem where status = '$status'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados ? $dados : ['total' => 0];
}

function consultaStatusCliente($codigo, $status)
{
    $conexao = conecta_bd();
    $query = "select count(*) as total from ordem where cod_cliente = '$codigo' and status = '$status'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados ? $dados : ['total' => 0];
}

function consultaStatusTerceirizado($codigo, $status)
{
    $conexao = conecta_bd();
    $query = "select count(*) as total from ordem where cod_terceirizado = '$codigo' and status = '$status'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados ? $dados : ['total' => 0];
}
?>
