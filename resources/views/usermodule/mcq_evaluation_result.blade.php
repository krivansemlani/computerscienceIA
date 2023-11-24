<x-dashboard-layout>

    @section('content')
    <div class="container">
        <h1 class="my-4">MCQ Self-Evaluation Result</h1>

        <div class="mb-4">
            @if ($evaluationResult === 'strong')
                <p>Congratulations! You are strong in this subject.</p>
            @else
                <p>Keep practicing. You need improvement in this subject.</p>
            @endif
        </div>

        <div class="mb-4">
            <p>Your Score: {{ $score }} out of {{ $totalQuestions }}</p>
        </div>

        <div class="mb-4">
            <a href="{{ route('usermodule.mcqEvaluationPage') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Retake the Test
            </a>
            <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Return to Dashboard
            </a>
        </div>
    </div>

    </x-dashboard-layout>
