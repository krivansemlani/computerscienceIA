@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Chapters') }}
        </h2>
        <br/>
        <div class="mb-3">
            <label for="subjectFilter">Filter by Subject:</label>
            <select id="subjectFilter" class="form-select" onchange="applyFilter()">
                <option value="">All Subjects</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                @endforeach
            </select>
        </div>
        <br/>
        <a href="{{ route('chapters.create') }}" class="btn btn-primary mb-3">Create New Chapter</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        <br/>
        <br/>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Chapter Name</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chapters as $chapter)
                    <tr class="chapter-row" data-subject-id="{{ $chapter->subject->id }}">
                        <th scope="row">{{ $chapter->id }}</th>
                        <td>{{ $chapter->CName }}</td>
                        <td>{{ $chapter->subject->SName }}</td>
                        <td>{{ $chapter->CDescription }}</td>
                        <td>
                            <a href="{{ route('chapters.show', $chapter->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('chapters.edit', $chapter->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ $chapter->id }}')">Delete</button>
                            <form id="deleteForm-{{ $chapter->id }}" action="{{ route('chapters.destroy', $chapter->id) }}" method="POST" style="display: none;">
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
        function confirmDelete(chapterId) {
            if (confirm('Are you sure you want to delete this chapter?')) {
                document.getElementById('deleteForm-' + chapterId).submit();
            }
        }

        function applyFilter() {
            const selectedSubjectId = document.getElementById('subjectFilter').value;
            const chapterRows = document.querySelectorAll('.chapter-row');

            chapterRows.forEach(row => {
                const rowSubjectId = row.getAttribute('data-subject-id');
                if (selectedSubjectId === '' || selectedSubjectId === rowSubjectId) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection
