

//realizar consultas com ajax e jquery

document.addEventListener('DOMContentLoaded', function () {
    $('button[name="botao"]').on('click', function () {
      let input = $('input[name="teste"]');
      let inputValue = input.val();
      let a = document.getElementById('a');
  
      $.ajax({
        url: 'pesquisa',
        type: "GET",
        data: { input: inputValue },
        beforeSend: function () {
          a.classList.add('alert-success');
          a.innerHTML = 'Carregando...';
        },
        success: function (response) {
  
          a.classList.remove('alert-success');
          let texto = '';
          if (typeof response !== 'undefined' && response.length > 0) {
            response.forEach((e) => {
              texto += `
      <div class="col-md-3">
      <div class="card">
      <div class="card-body">
      <a href="/produto/show/${e.id}"><div class="card-img-top"></div></a>
      <div class="card-title">Título: ${e.nome_prod}</div>
      <div class="card-title">Valor: R$ ${e.valor_prod},00</div>
      <a href="/produto/show/${e.id}" class="comprar">Comprar</a>
      </div>
      </div>
      </div>
      `;
            });
            document.getElementById('paragrafo').innerHTML = texto;
            a.classList.remove('alert-danger');
            a.innerHTML = '';
          } else {
            document.getElementById('paragrafo').innerHTML = '';
            a.classList.add('alert-danger');
            a.innerHTML = 'Não foram encontrados registros!';
          }
        }
      });
    });
  });