@extends('layouts.app')

@section('title', 'Edit Todo')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Todo</h1>

    <form action="{{ route('todos.update', $todo) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-6">
        @csrf
        @method('PUT')
        @include('todos._form', ['buttonText' => 'Update Todo'])
    </form>
@endsection
