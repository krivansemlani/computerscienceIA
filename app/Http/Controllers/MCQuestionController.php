<?php
namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\MCQuestion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MCQuestionController extends Controller
{
    // ...

    public function index()
    {
        // Retrieve a list of all RevisionQuestions
        $subjects = Subject::all();
        $chapters = Chapter::all();
        $mcquestions = MCQuestion::all();
        return view('mcquestions.index', compact('mcquestions','subjects', 'chapters'));
    }
    public function create()
    
{
    $subjects = Subject::all();

    // Retrieve chapters from the database
    $chapters = Chapter::all();

    // Load the 'revision-questions.create' view and pass the chapters data
    return view('mcquestions.create', compact('chapters','subjects'));
}


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'Option1' => 'required|string',
            'Option2' => 'required|string',
            'Option3' => 'required|string',
            'Option4' => 'required|string',
            'Answer' => 'required|in:Option1,Option2,Option3,Option4',
            'chapter_id' => 'required|exists:chapter,id',
        ]);

        // Handle file upload (if provided)
        $QImage = null;
        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public'); // Store the image in the "public/qimages" directory
        }

        // Create a new MCQuestion
        MCQuestion::create([
            'QImage' => $QImage,
            'Option1' => $request->input('Option1'),
            'Option2' => $request->input('Option2'),
            'Option3' => $request->input('Option3'),
            'Option4' => $request->input('Option4'),
            'Answer' => $request->input('Answer'),
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return redirect()->route('mcquestions.index')->with('success', 'MCQuestion created successfully.');
    }

    public function show(MCQuestion $mcquestion)
    {
        // Show details of the MCQuestion
        return view('mcquestions.show', compact('mcquestion'));
    }

    public function edit(MCQuestion $mcquestion)
    {
        // Retrieve a list of all chapters to populate the dropdown
        $chapters = Chapter::all();
        $subjects = Subject::all();
        return view('mcquestions.edit', compact('mcquestion', 'chapters','subjects'));
    }

    public function update(Request $request, MCQuestion $mcquestion)
    {
        // Validate the incoming request data
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'Option1' => 'required|string',
            'Option2' => 'required|string',
            'Option3' => 'required|string',
            'Option4' => 'required|string',
            'Answer' => 'required|in:Option1,Option2,Option3,Option4',
            'chapter_id' => 'required|exists:chapter,id',
        ]);

        // Handle file upload (if provided)
        $QImage = $mcquestion->QImage;
        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public'); // Store the updated image
        }

        // Update the MCQuestion
        $mcquestion->update([
            'QImage' => $QImage,
            'Option1' => $request->input('Option1'),
            'Option2' => $request->input('Option2'),
            'Option3' => $request->input('Option3'),
            'Option4' => $request->input('Option4'),
            'Answer' => $request->input('Answer'),
            'chapter_id' => $request->input('chapter_id'),
        ]);

        return redirect()->route('mcquestions.index')->with('success', 'MCQuestion updated successfully.');
    }

    public function destroy(MCQuestion $mcquestion)
    {
        // Delete the MCQuestion
        $mcquestion->delete();

        return redirect()->route('mcquestions.index')->with('success', 'MCQuestion deleted successfully.');
    }
}
