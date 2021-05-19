function cambiarCategoria(id, token) {

    $.ajax({
        url: '/cambiarCategoria',
        method: 'post',
        data: {
            '_token': token,
            'id': id
        },
        error: function (response) {
            alert(response['statusText']);
            //alert("Has de fer login per a poder comentar!");
        },
        success: function (response) {
            document.getElementById('productes').innerHTML = response;
        }
    });

}

function bigImg(x) {
    x.autoplay = true;
    x.preload = "auto";
    if (x.readyState == 4) {
        x.play();
    }
}

function normalImg(x) {
    x.autoplay = false;
    if (x.readyState == 4) {
        x.pause();
        var v = x.src
        x.src = "";
        x.src = v;
    }
}
