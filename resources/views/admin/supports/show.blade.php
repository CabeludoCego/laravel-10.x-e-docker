@extends('admin.layouts.app')

@section('title', "Detalhes da duvida {$support->subject}")
		
@section('header')
	<h1 class="text-lg text-black-500">Detalhes da dúvida: {{ $support->id }}</h1>
@endsection

@section('cotnent')
		
<ul>
	<li>Assunto: 		{{ $support->subject }}</li>
	<li>Status:  		{{ $support->status  }}</li>
	<li>Descrição:  {{ $support->body		 }}</li>
	
</ul>

<form action="{{ route('supports.destroy', $support->id) }}" method="post">
	<x-delete-button/>	
</form>
@endsection
