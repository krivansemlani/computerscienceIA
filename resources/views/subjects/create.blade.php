@extends('layouts.subject-layout')

@section('content')
    <h1 class="mt-5">Create New Subject</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="SName">Subject Name</label>
            <input type="text" class="form-control" id="SName" name="SName" required>
        </div>
        <div class="form-group">
            <label for="SDescription">Description</label>
            <textarea class="form-control" id="SDescription" name="SDescription" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Subject</button>
    </form>
@endsection
