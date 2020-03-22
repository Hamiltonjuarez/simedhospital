
 @if($estado_traslado == 'enviado')
 <a {{-- style="display:none" --}} href="{{ route('estacion.enviar', $id) }}" class="btn btn-success btn-sm priority-1"  title="Generar reporte de procedimiento "><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Llego paciente</a>
 
 <a  href="{{ route('consultas.create', $id) }}" class="btn btn-info btn-sm"  title="Generar nueva consulta"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;CONSULTA</a>
 @else
 <a  href="{{ route('consultas.create', $id) }}" class="btn btn-info btn-sm"  title="Generar nueva consulta"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;CONSULTA</a>
 @endif