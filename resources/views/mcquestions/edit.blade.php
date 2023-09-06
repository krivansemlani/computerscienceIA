@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Edit MCQuestion</h1>

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

            <div class="form-group">
                <label for="QImage">Question Image</label>
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
                <label for="chapter_id">Chapter</label>
                <select class="form-control" id="chapter_id" name="chapter_id" required>
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}" {{ $mcquestion->chapter_id === $chapter->id ? 'selected' : '' }}>{{ $chapter->CName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Add any additional form fields here -->

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
    </script>
@endsection