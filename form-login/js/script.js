//Script para a tela Login
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'auth.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
            showMessageS('Login efetuado com sucesso');
            setTimeout(function() {
              window.location.href = 'cadempresa.html';
            }, 2000);
        } else {
          showMessageD('Nome de usuário ou senha incorretos');
          setTimeout(function() {
            window.location.href = 'index.html';
          }, 1500);
        }
      } else {
        showMessageD('Erro na solicitação');
      }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password));
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