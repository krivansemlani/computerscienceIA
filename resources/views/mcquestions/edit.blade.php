@extends('layouts.subject-layout')


@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit MCQ Details') }}
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

        <form action="{{ route('mcquestions.update', $mcquestion->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="QImage">Question Image</label>

            <div class="form-group" class="scrolling-container" style="max-height: 500px; overflow-y: auto; border: 3px solid #000;">
                
                <input type="file" class="form-control" id="QImage" name="QImage" accept="image/*" onchange="previewImage()" style="padding: 10px 0;">
                <img id="image-preview" src="{{ asset('storage/' . $mcquestion->QImage) }}" alt="Question Image" style="max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="Option1">Option 1</label>
                <input type="text" class="form-control" id="Option1" name="Option1" value="{{ $mcquestion->Option1 }}" required>
            </div>

            <div class="form-group">
                <label for="Option2">Option 2</label>
                <input type="text" class="form-control" id="Option2" name="Option2" value="{{ $mcquestion->Option2 }}" required>
            </div>

            <div class="form-group">
                <label for="Option3">Option 3</label>
                <input type="text" class="form-control" id="Option3" name="Option3" value="{{ $mcquestion->Option3 }}" required>
            </div>

            <div class="form-group">
                <label for="Option4">Option 4</label>
                <input type="text" class="form-control" id="Option4" name="Option4" value="{{ $mcquestion->Option4 }}" required>
            </div>

            <div class="form-group">
                <label for="Answer">Answer</label>
                <select class="form-control" id="Answer" name="Answer" required>
                    <option value="Option1" {{ $mcquestion->Answer === 'Option1' ? 'selected' : '' }}>Option 1</option>
                    <option value="Option2" {{ $mcquestion->Answer === 'Option2' ? 'selected' : '' }}>Option 2</option>
                    <option value="Option3" {{ $mcquestion->Answer === 'Option3' ? 'selected' : '' }}>Option 3</option>
                    <option value="Option4" {{ $mcquestion->Answer === 'Option4' ? 'selected' : '' }}>Option 4</option>
                </select>
            </div>


            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select class="form-control" id="subject_id" name="subject_id" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject->id == $mcquestion->chapter->subject->id ? 'selected' : '' }}>
                            {{ $subject->SName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="chapter_id">Chapter</label>
                <select class="form-control" id="chapter_id" name="chapter_id" required>
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}" {{ $chapter->id == $mcquestion->chapter->id ? 'selected' : '' }}>
                            {{ $chapter->CName }}
                        </option>
                    @endforeach
                </select>
            </div>

        

            <button type="submit" class="btn btn-primary">Update MCQuestion</button>
        </form>
    </div>

    <script>
        // Function to preview the selected image
        function previewImage() {
            var input = document.getElementById('QImage');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Call the previewImage() function when the page is fully loaded
        window.addEventListener('load', function () {
            previewImage();
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
                // Check if the chapter ID matches the revision question's chapter ID
                var selected = key == {{ $mcquestion->chapter->id }} ? 'selected' : '';
                $('#chapter_id').append($('<option>', {
                    value: key,
                    text: value,
                    selected: selected
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
