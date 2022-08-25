<main style="overflow: hidden;"  class="">
   <section class="vh-100 bg-light">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-6 col-lg-4">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div id="return"></div>
              <form id='login' class="login card-body pl-5 pr-5 pb-5 text-center">

                <div class="mb-md-3 p-3">

                  <h2 class="fw-bold mb-2 text-uppercase p-5">Acesso</h2>

                  <div class="form-outline form-white mb-4">
                    <input type="text" id="typeEmailX" class="form-control form-control-lg" />
                    <label class="form-label" for="typeEmailX">Login</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                    <label class="form-label" for="typePasswordX">Senha</label>
                  </div>

                  <button class="btn btn-outline-light px-5 btn-js" type="button">Entrar</button>

                <input type="hidden" name="token" value="Login" required/>
                <input type="hidden" name="key" value="Acesso" required/>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
</main>

<script type="text/javascript">
 document.querySelector(".btn-js").addEventListener("click", function() {
    let login = document.querySelector('.login');
    let formData = new FormData(login), object = {};

    formData.forEach((value, key) => object[key] = value);

    let json = JSON.stringify(object), 
    ajax = new XMLHttpRequest();

    ajax.open("POST", "index.php", true), 
    ajax.setRequestHeader("Content-type", "application/json"), 
    ajax.send(json), ajax.onreadystatechange = function() {
    
        if (ajax.readyState == 4 && ajax.status == 200) {
            let data = JSON.parse(ajax.responseText);
            switch(data.tipo){
                case 'success': document.getElementById('return').innerHTML = "<div class='alert alert-success m-2'>" + data.msg + "</div>"; break;
                case 'erro': document.getElementById('return').innerHTML = "<div class='alert alert-danger m-2'>" + data.msg + "</div>"; break;
                default:  document.getElementById('return').innerHTML = "Falha na requisição tente novamente mais tarde."; break;
            }

            if(data.url){
                setTimeout(function() {
                    window.location.href = data.url;
                }, 2000);
            }
        }else{
            document.getElementById('return').innerHTML = "ERROR 404 | Não é possivel achar o destino da requisição.";
        }
    }
});
</script>