@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Revision Question Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID</h5>
                <p class="card-text">{{ $revisionQuestion->id }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Question Image</h5>
                @if (!empty($revisionQuestion->QImage))
                    <img src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image" class="max-w-sm">
                @else
                    <p class="card-text">N/A</p>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Answer Image</h5>
                @if (!empty($revisionQuestion->AImage))
                    <img src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image" class="max-w-sm">
                @else
                    <p class="card-text">N/A</p>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Chapter</h5>
                <p class="card-text">{{ $revisionQuestion->chapter->CName }}</p>
            </div>
        </div>

        <a href="{{ route('revision-questions.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>
@endsection
