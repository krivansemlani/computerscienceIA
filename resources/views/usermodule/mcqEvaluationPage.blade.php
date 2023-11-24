<x-dashboard-layout>

    @section('content')
    <div class="container mx-auto mt-8 p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">MCQ Self-Evaluation</h1>

        <form method="POST" action="{{ route('usermodule.startEvaluation') }}" class="max-w-md mx-auto">
            @csrf
            <div class="mb-6">
                <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Select Subject:</label>
                <select name="subject_id" id="subject" class="w-full p-3 border border-gray-300 rounded">
                    <option value="">Select a Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="chapter" class="block text-gray-700 text-sm font-bold mb-2">Select Chapter:</label>
                <select name="chapter_id" id="chapter" class="w-full p-3 border border-gray-300 rounded">
                    <option value="">Select a Chapter</option>
                </select>
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
                    Start Evaluation
                </button>
            </div>
        </form>
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
</script>
