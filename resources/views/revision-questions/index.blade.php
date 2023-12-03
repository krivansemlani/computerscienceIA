@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Revision Questions') }}
        </h2>
        <br />
        <div class="mb-3">
            <label for="subjectFilter">Filter by Subject:</label>
            <select id="subjectFilter" class="form-select" onchange="applyFilter()">
                <option value="">All Subjects</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                @endforeach
            </select>
        </div>
        <br />
        <div class="mb-3">
            <label for="chapterFilter">Filter by Chapter:</label>
            <select id="chapterFilter" class="form-select" onchange="applyFilter()">
                <option value="">All Chapters</option>
                @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->CName }}</option>
                @endforeach
            </select>
        </div>
        <br />
        <a href="{{ route('revision-questions.create') }}" class="btn btn-primary mb-3">Create New Revision Question</a>

        @if (session('success'))
            <div class="mt-4">
                <div class="font-medium text-green-600">{{ session('success') }}</div>
            </div>
        @endif
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        <br />
        <br />


        <table class="table">
            <thead>
                <tr>
                    <th style="padding-right: 20px;">ID</th>
                    <th style="padding-right: 20px;">Question Image</th>
                    <th style="padding-right: 20px;">Answer Image</th>
                    <th style="padding-right: 20px;">Chapter</th>
                    <th style="padding-right: 20px;">Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($revisionQuestions as $revisionQuestion)
                    <tr class="revision-question-row" data-subject-id="{{ $revisionQuestion->chapter->subject->id }}"
                        data-chapter-id="{{ $revisionQuestion->chapter->id }}">
                        <td style="padding-right: 20px;">{{ $revisionQuestion->id }}</td>
                        <td style="padding-right: 20px;">
                            @if (!empty($revisionQuestion->QImage))
                                <img src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image"
                                    width="100">
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="padding-right: 20px;">
                            @if (!empty($revisionQuestion->AImage))
                                <img src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image"
                                    width="100">
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="padding-right: 20px;">{{ $revisionQuestion->chapter->CName }}</td>
                        <td style="padding-right: 20px;">{{ $revisionQuestion->chapter->subject->SName }}</td>
                        <td>
                            <a href="{{ route('revision-questions.show', $revisionQuestion->id) }}"
                                class="btn btn-primary">View</a>
                            <a href="{{ route('revision-questions.edit', $revisionQuestion->id) }}"
                                class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger"
                                onclick="confirmDelete('{{ $revisionQuestion->id }}')">Delete</button>
                            <form id="deleteForm{{ $revisionQuestion->id }}"
                                action="{{ route('revision-questions.destroy', $revisionQuestion->id) }}" method="POST"
                                class="inline-block">
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
            const revisionQuestionRows = document.querySelectorAll('.revision-question-row');

            revisionQuestionRows.forEach(row => {
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
