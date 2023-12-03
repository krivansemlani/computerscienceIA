@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('MCQ Details') }}

            
        </h2>
        <br/>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold;">Question Image</h3>
               
                <div class="scrolling-container" style="max-height: 500px; overflow-y: auto;  border: 3px solid #000;">
                    <img src="{{ asset('storage/' . $mcquestion->QImage) }}" alt="Question Image" width="750">
                </div>
            </div>

            <br/>

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
                <h3 class="card-title" style="font-weight: bold;">Subject</h3>
                <p class="card-text">{{ $mcquestion->chapter->subject->SName }}</p>
            </div>
        </div>


        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold;">Chapter</h3>
                <p class="card-text">{{ $mcquestion->chapter->CName }}</p>
            </div>
        </div>

        

        <a href="{{ route('mcquestions.index') }}" class="btn btn-primary mt-3">Back to MCQuestion List</a>
    </div>
@endsection
