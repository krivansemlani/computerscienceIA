@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Subject Details</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Subject Name</th>
                    <td>{{ $subject->SName }}</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td>{{ $subject->SDescription }}</td>
                </tr>
            </tbody>
        </table>
        <br/>

        <a href="{{ route('subjects.index') }}" class="btn btn-primary">Back to Subjects</a>
    </div>
@endsection
