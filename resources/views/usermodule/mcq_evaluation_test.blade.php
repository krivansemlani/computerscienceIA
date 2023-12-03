<x-dashboard-layout>

    @section('content')
        <div class="container">
            <h1 class="my-4" style="font-weight: bold; font-size:18pt">MCQ Self-Evaluation</h1>
            <br />

            <p>Currently taking a test on: <strong>{{ $selectedSubject->SName }}</strong> -
                <strong>{{ $selectedChapter->CName }}</strong></p>

            <form method="POST" action="{{ route('usermodule.submitEvaluation') }}">
                @csrf

                @foreach ($selectedQuestions as $question)
                    <div class="mb-4" style="display: flex;">
                        <div class="question-container"
                            style="border: 1px solid #000000; max-height: 500px; overflow-y: auto; padding: 10px; flex: 1;">
                            <p><img class="question-image" src="{{ asset('storage/' . $question->QImage) }}"
                                    alt="Question Image"></p>
                        </div>
                        <div class="panel"
                            style="border: 1px solid #ccc; max-height: 500px; overflow-y: auto; padding: 10px; flex: 1; margin-left: 10px;">
                            <div class="form-check" style="margin-bottom: 8px;">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="option1" id="answers[{{ $question->id }}]_option1">
                                <label class="form-check-label" for="answers[{{ $question->id }}]_option1">
                                    {{ $question->Option1 }}
                                </label>
                            </div>
                            <div class="form-check" style="margin-bottom: 8px;">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="option2" id="answers[{{ $question->id }}]_option2">
                                <label class="form-check-label" for="answers[{{ $question->id }}]_option2">
                                    {{ $question->Option2 }}
                                </label>
                            </div>
                            <div class="form-check" style="margin-bottom: 8px;">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="option3" id="answers[{{ $question->id }}]_option3">
                                <label class="form-check-label" for="answers[{{ $question->id }}]_option3">
                                    {{ $question->Option3 }}
                                </label>
                            </div>
                            <div class="form-check" style="margin-bottom: 8px;">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                    value="option4" id="answers[{{ $question->id }}]_option4">
                                <label class="form-check-label" for="answers[{{ $question->id }}]_option4">
                                    {{ $question->Option4 }}
                                </label>
                            </div>
                            <div class="annotation-box"
                                style="border: 1px solid #ccc; overflow-y: auto; padding: 10px; margin-top: 10px;">
                                <label for="annotation">Rough Work or Annotations</label>
                                <textarea id="annotation" name="answers_annotation[{{ $question->id }}]" rows="6" style="width: 100%;"></textarea>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mb-4 flex justify-center">
                    <button type="submit"
                        style="background-color: #3490dc; color: #ffffff; font-weight: bold; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                        Submit Answers
                    </button>
                </div>


            </form>
        </div>

    </x-dashboard-layout>
