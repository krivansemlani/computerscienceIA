@extends('layouts.subject-layout')

@section('content')
    <div class="container">
        <h1 class="mt-5">Edit Revision Question</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('revision-questions.update', $revisionQuestion->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="QImage">Question Image</label>
                <input type="file" class="form-control" id="QImage" name="QImage" accept="image/*" onchange="previewImage('QImage', 'image-preview')" style="padding: 10px 0;">
                <img id="image-preview" src="{{ asset('storage/' . $revisionQuestion->QImage) }}" alt="Question Image" style="max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="AImage">Answer Image</label>
                <input type="file" class="form-control" id="AImage" name="AImage" accept="image/*" onchange="previewImage('AImage', 'aImagePreview')" style="padding: 10px 0;">
                <img id="aImagePreview" src="{{ asset('storage/' . $revisionQuestion->AImage) }}" alt="Answer Image" style="max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="chapter_id">Select Chapter</label>
                <select class="form-control" id="chapter_id" name="chapter_id" required>
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}" {{ $revisionQuestion->chapter_id === $chapter->id ? 'selected' : '' }}>{{ $chapter->CName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Add any additional form fields here -->

            <button type="submit" class="btn btn-primary">Update Revision Question</button>
        </form>
    </div>

    <script>
        // Function to preview the selected image
        function previewImage(inputId, previewId) {
            var input = document.getElementById(inputId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Call the previewImage() function when the page is fully loaded
        window.addEventListener('load', function () {
            previewImage('QImage', 'image-preview');
            previewImage('AImage', 'aImagePreview');
        });
    </script>
@endsection
