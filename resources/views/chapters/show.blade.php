@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chapter Details') }}


        </h2>
        <br />
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
        <br />

        <a href="{{ route('chapters.index') }}" class="btn btn-primary">Back to Chapters</a>
    </div>
@endsection
