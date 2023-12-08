@extends('layouts.subject-layout')
@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Revision Question Details') }}
        </h2>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold;">Question Image</h3>
                <div class="scrolling-container" style="max-height: 500px; overflow-y: auto; border: 3px solid #000;">
                    @if (!empty($revisionQuestion->QImage))
                        <img src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image"
                            style="max-width: 80%;">
                    @else
                        <p class="card-text">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold;">Answer Image</h3>
                <div class="scrolling-container" style="max-height: 500px; overflow-y: auto; border: 3px solid #000;">
                    @if (!empty($revisionQuestion->AImage))
                        <img src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image"
                            style="max-width: 80%;">
                    @else
                        <p class="card-text">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold;">Subject</h3>
                <p class="card-text">{{ $revisionQuestion->chapter->subject->SName }}</p>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold;">Chapter</h3>
                <p class="card-text">{{ $revisionQuestion->chapter->CName }}</p>
            </div>
        </div>
        <a href="{{ route('revision-questions.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>
@endsection
