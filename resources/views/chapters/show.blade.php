@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Chapter Details</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Chapter Name</th>
                    <td>{{ $chapter->CName }}</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td>{{ $chapter->CDescription }}</td>
                </tr>
                <tr>
                    <th scope="row">Subject</th>
                    <td>{{ $chapter->subject->SName }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('chapters.index') }}" class="btn btn-primary">Back to Chapters</a>
    </div>
@endsection
