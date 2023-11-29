@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">MCQuestion List</h1>
        <a href="{{ route('mcquestions.create') }}" class="btn btn-primary mb-3">Create New Question</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Question</th>
                    <th scope="col">Options</th>
                    <th scope="col">Answer</th>
                    <th style="padding-right: 20px;" scope="col">Subject</th>
                    <th scope="col">Chapter</th>

                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($mcquestions as $mcquestion)
                    <tr>
                        <th scope="row">{{ $mcquestion->id }}</th>
                        <td><img src="{{ asset('storage/' . $mcquestion->QImage) }}" alt="Question Image" width="100"></td>
                        <td>
                            <ul>
                                <li>{{ $mcquestion->Option1 }}</li>
                                <li>{{ $mcquestion->Option2 }}</li>
                                <li>{{ $mcquestion->Option3 }}</li>
                                <li>{{ $mcquestion->Option4 }}</li>
                            </ul>
                        </td>
                        <td style="padding-right: 20px;">{{ $mcquestion->Answer }}</td>
                       
                        <td style="padding-right: 20px;">{{ $mcquestion->chapter->subject->SName }}</td>
                        <td style="padding-right: 20px;">{{ $mcquestion->chapter->CName }}</td>
                        <td>
                           
                            <a href="{{ route('mcquestions.show', $mcquestion->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('mcquestions.edit', $mcquestion->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('mcquestions.destroy', $mcquestion->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this MCQuestion?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
