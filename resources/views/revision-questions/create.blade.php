@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Create New Revision Question</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('revision-questions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="QImage">Question Image</label>
                <input type="file" class="form-control" id="QImage" name="QImage" accept="image/*" required>
                <img id="image-preview" src="#" alt="Question Image" style="display: none; max-width: 100%; height: auto;">
            </div>
            <div class="form-group">
                <label for="AImage">Answer Image</label>
                <input type="file" class="form-control" id="AImage" name="AImage" accept="image/*" required>
                <img id="aImagePreview" src="#" alt="Answer Image" style="display: none; max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select class="form-control" id="subject_id" name="subject_id" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="chapter_id">Chapter</label>
                <select class="form-control" id="chapter_id" name="chapter_id" required>
                
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Revision Question</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <script>
        // Image preview function
        function readURL(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + previewId).attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#QImage').change(function () {
            readURL(this, 'image-preview');
        });

        $('#AImage').change(function () {
            readURL(this, 'aImagePreview');
        });

        // Update chapters based on selected subject
        $('#subject_id').change(function () {
            var subjectId = $(this).val();
            updateChapters(subjectId);
        });

        // Function to update chapters based on the selected subject using AJAX
        function updateChapters(subjectId) {
            $.ajax({
                url: '/get-chapters/' + subjectId,
                method: 'GET',
                success: function(data) {
                    // Update the chapters dropdown with the fetched chapters
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

        // Initialize chapters based on the selected subject
        var initialSubjectId = $('#subject_id').val();
        updateChapters(initialSubjectId);
    </script>
@endsection
