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
        // Retrieve a list of all RevisionQuestions
        $subjects = Subject::all();
        $chapters = Chapter::all();
        $revisionQuestions = RevisionQuestion::all();
        return view('revision-questions.index', compact('revisionQuestions','subjects', 'chapters'));
    }

    public function create()
{
    // Retrieve subjects from the database
    $subjects = Subject::all();

    // Retrieve chapters from the database
    $chapters = Chapter::all();

    // Load the 'revision-questions.create' view and pass the subjects and chapters data
    return view('revision-questions.create', compact('subjects', 'chapters'));
}


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'AImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'chapter_id' => 'required|exists:chapter,id',
        ]);

        // Handle file uploads (if provided)
        $QImage = null;
        $AImage = null;

        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public');
        }

        if ($request->hasFile('AImage')) {
            $AImage = $request->file('AImage')->store('aimages', 'public');
        }

        // Create a new RevisionQuestion
        RevisionQuestion::create([
            'QImage' => $QImage,
            'AImage' => $AImage,
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return redirect()->route('revision-questions.index')->with('success', 'RevisionQuestion created successfully.');
    }

    public function show(RevisionQuestion $revisionQuestion)
    {
        // Show details of the RevisionQuestion
        return view('revision-questions.show', compact('revisionQuestion'));
    }

    public function edit(RevisionQuestion $revisionQuestion)
    {
        // Retrieve a list of all chapters to populate the dropdown
        $subjects = Subject::all();

        $chapters = Chapter::all();
        return view('revision-questions.edit', compact('revisionQuestion', 'subjects','chapters'));
    }

    public function update(Request $request, RevisionQuestion $revisionQuestion)
    {
        // Validate the incoming request data
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'AImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'chapter_id' => 'required|exists:chapter,id',
        ]);

        // Handle file uploads (if provided)
        $QImage = $revisionQuestion->QImage;
        $AImage = $revisionQuestion->AImage;

        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public');
        }

        if ($request->hasFile('AImage')) {
            $AImage = $request->file('AImage')->store('aimages', 'public');
        }

        // Update the RevisionQuestion
        $revisionQuestion->update([
            'QImage' => $QImage,
            'AImage' => $AImage,
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return redirect()->route('revision-questions.index')->with('success', 'RevisionQuestion updated successfully.');
    }

    public function destroy(RevisionQuestion $revisionQuestion)
    {
        // Delete the RevisionQuestion
        $revisionQuestion->delete();

        return redirect()->route('revision-questions.index')->with('success', 'RevisionQuestion deleted successfully.');
    }
}
