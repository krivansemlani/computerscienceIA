@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage MCQs') }}
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
        <div class="mb-3">
            <label for="chapterFilter">Filter by Chapter:</label>
            <select id="chapterFilter" class="form-select" onchange="applyFilter()">
                <option value="">All Chapters</option>
                @foreach($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->CName }}</option>
                @endforeach
            </select>
        </div>
        <br/>
        <a href="{{ route('mcquestions.create') }}" class="btn btn-primary mb-3">Create New Question</a>

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
                    <th scope="col">Question</th>
                    <th scope="col">Options</th>
                    <th scope="col">Answer</th>
                    <th style="padding-right: 20px;" scope="col">Subject</th>
                    <th scope="col">Chapter</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mcquestions as $mcquestion)
                    <tr class="mcquestions-row" data-subject-id="{{ $mcquestion->chapter->subject->id }}" data-chapter-id="{{ $mcquestion->chapter->id }}">
                        <th scope="row">{{ $mcquestion->id }}</th>
                        <td><img src="{{ asset('storage/' . $mcquestion->QImage) }}" alt="Question Image" width="100"></td>
                        <td>
                            <ul>
                                <li>{{ $mcquestion->Option1 }}</li>
                                <li>{{ $mcquestion->Option2 }}</li>
                                <li>{{ $mcquestion->Option3 }}</li>
                                <li>{{ $mcquestion->Option4 }}</li>
                            </ul>
                        </td>
                        <td style="padding-right: 20px;">{{ $mcquestion->Answer }}</td>
                       
                        <td style="padding-right: 20px;">{{ $mcquestion->chapter->subject->SName }}</td>
                        <td style="padding-right: 20px;">{{ $mcquestion->chapter->CName }}</td>
                        <td>
                            <a href="{{ route('mcquestions.show', $mcquestion->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('mcquestions.edit', $mcquestion->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ $mcquestion->id }}')">Delete</button>
                            <form id="deleteForm{{ $mcquestion->id }}" action="{{ route('mcquestions.destroy', $mcquestion->id) }}" method="POST" class="inline-block">
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
        function applyFilter() {
            const selectedSubjectId = document.getElementById('subjectFilter').value;
            const selectedChapterId = document.getElementById('chapterFilter').value;
            const mcquestionsRows = document.querySelectorAll('.mcquestions-row');

            mcquestionsRows.forEach(row => {
                const rowSubjectId = row.getAttribute('data-subject-id');
                const rowChapterId = row.getAttribute('data-chapter-id');
                
                const subjectFilterMatch = selectedSubjectId === '' || selectedSubjectId === rowSubjectId;
                const chapterFilterMatch = selectedChapterId === '' || selectedChapterId === rowChapterId;

                if (subjectFilterMatch && chapterFilterMatch) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        function confirmDelete(questionId) {
        if (confirm('Are you sure you want to delete this question?')) {
            document.getElementById('deleteForm' + questionId).submit();
        }
    }
    </script>
@endsection
