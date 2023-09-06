@extends('layouts.subject-layout')

@section('content')
<div class="container">
    <h1 class="mt-5">Manage Subjects</h1>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Create New Subject</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
            <tr>
                <th scope="row">{{ $subject->id }}</th>
                <td>{{ $subject->SName }}</td>
                <td>{{ $subject->SDescription }}</td>
                <td>
                    <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
