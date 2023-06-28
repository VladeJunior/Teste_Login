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

// Obter os dados enviados pelo formulário
$manufacturerName = $_POST['manufacturerName'];
$manufacturerFantasyName = $_POST['manufacturerFantasyName'];
$manufacturerSocialName = $_POST['manufacturerSocialName'];
$manufacturerActive = isset($_POST['manufacturerActive']) ? 1 : 0;
$manufacturerSite = $_POST['manufacturerSite'];
$manufacturerCountry = $_POST['manufacturerCountry'];
$manufacturerCity = $_POST['manufacturerCity'];
$manufacturerBairro = $_POST['manufacturerBairro'];
$manufacturerCnpj = preg_replace('/\D/', '', $_POST['cnpj2']); // Remove tudo que não é dígito

// Verificar se o CNPJ já existe no banco de dados
$existingCnpjQuery = "SELECT COUNT(*) AS cnpjCount FROM manufacturer_base WHERE manufacturer_cnpj = ?";
$existingCnpjStmt = $conn->prepare($existingCnpjQuery);
$existingCnpjStmt->bind_param("s", $manufacturerCnpj);
$existingCnpjStmt->execute();
$existingCnpjResult = $existingCnpjStmt->get_result();
$existingCnpjRow = $existingCnpjResult->fetch_assoc();
$cnpjCount = $existingCnpjRow['cnpjCount'];

// Verificar se o CNPJ já existe para decidir se será feita uma inserção ou atualização
if ($cnpjCount > 0) {
    // Preparar a instrução SQL para atualização dos dados
    $updateSql = "UPDATE manufacturer_base SET manufacturer_name = ?, manufacturer_fantasy_name = ?, manufacturer_social_name = ?, manufacturer_active = ?, manufacturer_site = ?, manufacturer_country = ?, manufacturer_city = ?, manufacturer_bairro = ? WHERE manufacturer_cnpj = ?";
    
    // Preparar a declaração de atualização
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssisssss", $manufacturerName, $manufacturerFantasyName, $manufacturerSocialName, $manufacturerActive, $manufacturerSite, $manufacturerCountry, $manufacturerCity, $manufacturerBairro, $manufacturerCnpj);
    
    // Executar a declaração de atualização
    if ($updateStmt->execute()) {
        echo "success";
    } else {
        echo "Erro ao atualizar a Empresa: " . $updateStmt->error;
    }
    
    $updateStmt->close();
} else {
    // Preparar a instrução SQL para inserção dos dados
    $insertSql = "INSERT INTO manufacturer_base (manufacturer_name, manufacturer_cnpj, manufacturer_fantasy_name, manufacturer_social_name, manufacturer_active, manufacturer_site, manufacturer_country, manufacturer_city, manufacturer_bairro)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar a declaração de inserção
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("sssssssss", $manufacturerName, $manufacturerCnpj, $manufacturerFantasyName, $manufacturerSocialName, $manufacturerActive, $manufacturerSite, $manufacturerCountry, $manufacturerCity, $manufacturerBairro);

    // Executar a declaração de inserção
    if ($insertStmt->execute()) {
        echo "success";
    } else {
        echo "Erro ao salvar a Empresa: " . $insertStmt->error;
    }

    $insertStmt->close();
}

$existingCnpjStmt->close();
$conn->close();
?>
