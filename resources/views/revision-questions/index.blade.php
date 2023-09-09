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

        <table class="table">
            <thead>
                <tr>
                    <th class="text-left">ID</th>
                    <th class="text-left">Question Image</th>
                    <th class="text-left">Answer Image</th>
                    <th class="text-left">Chapter</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($revisionQuestions as $revisionQuestion)
                    <tr>
                        <td class="text-left">{{ $revisionQuestion->id }}</td>
                        <td class="text-left">
                            @if (!empty($revisionQuestion->QImage))
                                <img src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image" width="100">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-left">
                            @if (!empty($revisionQuestion->AImage))
                                <img src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image" width="100">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-left">{{ $revisionQuestion->chapter->CName }}</td>
                        <td class="text-left">
                            <a href="{{ route('revision-questions.edit', $revisionQuestion->id) }}" class="btn btn-primary mb-3">Edit</a>
                            <a href="{{ route('revision-questions.show', $revisionQuestion->id) }}" class="btn btn-primary mb-3">View</a>
                            <form action="{{ route('revision-questions.destroy', $revisionQuestion->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary mb-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
