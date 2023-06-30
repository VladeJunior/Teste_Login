$(document).ready(function() {


    $('#searchForm').submit(function(event) {
      event.preventDefault();
      var cnpj = $('#cnpj').val(); 
      var valorCampo1 = document.getElementById("cnpj").value;
      document.getElementById("cnpj2").value = valorCampo1;
  
      $.ajax({
        url: 'search.php',
        type: 'POST',
        data: { cnpj: cnpj },
        success: function(response) {
          if (response) {
            var data = JSON.parse(response);
            fillForm(data);
            hideFormS();
          } else {
            showForm(cnpj); // Passa o CNPJ como parâmetro
            hideFormS();
          }
        }
      });
    });
  
    $('#manufacturerForm').submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
  
      $.ajax({
        url: 'save.php',
        type: 'POST',
        data: formData,
        success: function(response) {
          if (response === 'success') {
            alert('Empresa salva com sucesso!');
            $('#searchForm')[0].reset();
            $('#manufacturerForm')[0].reset();
            location.reload(); // Recarrega a página
            hideForm();
          } else {
            alert('Erro ao salvar a Empresa. Por favor, tente novamente.');
          }
        }
      });
    });
  
    function fillForm(data) {
      $('#cnpj2').val(data.manufacturer_cnpj); // Preenche o campo CNPJ
      $('#manufacturerName').val(data.manufacturer_name);
      $('#manufacturerFantasyName').val(data.manufacturer_fantasy_name);
      $('#manufacturerSocialName').val(data.manufacturer_social_name);
      $('#manufacturerActive').prop('checked', data.manufacturer_active);
      $('#manufacturerSite').val(data.manufacturer_site);
      $('#manufacturerCountry').val(data.manufacturer_country);
      $('#manufacturerCity').val(data.manufacturer_city);
      $('#manufacturerBairro').val(data.manufacturer_bairro);
      showForm(data.manufacturer_cnpj); // Passa o CNPJ como parâmetro
    }
  
    function showForm(cnpj) {
      $('#cnpj2').val(cnpj); // Preenche o campo CNPJ no segundo formulário
      $('#manufacturerForm').show();
    }
  
    function hideForm() {
      $('#manufacturerForm').hide();
    }

    function hideFormS() {
      $('#gridForm').hide();
    }

      // Evento de clique no botão "Excluir"
      $('#deleteManufacturerBtn').on('click', function() {
        if (confirm('Tem certeza de que deseja excluir este cadastro?')) {
          var cnpj = $('#cnpj2').val();

          // Requisição AJAX para excluir a empresa
          $.ajax({
            url: 'delete.php',
            type: 'POST',
            data: { cnpj: cnpj },
            success: function(response) {
              if (response === 'success') {
                alert('Cadastro excluído com sucesso.');
                location.reload(); // Recarrega a página
              } else {
                alert('Erro ao excluir o cadastro.');
              }
            },
            error: function() {
              alert('Erro na requisição AJAX para excluir a empresa.');
            }
          });
        }
      });

      // Função para carregar os registros existentes
        function loadManufacturers() {
          $.ajax({
            url: 'searchT.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              if (data && data.length > 0) {
                var tableBody = $('#manufacturerTable tbody');
                tableBody.empty();

                for (var i = 0; i < data.length; i++) {
                  var manufacturer = data[i];
                  var row = '<tr>';
                  row += '<td>' + manufacturer.manufacturer_cnpj + '</td>';
                  row += '<td>' + manufacturer.manufacturer_name + '</td>';
                  row += '<td>' + manufacturer.manufacturer_fantasy_name + '</td>';
                  row += '<td>' + manufacturer.manufacturer_social_name + '</td>';
                  row += '<td>' + (manufacturer.manufacturer_active == 1 ? 'Sim' : 'Não') + '</td>';
                  row += '<td>' + manufacturer.manufacturer_site + '</td>';
                  row += '<td>' + manufacturer.manufacturer_country + '</td>';
                  row += '<td>' + manufacturer.manufacturer_city + '</td>';
                  row += '<td>' + manufacturer.manufacturer_bairro + '</td>';
                  row += '</tr>';
                  tableBody.append(row);
                }
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(errorThrown);
            }
          });
        }

        // Chamar a função para carregar os registros ao carregar a página
        $(document).ready(function() {
          loadManufacturers();
        });
});