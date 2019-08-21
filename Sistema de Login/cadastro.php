<?php
//Variaveis que serão consultada no POST do register.php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$mysqli = new mysqli("localhost", "root", "", "login"); //instanciando e acessando o sql com o mysqli

//Sistema para consultar se o email ja foi utilizado
$stmt = $mysqli->prepare("SELECT * FROM tb_login where email = ? limit 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();
$newResultado = mysqli_fetch_assoc($resultado);


if($newResultado['email'] != $email) { //se o email não foi utilizado ele faz o cadastro
    $stmt = $mysqli->prepare("insert into tb_login(first_name, last_name, email, senha) values (?,?,?,?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
    $stmt->execute();
    echo "<script type='text/javascript'>alert('Usuario cadastrado com sucesso');</script>";
    header('Location: index.php');
}
else {
    echo "Usuario já cadastrado";
}
?>