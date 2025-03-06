@extends('layouts.subject-layout')
@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 "":text-gray-200 leading-tight">
            {{ __('Edit Revision Question') }}

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

        <form action="{{ route('revision-questions.update', $revisionQuestion->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="QImage">Question Image</label>
            <div class="form-group" class="scrolling-container"
                style="max-height: 750px; overflow-y: auto; border: 3px solid #000;">
                <input type="file" class="form-control" id="QImage" name="QImage" accept="image/*"
                    onchange="previewImage('QImage', 'image-preview')" style="padding: 10px 0;">
                <img id="image-preview" src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image"
                    style="max-width: 100%; height: auto;">
            </div>

            <label for="AImage">Answer Image</label>

            <div class="form-group" class="scrolling-container"
                style="max-height: 750px; overflow-y: auto; border: 3px solid #000;">
                <input type="file" class="form-control" id="AImage" name="AImage" accept="image/*"
                    onchange="previewImage('AImage', 'aImagePreview')" style="padding: 10px 0;">
                <img id="aImagePreview" src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image"
                    style="max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select class="form-control" id="subject_id" name="subject_id" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            {{ $subject->id == $revisionQuestion->chapter->subject->id ? 'selected' : '' }}>
                            {{ $subject->SName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="chapter_id">Chapter</label>
                <select class="form-control" id="chapter_id" name="chapter_id" required>
                    @foreach ($chapters as $chapter)
                        <option value="{{ $chapter->id }}"
                            {{ $chapter->id == $revisionQuestion->chapter->id ? 'selected' : '' }}>
                            {{ $chapter->CName }}
                        </option>
                    @endforeach
                </select>
            </div>


            <button class="btn btn-primary">Update Revision Question</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function previewImage(inputId, previewId) {
            var input = document.getElementById(inputId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        window.addEventListener('load', function() {
            previewImage('QImage', 'image-preview');
            previewImage('AImage', 'aImagePreview');
        });


        $('#subject_id').change(function() {
            var subjectId = $(this).val();
            updateChapters(subjectId);
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

                        var selected = key == {{ $revisionQuestion->chapter->id }} ? 'selected' : '';
                        $('#chapter_id').append($('<option>', {
                            value: key,
                            text: value,
                            selected: selected
                        }));
                    });
                }
            });
        }


        var initialSubjectId = $('#subject_id').val();
        updateChapters(initialSubjectId);
    </script>
@endsection
