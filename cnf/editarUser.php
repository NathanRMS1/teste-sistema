<?php
#origem raiz/partes/testes/user.php
session_start();
require_once "conexao.php";
if(isset($_POST['salvar'])){
    if(isset($_SESSION['princdatui'])){
        $id=$_SESSION['princdatui']['id'];
    }else{
        echo '<script>alert("Erro 2 em editarUser.php! Sem Usuario");</script>';
        die;
    }
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=$_POST['senhaA'];
    $senhaC=$_POST['senhaA'];
    $senhaMod=0;
    if(!($senha == '' or $senha == ' ') and ($_POST['senhaN'] != '')){
        $checkPass=$conectar->query("SELECT * FROM usuario WHERE id=$id AND senha=$senha");
        if(mysqli_num_rows($checkPass)!=0){
            $senha=$_POST['senhaN'];
            $senhaMod=1;
        }
    }
    $check=$conectar->query("SELECT * FROM usuario WHERE id=$id");
    if(mysqli_num_rows($check)!=0){
        if($senhaMod==1){
            $update=$conectar->query("UPDATE usuario SET nome='$nome', email='$email', senha=$senha WHERE id=$id");
            if($update){
                echo '<script>alert("Dados modificados");</script>';
                include_once "refreshUser.php";
            }else{
                echo '<script>alert("Dados não modificados modificados, caso 1");</script>';
            }
            echo '<meta content="0;../index.php" http-equiv="refresh">';
        }else{
            $update=$conectar->query("UPDATE usuario SET nome='$nome', email='$email' WHERE id=$id");
            if($update){
                echo '<script>alert("Dados modificados, exceto a senha");</script>';
                include_once "refreshUser.php";
            }else{
                echo '<script>alert("Dados não modificados modificados, caso 2");</script>';
            }
            echo '<meta content="0;../index.php" http-equiv="refresh">';
        }
    }
}else{
    echo '<script>alert("Erro 1 em editarUser.php!");</script>';
    echo '<meta content="0;../index.php" http-equiv="refresh">';
}
?>