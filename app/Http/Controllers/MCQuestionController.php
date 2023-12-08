<?php
namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\MCQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MCQuestionController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        $mcquestions = MCQuestion::all();
        return view('mcquestions.index', compact('mcquestions', 'subjects', 'chapters'));
    }
    public function create()
    {
        $subjects = Subject::all();
        $chapters = Chapter::all();
        return view('mcquestions.create', compact('chapters', 'subjects'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'Option1' => 'required|string',
            'Option2' => 'required|string',
            'Option3' => 'required|string',
            'Option4' => 'required|string',
            'Answer' => 'required|in:Option1,Option2,Option3,Option4',
            'chapter_id' => 'required|exists:chapter,id',
        ]);
        $QImage = null;
        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public');
        }
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
        return view('mcquestions.show', compact('mcquestion'));
    }

    public function edit(MCQuestion $mcquestion)
    {
        $chapters = Chapter::all();
        $subjects = Subject::all();
        return view('mcquestions.edit', compact('mcquestion', 'chapters', 'subjects'));
    }

    public function update(Request $request, MCQuestion $mcquestion)
    {

        $request->validate([
            'QImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'Option1' => 'required|string',
            'Option2' => 'required|string',
            'Option3' => 'required|string',
            'Option4' => 'required|string',
            'Answer' => 'required|in:Option1,Option2,Option3,Option4',
            'chapter_id' => 'required|exists:chapter,id',
        ]);
        $QImage = $mcquestion->QImage;
        if ($request->hasFile('QImage')) {
            $QImage = $request->file('QImage')->store('qimages', 'public');
        }
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
        $mcquestion->delete();
        return redirect()->route('mcquestions.index')->with('success', 'MCQuestion deleted successfully.');
    }
}
