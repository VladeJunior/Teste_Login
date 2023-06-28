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
          } else {
            showForm(cnpj); // Passa o CNPJ como parâmetro
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
});