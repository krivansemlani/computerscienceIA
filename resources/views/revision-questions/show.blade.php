@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Revision Question Details</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">ID</h3>
                <p class="card-text">{{ $revisionQuestion->id }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Question Image</h3>
                <div class="scrolling-container" style="max-height: 750px; overflow-y: auto;">
                    @if (!empty($revisionQuestion->QImage))
                        <img src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image" style="max-width: 80%;">
                    @else
                        <p class="card-text">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Answer Image</h3>
                <div class="scrolling-container" style="max-height: 750px; overflow-y: auto;">
                    @if (!empty($revisionQuestion->AImage))
                        <img src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image" style="max-width: 80%;">
                    @else
                        <p class="card-text">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Subject</h3>
                <p class="card-text">{{ $revisionQuestion->chapter->subject->SName }}</p>
            </div>
        </div>


        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Chapter</h3>
                <p class="card-text">{{ $revisionQuestion->chapter->CName }}</p>
            </div>
        </div>

        <a href="{{ route('revision-questions.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>
@endsection
