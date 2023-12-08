<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Subject;

use App\Rules\MaxWords;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        return view('chapters.index', compact('chapters', 'subjects'));
    }

    public function create()
    {
        $subjects = Subject::all(); 
        return view('chapters.create', compact('subjects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'CName' => 'required|string|max:255',
            'CDescription' => [new MaxWords(5)],
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
            'CDescription' => [new MaxWords(5)],
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
        $chapter->mcquestions()->delete();
        $chapter->qrqquestions()->delete();
        $chapter->delete();
        return redirect()->route('chapters.index')->with('success', 'Chapter and associated questions deleted successfully.');
    }


}

