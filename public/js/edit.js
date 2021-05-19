function eliminarProducte(id, token) {
    $('#modal').modal('toggle');
    $.ajax({
        url: '/eliminarProducte',
        method: 'post',
        data: {
            '_token': token,
            'id': id
        },
        error: function (response) {
            var alertDiv = `<div class="modal fade" id="modal2">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Delete Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                        </div>
                        <div class="modal-body">
                        <p>` + response['statusText'] + `</p>
                        </div>
                    </div>
                    </div>
            </div>`;
            document.getElementById("container").innerHTML += alertDiv;
            $('#modal2').modal('toggle');
            //alert("Has de fer login per a poder comentar!");
        },
        success: function (response) {
            cambiar = `<div class="card-header">Product deleted!</div>
            <div class="card-body">  
                <p class="alert alert-success">The product was deleted!</p>
            </div>`;
            document.getElementById('card').innerHTML = cambiar;
        }
    });

}
