<x-dashboard-layout>

    @section('content')
        <div class="container mx-auto">
            <h1 class="my-4" style="font-weight:bold; font-size:18pt; text-align: center;">MCQ Self-Evaluation Result</h1>
            <br />

            <div class="mb-4" style="text-align: center;">
                @if ($evaluationResult === 'strong')
                    <p>Congratulations! You are strong in this subject.</p>
                @else
                    <p style="font-weight:lighter">Keep practicing. You need improvement in this subject.</p>
                @endif
            </div>

            <div class="mb-4" style="text-align: center;">
                <p>Your Score: {{ $score }} out of {{ $totalQuestions }}</p>
            </div>

            <div class="mb-4" style="text-align: center;">
                <a href="{{ route('usermodule.mcqEvaluationPage') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" style="margin-right: 10px">
                    Retake the Test
                </a>
                <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Return to Dashboard
                </a>
            </div>
        </div>

    </x-dashboard-layout>
