@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Manage Chapters</h1>
        <a href="{{ route('chapters.create') }}" class="btn btn-primary mb-3">Create New Chapter</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Chapter Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chapters as $chapter)
                    <tr>
                        <th scope="row">{{ $chapter->id }}</th>
                        <td>{{ $chapter->CName }}</td>
                        <td>{{ $chapter->CDescription }}</td>
                        <td>
                            <a href="{{ route('chapters.show', $chapter->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('chapters.edit', $chapter->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('chapters.destroy', $chapter->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this chapter?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
