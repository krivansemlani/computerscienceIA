<?php
namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\RevisionQuestion;

class RevisionQuestionController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        $revisionQuestions = RevisionQuestion::all();
        return view('revision-questions.index', compact('revisionQuestions', 'subjects', 'chapters'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        return view('revision-questions.create', compact('subjects', 'chapters'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'AImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'chapter_id' => 'required|exists:chapter,id',
        ]);
        $QImage = null;
        $AImage = null;
        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public');
        }
        if ($request->hasFile('AImage')) {
            $AImage = $request->file('AImage')->store('aimages', 'public');
        }
        RevisionQuestion::create([
            'QImage' => $QImage,
            'AImage' => $AImage,
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return redirect()->route('revision-questions.index')->with('success', 'RevisionQuestion created successfully.');
    }

    public function show(RevisionQuestion $revisionQuestion)
    {
        return view('revision-questions.show', compact('revisionQuestion'));
    }

    public function edit(RevisionQuestion $revisionQuestion)
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        return view('revision-questions.edit', compact('revisionQuestion', 'subjects', 'chapters'));
    }

    public function update(Request $request, RevisionQuestion $revisionQuestion)
    {
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'AImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'chapter_id' => 'required|exists:chapter,id',
        ]);
        $QImage = $revisionQuestion->QImage;
        $AImage = $revisionQuestion->AImage;

        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public');
        }

        if ($request->hasFile('AImage')) {
            $AImage = $request->file('AImage')->store('aimages', 'public');
        }
        $revisionQuestion->update([
            'QImage' => $QImage,
            'AImage' => $AImage,
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return redirect()->route('revision-questions.index')->with('success', 'RevisionQuestion updated successfully.');
    }

    public function destroy(RevisionQuestion $revisionQuestion)
    {
        $revisionQuestion->delete();
        return redirect()->route('revision-questions.index')->with('success', 'RevisionQuestion deleted successfully.');
    }
}
