<x-dashboard-layout>
    @section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Filter Questions
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('usermodule.revisionquestions') }}">
                            <div class="form-group">
                                <label for="subject">Select Subject</label>
                                <select class="form-control" id="subject" name="subject_id" style="width: 100%;">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $subject->id == $selectedSubject ? 'selected' : '' }}>
                                            {{ $subject->SName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="chapter">Select Chapter</label>
                                <select class="form-control" id="chapter" name="chapter_id" style="width: 100%;">
                                    @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter->id }}"
                                            {{ $chapter->id == $selectedChapter ? 'selected' : '' }}>
                                            {{ $chapter->CName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Image and Additional Panel
                    </div>
                    <div class="container mt-4">
                        <div class="question-box">
                            @foreach ($revisionQuestions as $question)
                                <div class="question-container">
                                    <div class="image-and-additional-container" style="display: flex;">
                                        <div class="image-container" style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; max-height: 500px; overflow-y: auto; flex: 1;">
                                            @if ($question->QImage)
                                                <div class="image-box" style="max-width: 100%; margin: 0; flex-shrink: 0;">
                                                    <img src="{{ asset('storage/' . $question->QImage) }}" alt="Question Image" class="question-image question-{{ $question->id }}" style="max-width: 100%;">
                                                </div>
                                            @else
                                                <p>No question image available</p>
                                            @endif
                                    
                                            @if ($question->AImage)
                                                <div class="image-box" style="max-width: 100%; margin: 0; flex-shrink: 0;">
                                                    <img src="{{ asset('storage/' . $question->AImage) }}" alt="Answer Image" class="answer-image answer-{{ $question->id }}" style="display: none; max-width: 100%;">
                                                </div>
                                            @else
                                                <p>No answer image available</p>
                                            @endif
                                        </div>
                                    
                                        <!-- Additional Container on the right -->
<div class="additional-container" style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; max-height: 500px; overflow-y: auto; flex: 1;">
    <div class="form-check">
        <input type="checkbox" class="form-check-input toggle" id="toggle-{{ $question->id }}">
        <label class="form-check-label" for="toggle-{{ $question->id }}">Toggle Question/Answer</label>
    </div>
    <div id="sketchpad-container"></div>
</div>
<script type="text/javascript" src="bower_components/sketchpad/scripts/sketchpad.js"></script>


                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to update chapters based on the selected subject
    function updateChapters(subjectId) {
        $.ajax({
            url: '/get-chapters/' + subjectId,
            method: 'GET',
            success: function(data) {
                // Update the chapters dropdown with the fetched chapters
                $('#chapter').empty();
                $('#chapter').append($('<option>', {
                    value: '',
                    text: 'Select a Chapter'
                }));
                $.each(data, function(key, value) {
                    $('#chapter').append($('<option>', {
                        value: key,
                        text: value
                    }));
                });
            }
        });
    }

    // Initialize chapters based on the selected subject
    var initialSubjectId = $('#subject').val();
    updateChapters(initialSubjectId);

    // When the subject dropdown changes, update the chapters
    $('#subject').change(function() {
        var subjectId = $(this).val();
        updateChapters(subjectId);
    });

    // Toggle question/answer images when the checkbox changes
    $('.toggle').change(function() {
        var questionId = $(this).attr('id').split('-')[1];
        if ($(this).is(':checked')) {
            // Show answer image and hide question image when checkbox is checked
            $('.question-' + questionId).hide();
            $('.answer-' + questionId).show();
        } else {
            // Show question image and hide answer image when checkbox is unchecked
            $('.question-' + questionId).show();
            $('.answer-' + questionId).hide();
        }
    });
</script>
<script>
    // Initialize Sketchpad
    @foreach ($revisionQuestions as $question)
                    var sketchpad_{{ $question->id }} = new Sketchpad({
                        element: 'sketchpad-container-{{ $question->id }}',
                        width: 400,
                        height: 300,
                    });
                @endforeach
</script>
