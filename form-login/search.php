<?php
// Fazer a conexão com o banco de dados
$servername = "localhost";
$username = "teste";
$password = "teste";
$dbname = "teste";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter o CNPJ enviado pelo formulário
//$cnpj = $_POST['cnpj'];
$cnpj = preg_replace('/\D/', '', $_POST['cnpj']);

// Consultar o fabricante no banco de dados
$sql = "SELECT * FROM manufacturer_base WHERE manufacturer_cnpj = '$cnpj'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fabricante encontrado, retornar os dados em formato JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Fabricante não encontrado
    echo null;
}

$conn->close();
?>
