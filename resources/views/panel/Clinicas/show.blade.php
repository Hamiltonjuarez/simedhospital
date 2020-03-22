@extends('theme.lte.layout')
@section('contenido')
<div class="card">
    <div class="card-header">
    <h2  class="text-secondary align-center" style="font-family: fantasy;">{{$clinica->nombreClinica}}</h2>
    </div>
    <div class="card-body">
        <div class="row" >
            <div class="col-md-4 border-right">{{$clinica->slogan}} 
            </div>
            <div class="col-md-4" style="padding-left:3%">
               <div class="row" >
                   
                       <h3>Detalles de la Clinica</h3>
                   <hr>
               </div>
               
               <div class="row">
                    <div class="col-md-4">nombre:</div>
                    <div class="col-md-4">{{$clinica->nombreClinica}}</div>
               </div>
               <br>
               <div class="row">
                     <div class="col-md-4">direccion:</div>
                     <div class="col-md-6">{{$clinica->direccion}}</div>
                </div>
                <br>
                <div class="row">
                     <div class="col-md-4">Telefono:</div>
                     <div class="col-md-4">{{$clinica->telefonos}}</div>
                </div>
                <hr>
                <div class="row">
                     <div class="col-md-4">Celular:</div>
                     <div class="col-md-4">{{$clinica->celular}}</div>
                </div>
               
            </div>
            <div class="col-md-4">
                    <div class="row"> 
                        <h3> Redes sociales</h3>                      
                    </div>
                    <div class="row">
                         <div class="col-md-4">Facebook :</div>
                         <div class="col-md-5">{{$clinica->facebook }}</div>
                    </div>
                    <br>
                    <div class="row">
                          <div class="col-md-4">Instagram :</div>
                          <div class="col-md-5">{{$clinica->instagram}}</div>
                     </div>
                     <br>
                     <div class="row">
                          <div class="col-md-4">Pagina Web:</div>
                          <div class="col-md-5">{{$clinica->paginaWeb}}</div>
                     </div>
                     <br>
                     <div class="row">
                          <div class="col-md-4">Correo:</div>
                          <div class="col-md-5">{{$clinica->email}}</div>
                     </div>
                    <br>
                  
                </div>
        </div>
    </div>
</div>
@endsection