@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Revision Question List</h1>
        <a href="{{ route('revision-questions.create') }}" class="btn btn-primary mb-3">Create New Revision Question</a>

        <!-- Display success message if any -->
        @if (session('success'))
            <div class="mt-4">
                <div class="font-medium text-green-600">{{ session('success') }}</div>
            </div>
        @endif
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>

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
                    <tr>
                        <td style="padding-right: 20px;">{{ $revisionQuestion->id }}</td>
                        <td style="padding-right: 20px;">
                            @if (!empty($revisionQuestion->QImage))
                                <img src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image" width="100">
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="padding-right: 20px;">
                            @if (!empty($revisionQuestion->AImage))
                                <img src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image" width="100">
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="padding-right: 20px;">{{ $revisionQuestion->chapter->CName }}</td>
                        <td style="padding-right: 20px;">{{ $revisionQuestion->chapter->subject->SName }}</td>
                        <td>
                            <a href="{{ route('revision-questions.edit', $revisionQuestion->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('revision-questions.show', $revisionQuestion->id) }}" class="btn btn-primary">View</a>
                            <form action="{{ route('revision-questions.destroy', $revisionQuestion->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
