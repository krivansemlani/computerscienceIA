@extends('layouts.subject-layout')

@section('content')
<div class='container'>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Create new subject') }}
    </h2>
    <br/>

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
            <textarea class="form-control" id="SDescription" name="SDescription" rows="3" ></textarea>
        </div>
        <button  class="btn btn-primary">Create Subject</button>
    </form>

</div>
@endsection
