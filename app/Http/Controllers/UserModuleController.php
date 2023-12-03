<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Chapter;
use App\Models\MCQuestion; // Import MCQuestion model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\RevisionQuestion;

class UserModuleController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all subjects and chapters to populate dropdowns
        $subjects = Subject::all();
        $chapters = Chapter::all();

        // Default values for selected subject and chapter
        $selectedSubject = $request->input('subject_id');
        $selectedChapter = $request->input('chapter_id');

        // Initialize the query to retrieve revision questions
        $revisionQuestionsQuery = RevisionQuestion::query();

        // Filter questions based on selected subject and chapter
        if ($selectedSubject && $selectedChapter) {
            $revisionQuestionsQuery->whereHas('chapter', function ($query) use ($selectedSubject, $selectedChapter) {
                $query->where('subject_id', $selectedSubject)->where('id', $selectedChapter);
            });
        } elseif ($selectedSubject) {
            $revisionQuestionsQuery->whereHas('chapter', function ($query) use ($selectedSubject) {
                $query->where('subject_id', $selectedSubject);
            });
        } elseif ($selectedChapter) {
            $revisionQuestionsQuery->where('chapter_id', $selectedChapter);
        }

        // Fetch revision questions
        $revisionQuestions = $revisionQuestionsQuery->get();

       

        return view('usermodule.index', [
            'subjects' => $subjects,
            'chapters' => $chapters,
            'selectedSubject' => $selectedSubject,
            'selectedChapter' => $selectedChapter,
            'revisionQuestions' => $revisionQuestions,
        ]);
    }

    public function getChapters(Request $request, $subjectId)
    {
        // Fetch chapters for the selected subject
        $chapters = Chapter::where('subject_id', $subjectId)->pluck('CName', 'id');

        return response()->json($chapters);
    }

    public function mcqEvaluationPage()
    {
        // Fetch all subjects and chapters to populate dropdowns
        $subjects = Subject::all();
        $chapters = Chapter::all();

        return view('usermodule.mcqEvaluationPage', [
            'subjects' => $subjects,
            'chapters' => $chapters,
        ]);
    }

    public function startEvaluation(Request $request)
    {
        // Retrieve selected subject and chapter from the form
$selectedSubject = $request->input('subject_id');
$selectedChapter = $request->input('chapter_id');

// Fetch selected subject and chapter
$selectedSubjectModel = Subject::find($selectedSubject);
$selectedChapterModel = Chapter::find($selectedChapter);

// Fetch 10 random MCQ questions based on the subject and chapter
$selectedQuestions = MCQuestion::inRandomOrder()
    ->whereHas('chapter', function ($query) use ($selectedSubject, $selectedChapter) {
        $query->where('subject_id', $selectedSubject)
            ->where('id', $selectedChapter);
    })
    ->limit(5)
    ->get();

// Store the selected questions, subject, and chapter in the session
Session::put('selectedQuestions', $selectedQuestions);
Session::put('selectedSubject', $selectedSubjectModel);
Session::put('selectedChapter', $selectedChapterModel);

return view('usermodule.mcq_evaluation_test', [
    'selectedQuestions' => $selectedQuestions,
    'selectedSubject'   => $selectedSubjectModel,
    'selectedChapter'   => $selectedChapterModel,
]);

    }

    public function submitEvaluation(Request $request)
{
    // Retrieve selected questions and user's answers from the session
    $selectedQuestions = Session::get('selectedQuestions');
    $userAnswers = $request->input('answers'); // Assuming 'answers' is an array of user's selected answers

    // Calculate the user's score and other evaluation logic
    $score = 0;
    $totalQuestions = count($selectedQuestions);

    foreach ($selectedQuestions as $question) {
        $correctAnswer = strtolower($question->Answer); // Convert to lowercase

        if (isset($userAnswers[$question->id])) {
            $userAnswer = strtolower($userAnswers[$question->id]); // Convert to lowercase

            if ($userAnswer == $correctAnswer) {
                $score++;
            }
        }
    }

    // Determine if the user is strong or weak based on the score
    $evaluationResult = ($score / $totalQuestions) >= 0.7 ? 'strong' : 'weak';

    return view('usermodule.mcq_evaluation_result', [
        'score' => $score,
        'totalQuestions' => $totalQuestions,
        'evaluationResult' => $evaluationResult,
    ]);
}

}