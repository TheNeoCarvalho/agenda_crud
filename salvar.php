<?php

include_once('./config/database/database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $nome = $_POST['nome'];  
    $email = $_POST['email'];  
    $tel = $_POST['tel'];  

    if(empty($nome) || empty($email) || empty($tel)){
        echo "<script>alert('Preencha todos os campos!');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
    
    $sql = "INSERT INTO contatos (nome, email, telefone) VALUES ('$nome', '$email', '$tel')";
    
    if($con->query($sql) === TRUE){
        echo "<script>alert('Contato cadastrado com sucesso!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar contato: " . $conn->error . "');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
}

?>