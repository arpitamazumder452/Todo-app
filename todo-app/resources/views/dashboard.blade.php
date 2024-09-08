<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Todos</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="New Todo" required>
        <button type="submit">Add Todo</button>
    </form>

    @if (session('todos'))
        <ul>
            @foreach (session('todos') as $index => $todo)
                <li>
                    <form action="{{ route('todos.update', $index) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $todo['title'] }}" required>
                        <input type="checkbox" name="completed" {{ $todo['completed'] ? 'checked' : '' }}>
                        <button type="submit">Update</button>
                    </form>

                    <form action="{{ route('todos.destroy', $index) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No todos yet!</p>
    @endif
</div>
@endsection
