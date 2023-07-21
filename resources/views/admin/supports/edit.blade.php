<h1>Editar detalhes da dúvida {{ $support->id }}</h1>


@if ($errors->any())
	@foreach ($errors->all() as $error)
			{{ $error }}
	@endforeach
@endif


<form action="{{ route('supports.update', $support->id) }}" method="post" >
	@csrf
	@method('PUT')

	<input type="text" name="subject" value="{{ $support->subject }}">
	<textarea name="body" cols="30" rows="5">{{ $support->body }}</textarea>
	<button type="submit">Enviar</button>

</form>