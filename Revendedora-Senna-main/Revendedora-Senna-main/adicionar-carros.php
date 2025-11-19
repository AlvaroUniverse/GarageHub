<?php
include("conexao.php");


$nome_vendedor = $_POST['nome-vendedor'];
$marca = $_POST['marcas'];
$nome_carro = $_POST['nome-carro'];
$ano_carro = $_POST['ano-carro'];
$acessorios = $_POST['acessorios-carro'];

$foto_nome = null;
if (!empty($_FILES['foto-carro']['name'])) {
    $pasta = "uploads/";
    
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $foto_nome = $pasta . basename($_FILES["foto-carro"]["name"]);
    move_uploaded_file($_FILES["foto-carro"]["tmp_name"], $foto_nome);
}

$sql = "INSERT INTO carros (nome_vendedor, marca, nome_carro, ano_carro, acessorios, foto)
        VALUES ('$nome_vendedor', '$marca', '$nome_carro', '$ano_carro', '$acessorios', '$foto_nome')";

if ($conn->query($sql) === TRUE) {
    echo "Carro cadastrado com sucesso";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>
