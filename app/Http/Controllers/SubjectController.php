<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
    
        return view('subjects.index', compact('subjects'));
    }
    

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'SName' => 'required|string|max:255',
            'SDescription' => 'required|string',
        ]);

        Subject::create([
            'SName' => $request->input('SName'),
            'SDescription' => $request->input('SDescription'),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'SName' => 'required|string|max:255',
            'SDescription' => 'required|string',
        ]);

        $subject->update([
            'SName' => $request->input('SName'),
            'SDescription' => $request->input('SDescription'),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        // Delete associated MCQ questions
        $subject->chapters->each(function ($chapter) {
            $chapter->mcquestions()->delete();
        });
        $subject->chapters->each(function ($chapter) {
            $chapter->qrqquestions()->delete();
        });
    
        // Delete associated chapters
        $subject->chapters()->delete();
    
        // Delete the subject itself
        $subject->delete();
    
        return redirect()->route('subjects.index')->with('success', 'Subject and associated data deleted successfully.');
    }
    
    
}
