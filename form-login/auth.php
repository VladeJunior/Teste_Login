<?php
$hostname = 'localhost';
$username = 'teste';
$password = 'teste';
$database = 'teste';

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
  die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE BINARY username = '$username' AND BINARY password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $response = array('success' => true);
} else {
  $response = array('success' => false);
}

echo json_encode($response);

$conn->close();
?>
