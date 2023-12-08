@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Subjects') }}
        </h2>
        <br />
        <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Create New Subject</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        <br />
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <th scope="row">{{ $subject->id }}</th>
                        <td>{{ $subject->SName }}</td>
                        <td>{{ $subject->SDescription }}</td>
                        <td>
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ $subject->id }}')">Delete</button>
                            <form id="deleteForm-{{ $subject->id }}"
                                action="{{ route('subjects.destroy', $subject->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete(subjectId) {
            if (confirm('Are you sure you want to delete this subject and all its corresponding chapters and questions?')) {

                document.getElementById('deleteForm-' + subjectId).submit();
            }
        }
    </script>
@endsection
