<?php

namespace App\Http\Controllers;

use App\Models\MCQuestion;
use App\Models\RevisionQuestion;
use App\Models\Subject;
use App\Models\Chapter;

class DashboardController extends Controller
{
    public function getCounts()
    {
        $subChapMcqCount = MCQuestion::count();
        $revisionQCount = RevisionQuestion::count();
        $subjectCount = Subject::count();
        $chapterCount = Chapter::count();

        return response()->json([
            'subChapMcqCount' => $subChapMcqCount,
            'revisionQCount' => $revisionQCount,
            'subjectCount' => $subjectCount,
            'chapterCount' => $chapterCount,
        ]);
    }
}
