@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">MCQuestion Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Question</h5>
                <div class="scrolling-container" style="max-height: 500px; overflow-y: auto;">
                    <img src="{{ asset('storage/' . $mcquestion->QImage) }}" alt="Question Image" width="750">
                </div>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">Option 1: {{ $mcquestion->Option1 }}</li>
                <li class="list-group-item">Option 2: {{ $mcquestion->Option2 }}</li>
                <li class="list-group-item">Option 3: {{ $mcquestion->Option3 }}</li>
                <li class="list-group-item">Option 4: {{ $mcquestion->Option4 }}</li>
                <li class="list-group-item">Answer: {{ $mcquestion->Answer }}</li>
            </ul>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Subject</h3>
                <p class="card-text">{{ $mcquestion->chapter->subject->SName }}</p>
            </div>
        </div>


        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Chapter</h3>
                <p class="card-text">{{ $mcquestion->chapter->CName }}</p>
            </div>
        </div>

        

        <a href="{{ route('mcquestions.index') }}" class="btn btn-primary mt-3">Back to MCQuestion List</a>
    </div>
@endsection
