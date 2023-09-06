<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;

use App\Models\Subject;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::all();
        return view('chapters.index', compact('chapters'));
    }

    public function create()
    {
        $subjects = Subject::all(); // Fetch all subjects to populate the dropdown
        return view('chapters.create', compact('subjects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'CName' => 'required|string|max:255',
            'CDescription' => 'required|string',
            'subject_id' => 'required|exists:subject,id',
        ]);

        Chapter::create([
            'CName' => $request->input('CName'),
            'CDescription' => $request->input('CDescription'),
            'subject_id' => $request->input('subject_id'),
        ]);

        return redirect()->route('chapters.index')->with('success', 'Chapter created successfully.');
    }

    public function show(Chapter $chapter)
    {
        return view('chapters.show', compact('chapter'));
    }

    public function edit(Chapter $chapter)
{
    $subjects = Subject::all(); 
    return view('chapters.edit', compact('chapter', 'subjects'));
}


    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'CName' => 'required|string|max:255',
            'CDescription' => 'required|string',
            'subject_id' => 'required|exists:subject,id',
        ]);

        $chapter->update([
            'CName' => $request->input('CName'),
            'CDescription' => $request->input('CDescription'),
            'subject_id' => $request->input('subject_id'),
        ]);

        return redirect()->route('chapters.index')->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Chapter $chapter)
{
    // Delete associated MCQuestions
    $chapter->mcquestions()->delete();

    // Delete associated QRQQuestions
    $chapter->qrqquestions()->delete();

    // Then delete the chapter itself
    $chapter->delete();

    return redirect()->route('chapters.index')->with('success', 'Chapter and associated questions deleted successfully.');
}


}
