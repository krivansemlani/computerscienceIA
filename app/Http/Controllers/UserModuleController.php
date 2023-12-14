<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Chapter;
use App\Models\MCQuestion; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\RevisionQuestion;

class UserModuleController extends Controller
{
    public function index(Request $request)
    {
     
        $subjects = Subject::all();
        $chapters = Chapter::all();

        $selectedSubject = $request->input('subject_id');
        $selectedChapter = $request->input('chapter_id');
        $revisionQuestionsQuery = RevisionQuestion::query();
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
        $chapters = Chapter::where('subject_id', $subjectId)->pluck('CName', 'id');
        return response()->json($chapters);
    }

    public function mcqEvaluationPage()
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        return view('usermodule.mcqEvaluationPage', [
            'subjects' => $subjects,
            'chapters' => $chapters,
        ]);
    }

    public function startEvaluation(Request $request)
    {
        $selectedSubject = $request->input('subject_id');
        $selectedChapter = $request->input('chapter_id');
        $selectedSubjectModel = Subject::find($selectedSubject);
        $selectedChapterModel = Chapter::find($selectedChapter);
        $selectedQuestions = MCQuestion::inRandomOrder()
            ->whereHas('chapter', function ($query) use ($selectedSubject, $selectedChapter) {
                $query->where('subject_id', $selectedSubject)
                    ->where('id', $selectedChapter);
            })
            ->limit(20)
            ->get();
        Session::put('selectedQuestions', $selectedQuestions);
        Session::put('selectedSubject', $selectedSubjectModel);
        Session::put('selectedChapter', $selectedChapterModel);
        return view('usermodule.mcq_evaluation_test', [
            'selectedQuestions' => $selectedQuestions,
            'selectedSubject' => $selectedSubjectModel,
            'selectedChapter' => $selectedChapterModel,
        ]);
    }

    public function submitEvaluation(Request $request)
    {
        $selectedQuestions = Session::get('selectedQuestions');
        $userAnswers = $request->input('answers');
        $score = 0;
        $totalQuestions = count($selectedQuestions);
        foreach ($selectedQuestions as $question) {
            $correctAnswer = strtolower($question->Answer); 
            if (isset($userAnswers[$question->id])) {
                $userAnswer = strtolower($userAnswers[$question->id]); 
                if ($userAnswer == $correctAnswer) {
                    $score++;
                }
            }
        }
        $evaluationResult = ($score / $totalQuestions) >= 0.7 ? 'strong' : 'weak';

        return view('usermodule.mcq_evaluation_result', [
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'evaluationResult' => $evaluationResult,
        ]);
    }

}