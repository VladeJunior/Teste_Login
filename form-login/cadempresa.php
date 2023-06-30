<?php
session_start();

// Verifica se o usuário está autenticado Redireciona o usuário
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
  header('Location: index.html');
  exit();
}

// Verifica se o usuário fez logout e limpa a sessão
if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header('Location: index.html');
  exit();
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>Pesquisa e Cadastro de Empresa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/cad.js"></script>
  <link rel="stylesheet" href="css/cad.css">
</head>
<body>

  <div class="container">
    <div class="logout-container">
      <a onclick="logout()" href="?logout=true" class="btn btn-outline-primary btn-logout">Sair</a>
    </div>
    <h2>Pesquisa/Cadastro de Empresa</h2>
    <form id="searchForm">
      <div class="row">
        <div class="form-group col-md-4">
          <label for="cnpj">CNPJ:</label>
          <div class="input-group">
            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" required>
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
    <hr>
    <form id="gridForm">
      <table id="manufacturerTable" class="table">
        <thead>
          <tr>
            <th>CNPJ</th>
            <th>Nome</th>
            <th>Nome Fantasia</th>
            <th>Razão Social</th>
            <th>Ativo</th>
            <th>Site</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>País</th>
          </tr>
        </thead>
        <tbody>
          <!-- Os registros serão adicionados aqui via JavaScript -->
        </tbody>
      </table>
    </form>
    <form id="manufacturerForm" style="display: none;">
      <div class="form-group">
        <input type="text" class="form-control" id="cnpj2" name="cnpj2" placeholder="CNPJ" hidden>
      </div>
      <div class="row">
        <div class="form-group col-md-3">
          <label for="manufacturerName">Nome:</label>
          <input type="text" class="form-control" id="manufacturerName" name="manufacturerName" required>
        </div>
        <div class="form-group col-md-4">
          <label for="manufacturerFantasyName">Nome Fantasia:</label>
          <input type="text" class="form-control" id="manufacturerFantasyName" name="manufacturerFantasyName" required>
        </div>
        <div class="form-group col-md-4">
          <label for="manufacturerSocialName">Razão Social:</label>
          <input type="text" class="form-control" id="manufacturerSocialName" name="manufacturerSocialName" required>
        </div>
      
        <div class="form-group col-md-1">
          <label for="manufacturerActive">Ativo:</label>
          <input type="checkbox" class="form-control" id="manufacturerActive" name="manufacturerActive" value="1">
        </div>
      </div>
      <div class="form-group">
        <label for="manufacturerSite">Site:</label>
        <input type="text" class="form-control" id="manufacturerSite" name="manufacturerSite">
      </div>
      <div class="row">
        <div class="form-group col-md-5">
          <label for="manufacturerBairro">Bairro:</label>
          <input type="text" class="form-control" id="manufacturerBairro" name="manufacturerBairro">
        </div>
        <div class="form-group col-md-4">
          <label for="manufacturerCity">Cidade:</label>
          <input type="text" class="form-control" id="manufacturerCity" name="manufacturerCity">
        </div>
        <div class="form-group col-md-3">
          <label for="manufacturerCountry">País:</label>
          <input type="text" class="form-control" id="manufacturerCountry" name="manufacturerCountry">
        </div>        
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
      <button type="submit" onclick="recarregarPagina()" class="btn btn-info">Nova Pesquisa</button>
      <button type="button" class="btn btn-danger" id="deleteManufacturerBtn">Excluir</button>

    </form>
  </div>
  
  <script>
      function recarregarPagina() {
        location.reload();
      }
      // Função para formatar o CNPJ com máscara
      function formatCnpj(cnpj) {
        // Remove tudo que não é dígito
        cnpj = cnpj.replace(/\D/g, '');
      
        // Aplica a máscara
        cnpj = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
      
        return cnpj;
      }
      
      // Evento para formatar o CNPJ ao digitar
        document.getElementById('cnpj').addEventListener('keyup', function() {
        var cnpjInput = this;
        var cnpj = cnpjInput.value;
      
        cnpjInput.value = formatCnpj(cnpj);
      });
      
      // Evento para remover a máscara e enviar somente os números
      document.getElementById('form').addEventListener('submit', function() {
        var cnpjInput = document.getElementById('cnpj2');
        var cnpj = cnpjInput.value;
      
        // Remove tudo que não é dígito
        cnpjInput.value = cnpj.replace(/\D/g, '');
      });
  </script>
  <script>
    function logout() {
      localStorage.removeItem('isLoggedIn'); // Remover a sessão do usuário
      window.location.href = 'index.html'; // Redirecionar para a página de login
    }
  </script>
</body>
</html>
