@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 "":text-gray-200 leading-tight">
            {{ __('Create MCQ') }}
        </h2>
        <br />

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mcquestions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="QImage">Question Image</label>
            <div class="form-group" class="scrolling-container"
                style="max-height: 750px; overflow-y: auto; border: 3px solid #000;">
                <input type="file" class="form-control" id="QImage" name="QImage" accept="image/*" required>
                <img id="image-preview" src="#" alt="Question Image"
                    style="display: none; max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="Option1">Option 1</label>
                <input type="text" class="form-control" id="Option1" name="Option1" required>
            </div>

            <div class="form-group">
                <label for="Option2">Option 2</label>
                <input type="text" class="form-control" id="Option2" name="Option2" required>
            </div>

            <div class="form-group">
                <label for="Option3">Option 3</label>
                <input type="text" class="form-control" id="Option3" name="Option3" required>
            </div>

            <div class="form-group">
                <label for="Option4">Option 4</label>
                <input type="text" class="form-control" id="Option4" name="Option4" required>
            </div>

            <div class="form-group">
                <label for="Answer">Answer</label>
                <select class="form-control" id="Answer" name="Answer" required>
                    <option value="Option1">Option 1</option>
                    <option value="Option2">Option 2</option>
                    <option value="Option3">Option 3</option>
                    <option value="Option4">Option 4</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <select class="form-control" id="subject" name="subject" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="chapter_id">Chapter</label>
                <select class="form-control" id="chapter_id" name="chapter_id" required>

                </select>
            </div>

            <button class="btn btn-primary">Create MCQuestion</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#QImage').change(function() {
            readURL(this);
        });


        function updateChapters(subjectId) {
            $.ajax({
                url: '/get-chapters/' + subjectId,
                method: 'GET',
                success: function(data) {

                    $('#chapter_id').empty();
                    $('#chapter_id').append($('<option>', {
                        value: '',
                        text: 'Select a Chapter'
                    }));
                    $.each(data, function(key, value) {
                        $('#chapter_id').append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                }
            });
        }


        var initialSubjectId = $('#subject').val();
        updateChapters(initialSubjectId);


        $('#subject').change(function() {
            var subjectId = $(this).val();
            updateChapters(subjectId);
        });
    </script>
@endsection
