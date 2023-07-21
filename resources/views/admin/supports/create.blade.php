<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	
	<div width="70vw" >
		<div width="65vw" border-radius="4" style="background: rgb(229, 229, 229); ">

			<h1>Nova dúvida</h1>

			@if ($errors->any())
					@foreach ($errors->all() as $error)
							{{ $error }}
					@endforeach
			@endif

			<form action="{{ route('supports.store') }}" method="post" style="
				width: 90vw;display: flex; flex-direction: column;align-items: center;">
				@csrf

				<input type="text" name="subject" placeholder="Assunto" value={{ old('subject') }}>
				<textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ old('body') }}</textarea>
				<button type="submit">Enviar</button>

			</form>
		</div>
	</div>

</body>
</html>