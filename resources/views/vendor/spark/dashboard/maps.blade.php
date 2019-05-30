  <div id="txtGoogleLocationSearch" class="pull-left" style="display: block;">
    <div class="right-inner-addon">
        <i class="fa fa-search"></i>
        <input type="search" class="form-control" id="pac-input" placeholder="Ingrese una ubicación" autocomplete="off">
    </div>
</div>
<div id="btn-createpool" class="pull-left" style="display: block;">
   <!-- <div class="btn-group-lg">
       <button id="createpool" class="btn btn-primary btn-sm" style="padding: 0.3rem 0.5rem">Agregar Piscina</button>
         <button id="cancel" class="btn btn-danger btn-sm" style="padding: 0.3rem 0.5rem;display: none">Cancelar</button>
    </div>-->
</div>
<div id="form_pool" class="card bg-white bx-25" style="z-index: 999; position: absolute; top: 35%; display: none">
<div class="card-body">
   <div class="row mx-auto"> 
    <form class="form-group" role="form" role="form" method="POST" action="{{route('pools.store')}}">
    {{ csrf_field() }}
        <div class="col-md-12  mx-auto">
        <label for="name">Nombre de la piscina</label>
        <input class="form-control mb-2" type="text" name="name" placeholder="nombre" id="name" required>
        <label for="size">Tamaño (Hectáreas)</label>
        <input class="form-control mb-2" type="text" name="size" placeholder="Area" id="size" readonly>
        <input class="form-control mb-2" type="hidden" name="coordinates" placeholder="coordenadas" id="coordinates">
    </div>
   
           <button id="savePool" class="btn btn-success btn-block" type="submit">Guardar</button>
   
</form>
</div>
</div>
</div>

<div id="info_pool" class="card bg-white bx-25" style="z-index: 999; position: absolute; top: 60%; display: none">
<div class="card-body">
   <div class="row mx-auto"> 
   <label id="lbname"></label>
   <label id="lbsize"></label>
  </div>
</div>
</div>
<div class="bl-primary" style="width: 150%; height: 100%;">
   <div id="map"></div>
</div>
