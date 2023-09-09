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
                        Question Panel
                    </div>
                    <div class="card-body">
                        <div class="question-box">
                            @foreach ($revisionQuestions as $question)
                                <strong>Question ID:</strong> <span id="question-id">{{ $question->id }}</span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input toggle" id="toggle-{{ $question->id }}">
                                    <label class="form-check-label" for="toggle-{{ $question->id }}">Toggle Question/Answer</label>
                                </div>
                                <div class="image-box" style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; background-color: #e6f7ff; text-align: center;">
                                    @if ($question->QImage)
                                        <img src="{{ asset('storage/' . $question->QImage) }}" alt="Question Image" class="question-image question-{{ $question->id }}" style="max-width: 75%; margin: 0 auto;">
                                    @else
                                        <p>No question image available</p>
                                    @endif
                                    @if ($question->AImage)
                                        <img src="{{ asset('storage/' . $question->AImage) }}" alt="Answer Image" class="answer-image answer-{{ $question->id }}" style="display: none; max-width: 75%; margin: 0 auto;">
                                    @else
                                        <p>No answer image available</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

<!-- Updated JavaScript to toggle question and answer images -->
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
