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

// Consultar todos os registros de empresas no banco de dados
$sql = "SELECT * FROM manufacturer_base";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Empresas encontradas, retornar os dados em formato JSON
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    // Nenhuma empresa encontrado
    echo null;
}

$conn->close();
?>
