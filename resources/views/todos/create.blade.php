@extends('layouts.app')

@section('title', 'New Todo')

@section('content')
    <h1 class="text-2xl font-bold mb-6">New Todo</h1>

    <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-6">
        @csrf
        @include('todos._form', ['buttonText' => 'Save Todo'])
    </form>
@endsection
