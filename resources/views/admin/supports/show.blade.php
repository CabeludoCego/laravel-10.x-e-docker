@extends('admin.layouts.app')

@section('title', "Detalhes da duvida {$support->subject}")
		
@section('header')
	<h1 class="text-lg text-black-500">Detalhes da dúvida: {{ $support->id }}</h1>
@endsection

@section('content')
		
<ul>
	<li>Assunto: 		{{ $support->subject }}</li>
	<li>Status:  		{{ $support->status  }}</li>
	<li>Descrição:  {{ $support->body		 }}</li>
	<li class="my-3">Troubleshoot:  
		@if ($support->image)
				<img src="{{ url("storage/{$support->image}") }}" alt="imagem" srcset=""
					class="object-cover w-20">
		@endif
	</li>
</ul>

<form action="{{ route('supports.destroy', $support->id) }}" method="post">
	<x-delete-button/>	
</form>
@endsection
