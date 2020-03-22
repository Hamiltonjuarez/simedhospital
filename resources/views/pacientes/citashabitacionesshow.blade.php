@extends('theme.lte.layout')
@section('styles')
    
    <link rel="stylesheet" href="{{asset("assets/plugins/fullcalendar/fullcalendar.min.css")}}">
    <link rel="stylesheet" href="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.css")}}">
    <style>
        .e{
            text-align: center;
        }
    </style>
@endsection
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border border-primary  mt-2">
                <div class="card-body">
                    @include('pacientes.Notificaciones.success')
                    <button class="btn btn-sm btn-primary priority-1" id="createEvent" style="display:none;width:100%" onclick="createEventMovil()">NUEVO EVENTO</button>
                    <div class="e">
                      <h2>{{$habitacion->habitacion_nombre}}</h2>
                    {{-- <h3>Paciente: <u>{{$paciente->nombre." ".$paciente->apellidos}}</u></h3> --}}
                    </div>
                    <div id="calendar">                       
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalevento" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('calendarinsert')}}" method="POST" id="nuevoevento" >
                        @csrf                        
                        <input type="hidden" name="doctor_id" value="{{Auth::user()->doctor_id}}">
                        <input type="hidden" name="habid" id="habid" value="{{$habitacion->id}}">
                        <div class="row">
                            <div class="col">
                                <label id="textoinicio"> NUEVO EVENTO</label>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mt-4" >
                                    <input type="text" class="form-control" id="title" name="title" value="" placeholder="Título del evento" required>
                                </div>     
                            </div>                     
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="end">SELECCIONE UN PACIENTE:</label>
                                <select name="paciente_id" id="paciente" class="form-control">
                                    @isset($paciente)<option value="{{$paciente->id}}"  >{{$paciente->nombre.' '.$paciente->apellidos}}</option>@endisset
                                    @empty($paciente)
                                        <option value=""  id="seleccionado">Ninguno</option>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{$paciente->id}}">{{$paciente->nombre.' '.$paciente->apellidos}}</option>
                                        @endforeach
                                    @endempty
                               </select>
                            </div>     
                            </div>                     
                        </div>
                    {{-- <input type="hidden" name="paciente_id" value="{{$paciente->id}}"> --}}
                        <div class="row border">
                            <div class="col-md-6">
                                <div class="form-group" id="inicio" style="display:block">
                                    <label for="start">Fecha de inicio:</label>
                                    <input type="text" class="form-control" id="datestart" name="datestart" autocomplete="false">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="inicio" style="display:block">
                                    <label for="start">Hora de inicio:</label>
                                    <input type="text" class="form-control" id="timestart" name="timestart">
                                </div>
                            </div>
                        </div>
                        <div class="row border mt-1"> 
                            <div class="col-md-6">
                                <div class="form-group" id="fin" style="dislpay: block">
                                    <label for="end">Fecha fin:</label>
                                    <input type="text" class="form-control" id="dateend" name="dateend">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="fin" style="dislpay: block">
                                    <label for="end">Hora fin:</label>
                                    <input type="text" class="form-control" id="timeend" name="timeend">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <div class="form-group">                                 
                                    <textarea class="form-control" name="detallevento" id="detallevento" rows="7" placeholder="Descripción del evento"></textarea>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" >Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-primary">Guardar </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="modalevento2" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{route('calendarupdate')}}" method="POST" id="editarevento" >
                            @csrf
                            <input type="hidden" name="habid" id="habid" value="{{$habitacion->id}}">
                            <input type="hidden" name="doctor_id" value="{{Auth::user()->doctor_id}}">
                            <div class="row">
                                <div class="col">
                                    <label id="textoinicio"> EDITAR EVENTO</label>
                                </div>
                                <div class="col text-right">
                                    <button type="button" class="btn btn-sm btn-warning" id="btneditar"  onclick="modificarevent()">  <i class="fa fa-pencil" aria-hidden="true"></i>                         
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" id="btneliminar" onclick="modaleliminar()" > <i class="fa fa-trash" aria-hidden="true"></i>    
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" id="btncerrar" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mt-3" >
                                        <input type="text" class="form-control" id="titles" name="titles" value="" placeholder="SELECCIONE TITULO DE EVENTO" required disabled>
                                    </div>     
                                </div>                     
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="end">SELECCIONE UN PACIENTE:</label>
                                    <select name="paciente_id"  class="form-control" id="seleccion">
                                        <option value=""  id="seleccionado">Ninguno</option>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{$paciente->id}}">{{$paciente->nombre.' '.$paciente->apellidos}}</option>
                                        @endforeach
                                    </select>
                                </div>     
                                </div>                     
                            </div>
                        {{-- <input type="hidden" value="{{$paciente->id}}" name="paciente_id"> --}}
                            <input type="hidden" name="id" id="aydi" value="">
                            <div class="row border">
                                <div class="col-md-6">
                                    <div class="form-group" id="inicio" style="display:block">
                                        <label for="start">Fecha de inicio:</label>
                                        <input type="text" class="form-control" id="datestartedit" name="datestart" autocomplete="false">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="inicio" style="display:block">
                                        <label for="start">Hora de inicio:</label>
                                        <input type="text" class="form-control" id="timestartedit" name="timestart">
                                    </div>
                                </div>
                            </div>
                            <div class="row border mt-1"> 
                                <div class="col-md-6">
                                    <div class="form-group" id="fin" style="dislpay: block">
                                        <label for="end">Fecha fin:</label>
                                        <input type="text" class="form-control" id="dateendedit" name="dateend">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="fin" style="dislpay: block">
                                        <label for="end">Hora fin:</label>
                                        <input type="text" class="form-control" id="timeendedit" name="timeend">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="form-group">                                 
                                        <textarea class="form-control" name="detalleventos" id="detalleventos" rows="7" placeholder="DETALLES DE EVENTO"></textarea>
                                    </div>
                                </div>   
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">CANCELAR</button>
                                <button type="submit" class="btn btn-sm btn-primary" id="editarbtn">GUARDAR </button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="modaleliminar" name="modaleliminar" tabindex="-1" role="dialog">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                        <h5 class="modal-title">¿DESEA ELIMINAR EVENTO?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route("calendardelete") }}" method="POST">
                            @csrf
                        <input type="hidden" value="{{$paciente->id}}">
                       
                        <input type="hidden" id="paso" name="id">
                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">CANCELAR</button>
                      <button type="submit" class="btn btn-sm btn-danger" {{-- onclick="eliminar()" --}} >ELIMINAR</button>
                    </form>
                  </div>
               </div>
            </div>
        </div>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/fullcalendar/fullcalendar.min.js")}}"></script>
    <script src="{{asset("assets/plugins/fullcalendar/es.js")}}"></script>
    <script src="{{asset("js/fullcalendar/bootstrap-datetimepicker.min.js")}}"></script>
    <script src="{{asset("js/fullcalendar/jquery.ui.touch.js")}}"></script>
    

    <script>   
            $(function(){
                if ($(window).width() < 700)
                { 
                document.getElementById('createEvent').style.display = "block";
                }
                else {
                    document.getElementById('createEvent').style.display = "none";
                }
            });

            function createEventMovil(){
                $('#modalevento').modal('show');
                $('#datestart').datetimepicker({
                    format: 'L',
                    date: moment().format(),
                });
                $('#dateend').datetimepicker({
                    format: 'L',
                    date: moment().format(),
                });
                $('#timestart').datetimepicker({
                    format: 'LT',
                    date: moment().format(),
                });
                $('#timeend').datetimepicker({
                    format: 'LT',
                    date: moment().format(),
                });
                
            }
            function modaleliminar(){
                $('#modaleliminar').modal('show');
            }
            function modificarevent(){
                document.getElementById("titles").disabled = false;
                document.getElementById("seleccion").disabled = false;
                document.getElementById("datestartedit").disabled = false;
                document.getElementById("dateendedit").disabled = false;
                document.getElementById("timestartedit").disabled = false;
                document.getElementById("detalleventos").disabled = false;
                document.getElementById("timeendedit").disabled = false;
                document.getElementById("editarbtn").disabled = false;
            }

            function eliminar(){
            var dato = $('#paso').val(); 
           
                        $.ajax({
                          url: '{{ route("calendardelete") }}',
                          type: 'POST',
                          data:{'id':dato, '_token': '{{ csrf_token() }}'},
                       success:function(response)
                    {
                        
                        var habitacion = $('#habid').val();
                        window.location="{{route('prueba')}}"+'/'+habitacion;
                       
                    }
               });
            }

            $(document).ready(function(){
              /*   echo "<center><h1>sdvsdsfvdfvdfvdvsdv</h1></center>"; */
                var dato = $('#habid').val();
               
               var calendar = $("#calendar").fullCalendar({
                editable : true,
                defaultView: $(window).width() < 700 ? 'agendaDay' : 'agendaWeek',
                allDaySlot: false,
                lang: 'es',
                height: 1150,
                header : {
                    right: 'title',
                    center: 'title2',
                    left: $(window).width() < 700 ? "prev,next,today,agendaDay,month" : "prev,next,today,agendaDay,agendaWeek,month",
                }, 
                
               
                minTime: '07:00:00',
                maxTime: '17:00:00',
                slotDuration: '00:15:00',
               // eventColor: '#ff4dc4',
                //slotLabelInterval: 15,
                slotLabelFormat: '(h:mm)a',
                //slotMinutes: 15,
                events: {!!$citashabitacion!!},
                selectable : true,
                selectHelper : true,
                eventAfterRender: function(event, element, view) {
                    element.draggable();
                    },
                select: function(start, end, allDay)
                {
                    $('#modalevento').modal('show');        
                    @isset($tipo)
                        var title = "{{$tipo}}";
                        $('#title').val(title);
                        $('#datestart').datetimepicker({
                            format: 'L'
                        }).val(moment(start).format('DD/MM/YYYY')); 
                        $('#timestart').datetimepicker({
                            format: 'LT',
                            locale: 'es',
                        }).val(moment(start).format('HH:mm'));
                        $('#dateend').datetimepicker({
                            format: 'L',
                        }).val(moment(end).format('DD/MM/YYYY')); 
                        $('#timeend').datetimepicker({
                            format: 'LT',
                            locale: 'es'
                        }).val(moment(end).format('HH:mm'));   
                    @endisset
                    @empty($tipo)
                        $('#datestart').datetimepicker({
                            format: 'L'
                        }).val(moment(start).format('DD/MM/YYYY')); 
                        $('#timestart').datetimepicker({
                            format: 'LT',
                            locale: 'es',
                        }).val(moment(start).format('HH:mm'));
                        $('#dateend').datetimepicker({
                            format: 'L',
                        }).val(moment(end).format('DD/MM/YYYY')); 
                        $('#timeend').datetimepicker({
                            format: 'LT',
                            locale: 'es'
                        }).val(moment(end).format('HH:mm'));         
                    @endempty
                    $('#modalevento').on('hidden.bs.modal', function(){
                        //document.getElementById('nuevoevento').reset();
                    });
                },
                editable: true,
                windowResize: function(view){
                    if ($(window).width() < 700)
                    { 
                        $('#calendar').fullCalendar('changeView', 'agendaDay');
                        $('#calendar').find('.fc-agendaWeek-button ').hide();
                        document.getElementById('createEvent').style.display = "block";
                        }
                    else {
                        $('#calendar').fullCalendar('changeView', 'agendaWeek');
                        $('#calendar').find('.fc-agendaWeek-button ').show();
                        document.getElementById('createEvent').style.display = "none";
                    }
                },
                eventResize: function(event)
                {
                    var start= moment(event.start).format("Y-MM-DD HH:mm:ss");
                    var end= moment(event.end).format("Y-MM-DD HH:mm:ss");
                    var id= event.id;
                    $.ajax({
                        url: '{{ route("calendarupdateajax") }}',
                        type: 'POST',
                        data:{'id':id, 'start':start, 'end':end, '_token': '{{ csrf_token() }}'},
                        success:function(response)
                        {

                        }
                    });
                },
                eventDrop: function(event)
                {
                    var start= moment(event.start).format("Y-MM-DD HH:mm:ss");
                    var end= moment(event.end).format("Y-MM-DD HH:mm:ss");
                    var id= event.id;
                    $.ajax({
                        url: '{{ route("calendarupdateajax") }}',
                        type: 'POST',
                        data:{'id':id, 'start':start, 'end':end, '_token': '{{ csrf_token() }}'},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                        }
                    });
                },
                eventClick: function(event){
                    document.getElementById("titles").disabled = true;
                    document.getElementById("datestartedit").disabled = true;
                    document.getElementById("dateendedit").disabled = true;
                    document.getElementById("seleccion").disabled = true;
                    document.getElementById("timestartedit").disabled = true;
                    document.getElementById("detalleventos").disabled = true;
                    document.getElementById("timeendedit").disabled = true;
                    document.getElementById("editarbtn").disabled = true;
                    var id=event.id;
                    $('#aydi').val(id);
                    $('#paso').val(id);
                    $('#modalevento2').modal('show');
                    $.ajax({
                            url: '{{ route("citas.edit") }}',
                            type: 'POST',
                            data:{'id':id, '_token': '{{ csrf_token() }}'},
                    success:function(response)
                        {
                            var select = document.getElementById("seleccion");
                            for(var i=1;i<select.length;i++)
                            {
                                if(select.options[i].value==response["idpaciente"])
                                {
                                    select.selectedIndex=i;
                                }
                            }
                            $('#titles').val(response["title"]);
                            $('#detalleventos').val(response["descripcion"]);
                            $('#datestartedit').datetimepicker({
                                format: 'L'
                            }).val(moment(response["datestart"]).format('DD/MM/YYYY'));
                            $('#dateendedit').datetimepicker({
                                format: 'L'
                            }).val(moment(response["dateend"]).format('DD/MM/YYYY')); 
                            $('#timestartedit').datetimepicker({
                                format: 'LT',
                                locale: 'es',
                            }).val(response["timestart"]);    
                            $('#timeendedit').datetimepicker({
                                format: 'LT',
                                locale: 'es',
                            }).val(response["timeend"]);        
                        }
                        });                  
                },
            });
            $('#calendar').addTouch();
        });
    </script>
@endsection

