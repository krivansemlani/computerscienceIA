<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MCQuestionController;
use App\Http\Controllers\UserModuleController;
use App\Http\Controllers\RevisionQuestionController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Chapter routes
    Route::get('/chapters', [ChapterController::class, 'index'])->name('chapters.index');
    Route::get('/chapters/create', [ChapterController::class, 'create'])->name('chapters.create');
    Route::post('/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::get('/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
    Route::get('/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('chapters.edit');
    Route::put('/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapters.update');
    Route::delete('/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy');

    // Subject routes
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

    // MCQuestion routes
    Route::get('/mcquestions', [MCQuestionController::class, 'index'])->name('mcquestions.index');
    Route::get('/mcquestions/create', [MCQuestionController::class, 'create'])->name('mcquestions.create');
    Route::post('/mcquestions', [MCQuestionController::class, 'store'])->name('mcquestions.store');
    Route::get('/mcquestions/{mcquestion}', [MCQuestionController::class, 'show'])->name('mcquestions.show');
    Route::get('/mcquestions/{mcquestion}/edit', [MCQuestionController::class, 'edit'])->name('mcquestions.edit');
    Route::put('/mcquestions/{mcquestion}', [MCQuestionController::class, 'update'])->name('mcquestions.update');
    Route::delete('/mcquestions/{mcquestion}', [MCQuestionController::class, 'destroy'])->name('mcquestions.destroy');
    
    //QRQuestions Routes
    Route::get('/revision-questions', [RevisionQuestionController::class, 'index'])->name('revision-questions.index');
    Route::get('/revision-questions/create', [RevisionQuestionController::class, 'create'])->name('revision-questions.create');
    Route::post('/revision-questions', [RevisionQuestionController::class, 'store'])->name('revision-questions.store');
    Route::get('/revision-questions/{revision_question}', [RevisionQuestionController::class, 'show'])->name('revision-questions.show');
    Route::get('/revision-questions/{revision_question}/edit', [RevisionQuestionController::class, 'edit'])->name('revision-questions.edit');
    Route::put('/revision-questions/{revision_question}', [RevisionQuestionController::class, 'update'])->name('revision-questions.update');
    Route::delete('/revision-questions/{revision_question}', [RevisionQuestionController::class, 'destroy'])->name('revision-questions.destroy');


});

Route::get('/revisionquestions', [UserModuleController::class, 'index'])->name('usermodule.revisionquestions');
Route::get('/get-chapters/{subjectId}', [UserModuleController::class, 'getChapters'])->name('get-chapters');

// MCQ Self-Evaluation Module Routes
Route::get('/mcq-evaluation', [UserModuleController::class, 'mcqEvaluationPage'])->name('usermodule.mcqEvaluationPage');
Route::post('/start-evaluation', [UserModuleController::class, 'startEvaluation'])->name('usermodule.startEvaluation');
Route::post('/submit-evaluation', [UserModuleController::class, 'submitEvaluation'])->name('usermodule.submitEvaluation');

Route::get('/get-counts', [DashboardController::class, 'getCounts']);

require __DIR__ . '/auth.php';