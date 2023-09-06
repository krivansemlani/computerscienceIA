@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Edit Subject</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="SName">Subject Name</label>
                <input type="text" class="form-control" id="SName" name="SName" value="{{ $subject->SName }}" required>
            </div>
            <div class="form-group">
                <label for="SDescription">Description</label>
                <textarea class="form-control" id="SDescription" name="SDescription" rows="3" required>{{ $subject->SDescription }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Subject</button>
        </form>
    </div>
@endsection
