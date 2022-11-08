<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>

    {{-- Bootstrap  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript">
        var baseURL= {!! json_encode(url('/')) !!}
    </script>


  <script>
    function endEdit(){
        let start = document.getElementById("start");
        let end = document.getElementById("end");
        console.log('horas iniciales '+start.value);
        var minutos = 90;

        let tiempo;
        tiempo = new Date("2020-01-01T" + start.value + ":00+0600");

        tiempo.setHours(tiempo.getHours()+12);

         /* Si es una fecha inválida restauramos a 00:00 */
        if (isNaN(tiempo)) {
            tiempo = new Date("2020-01-01T00:00:00Z");
        }
        /* Operamos con los minutos */
        tiempo.setMinutes(tiempo.getMinutes() + minutos);
        /* Nos quedamos solo con hora y minuto */
        
        console.log('tiempo mas minutos add '+tiempo);;
        final = tiempo.getHours() +':'+tiempo.getMinutes();
        console.log('tiempo final '+final);
        end.value = final;
    }

</script>

  <script src="{{ asset('js/calendar.js')}}"></script>
</head>
<body>
    				
<button id="mydraggable"  data-event='{ "title": "my event", "duration": "02:00" }'>Draggable</button>

<div class="container">
	<div id="calendar"></div>
</div>

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#event">
	Launch
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="event" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		 <form action="" id="form">
			<input type="hidden" name="_token" id="token_event" value="{{ csrf_token() }}" />

			 <div class="form-group d-none">
				<label for="id">ID</label>
				<input class="form-control" type="text" id="id" name="id" >
			 </div>

			 <div class="form-group">
				<label for="title">Titulo</label>
				<input class="form-control" type="text" id="title" name="title" value="titulo de prueba">
			 </div>
			 {{-- <label for="service_id">Servicio</label>
			 <select name="service_id" class="form-control" id="">
				@foreach ($services as $service)
					<option value="{{ $service->id }}">{{ $service->name }}</option>
				@endforeach
			 </select>
			 <label for="client_id">Cliente</label>
			 <select name="client_id" class="form-control" id="">
				@foreach ($clients as $client)
					<option value="{{ $client->id }}">{{ $client->names }}</option>
				@endforeach
			 </select> --}}

			 <div class="form-group">
				<label for="description">Descripcion del evento</label>
				<textarea class="form-control" type="text" id="description" name="description" placeholder="escribe la descripcion" cols="30" rows="3"></textarea>
			 </div>

			 {{-- <div class="form-group">
				<label for="start">Start</label>
				<input class="form-control" type="text" id="start" name="start">
			 </div>

			 <div class="form-group">
				<label for="end">End</label>
				<input class="form-control" type="text" id="end" name="end" >
			 </div> --}}

			 <div class="form-group">
				<label for="start">Start</label>
				<input class="form-control" type="datetime-local" id="start" name="start">
			 </div>
			 <div class="form-group">
				<label for="end">End</label>
				<input class="form-control" type="datetime-local" id="end" name="end">
			 </div>
			 {{-- <div class="form-group">
				<label for="hour_start">Inicio</label>
				<input class="form-control" type="time" id="hour_start" name="hour_start" onchange="endEdit()">
			 </div> --}}

			 {{-- <div class="form-group">
				<label for="hour_end">Fin</label>
				<input class="form-control" type="time" id="hour_end" name="hour_end"  readonly>
			 </div> --}}
			
		 </form>
		</div>
		<div class="modal-footer">
			<button type="button" id="btnSave" class="btn btn-success">Guardar</button>
			<button type="button" id="btnUpdate" class="btn btn-warnign">Modificar</button>
			<button type="button" id="btnDelete" class="btn btn-danger">Eliminar</button>
		  	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
		</div>
	  </div>
	</div>
  </div>



</body>
</html>

@section('scripts')

	
@endsection