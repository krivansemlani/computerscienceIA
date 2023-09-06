@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Create New Chapter</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chapters.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="CName">Chapter Name</label>
                <input type="text" class="form-control" id="CName" name="CName" required>
            </div>
            <div class="form-group">
                <label for="CDescription">Description</label>
                <textarea class="form-control" id="CDescription" name="CDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select class="form-control" id="subject_id" name="subject_id" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Chapter</button>
        </form>
        
    </div>
@endsection
