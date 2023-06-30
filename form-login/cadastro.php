<?php
// Dados de conexão ao banco de dados
$servername = "localhost";
$username = "teste";
$password = "teste";
$dbname = "teste";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém os dados enviados pelo formulário
$nome = $_POST['nome'];
$senha = $_POST['senha'];

// Insere os dados na tabela "users"
$sql = "INSERT INTO users (username, password) VALUES ('$nome', '$senha')";
if ($conn->query($sql) === true) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Erro ao cadastrar usuário: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna a resposta como JSON
header('Content-type: application/json');
echo json_encode($response);
?>
