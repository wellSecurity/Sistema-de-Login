<?php
session_start();
//variaveis do index post
$email = $_POST['email'];
$password = $_POST['password'];

$mysqli = new mysqli("localhost", "root", "", "login"); //instanciando e acessando o sql com o mysqli

$stmt = $mysqli->prepare("SELECT * FROM tb_login where email = ? && senha = ? limit 1"); //consultando ser os dados existe no db
$stmt->bind_param("ss", $email, $password);

$stmt->execute();
$resultado = $stmt->get_result();
$newResultado = mysqli_fetch_assoc($resultado);

if($newResultado['email'] == $email && $newResultado['senha'] == $password) { //se caso os dados baterem ele faz o login 
    echo "Login realizado com sucesso";
    $_SESSION['login'] = $email;
    $_SESSION['first_name'] = $newResultado['first_name'];
    $_SESSION['last_name'] = $newResultado['last_name'];
    header("Location:home.php");
}

else {
    session_destroy();
    header("Location:index.php");
}

?>