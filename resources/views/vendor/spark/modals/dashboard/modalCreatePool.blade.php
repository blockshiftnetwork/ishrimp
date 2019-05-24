<div class="modal fade" id="createPoolModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Piscina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="m-0 mb-4 mt-4 row">
    <div class="col-md-6 mx-auto">
        <form class="form-group" role="form" role="form" method="POST" action="{{route('pools.store')}}">
            {{ csrf_field() }}
        <div class="form-group">
        <label for="name">Nombre de la piscina</label>
        <input class="form-control mb-2" type="text" name="name" placeholder="nombre" id="name" required>
            </div>
        <div class="form-group">
        <label for="size">Tamaño (Hectáreas)</label>
        <input class="form-control mb-2" type="text" name="size" placeholder="10.00" id="size" pattern="^\d*\.?\d*$" required>
        </div>
        <input class="form-control mb-2" type="hidden" name="coordinates" placeholder="coordenadas" id="coordinates">
           <button id="savePool" class="btn btn-success btn-block" type="submit">Guardar</button>
   
        </form>
        </div>
        </div>
        </div>
    </div>
</div>