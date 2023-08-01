@extends('admin.layouts.app')

@section('title', "Editar a Dúvida {$support->subject}")

@section('header')
<h1 class="text-lg text-black-500"> {{ $support->id }}</h1>
@endsection

@section('content')
<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @method('PUT')
    @include('admin.supports.partials.form', [
        'support' => $support
    ])
</form>
@endsection

<button type="submit" action="{{ route('supports.index') }}" class="bg-blue-500 hover:bg-blue-300 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
    Deletar
</button>