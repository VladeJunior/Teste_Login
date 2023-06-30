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
$cnpj = $_POST['cnpj'];

// Verificar se o CNPJ existe no banco de dados
$sql = "SELECT COUNT(*) AS cnpjCount FROM manufacturer_base WHERE manufacturer_cnpj = '$cnpj'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$cnpjCount = $row['cnpjCount'];

if ($cnpjCount > 0) {
    // O CNPJ existe, então podemos excluir o registro
    $deleteSql = "DELETE FROM manufacturer_base WHERE manufacturer_cnpj = '$cnpj'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "success";
    } else {
        echo "Erro ao excluir o cadastro: " . $conn->error;
    }
} else {
    // O CNPJ não existe no banco de dados
    echo "CNPJ não encontrado.";
}

$conn->close();
?>
