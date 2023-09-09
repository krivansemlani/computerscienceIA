<?php

namespace App\Http\Controllers;

use App\Models\RevisionQuestion;
use App\Models\Subject;
use App\Models\Chapter;
use Illuminate\Http\Request;

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
        //dd($selectedSubject, $selectedChapter, $revisionQuestions);

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
}
