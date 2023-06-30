document.getElementById('cadastro-form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    var nome = document.getElementById('nome').value;
    var senha = document.getElementById('senha').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'cadastro.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          showMessageS('Cadastro realizado com sucesso');
          setTimeout(function() {
            window.location.href = 'index.html';
          }, 2000);
        } else {
          showMessageD('Erro ao realizar o cadastro');
        }
      } else {
        showMessageD('Erro na solicitação');
      }
    };
    xhr.send('nome=' + encodeURIComponent(nome) + '&senha=' + encodeURIComponent(senha));
  });
  
  function showMessageS(message, type = 'success') {
    var messageElement = document.getElementById('message');
    messageElement.innerHTML = message;
    messageElement.classList.add('alert', 'alert-' + type);
  }
  
  function showMessageD(message, type = 'danger') {
    var messageElement = document.getElementById('message');
    messageElement.innerHTML = message;
    messageElement.classList.add('alert', 'alert-' + type);
  }
  