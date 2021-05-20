/*
    Cambia el listado de productos y los lista segun la categoria indicada.
*/
function cambiarCategoria(id, token) {
    /*
        Lanza una peticion ajax con el id de la categoria que quiere mostrar.
    */
    $.ajax({
        url: '/cambiarCategoria',
        method: 'post',
        data: {
            '_token': token,
            'id': id
        },
        error: function (response) {
            /*
                Si la peticion ajax terorna error lanza un pop up comunicando el error.
            */
            alert(response['statusText']);
        },
        success: function (response) {
            /*
                Si la peticion ajax funciona correctamente lista todos los videos de esa categoria y muestra la categoria.
            */
            document.getElementById('productes').innerHTML = response;
        }
    });

}

/*
    Muestra la preview de los videos.
*/
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
