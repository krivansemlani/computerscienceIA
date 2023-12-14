<x-dashboard-layout>
    @section('content')
        <div class="container mx-auto mt-8 p-8 bg-white rounded-lg shadow-lg" style="margin: 20px; padding: 20px;">
            <h1 class="text-3xl font-semibold mb-6">MCQ Self-Evaluation</h1>
            <form method="POST" action="{{ route('usermodule.startEvaluation') }}" class="max-w-md mx-auto">
                @csrf
                {{-- dropdown for subject --}}
                <div class="mb-6">
                    <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Select Subject:</label>
                    <select name="subject_id" id="subject" class="w-full p-3 border border-gray-300 rounded" required>
                        <option value="" disabled selected>Select a Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->SName }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- dynamically updating dropdown for chapter --}}
                <div class="mb-6">
                    <label for="chapter" class="block text-gray-700 text-sm font-bold mb-2">Select Chapter:</label>
                    <select name="chapter_id" id="chapter" class="w-full p-3 border border-gray-300 rounded" required>
                        <option value="" disabled selected>Select a Chapter</option>
                    </select>
                </div>

                <div class="mb-6">
                    <div class="mb-4 flex justify-center">
                        <button type="submit" id="startEvaluationBtn" disabled
                            style="background-color: #3490dc; color: #ffffff; font-weight: bold; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                            Start Evaluation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-dashboard-layout>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateChapters(subjectId) {
            $.ajax({
                url: '/get-chapters/' + subjectId,
                method: 'GET',
                success: function(data) {

                    $('#chapter').empty();
                    $('#chapter').append($('<option>', {
                        value: '',
                        text: 'Select a Chapter',
                        disabled: true,
                        selected: true
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
        var initialSubjectId = $('#subject').val();
        updateChapters(initialSubjectId);
        $('#subject').change(function() {
            var subjectId = $(this).val();
            updateChapters(subjectId);
        });
        $('form').on('input change', function() {
            $('#startEvaluationBtn').prop('disabled', !this.checkValidity());
        });
    </script>
