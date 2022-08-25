document.querySelector(".btn-login").addEventListener("click", function() {
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
                case 'success': document.getElementById('return').innerHTML = data.msg; break;
                case 'erro': document.getElementById('return').innerHTML = data.msg; break;
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
