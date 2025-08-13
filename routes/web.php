<?php

use App\Http\Controllers\BuzzController;
use App\Models\Competition;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes will be added by Breeze
// For now, we'll skip auth middleware on these routes for testing

// Competition control routes (should be protected by auth + authorization)
Route::prefix('competitions/{competition}')->group(function () {
    Route::post('/question/open', [BuzzController::class, 'openQuestion']);
    Route::post('/question/next', [BuzzController::class, 'nextQuestion']);
    Route::post('/answer/correct', [BuzzController::class, 'markCorrect']);
    Route::post('/answer/wrong', [BuzzController::class, 'markWrong']);
});

// Participant buzz route (should check participant authorization)
Route::post('/competitions/{competition}/buzz', [BuzzController::class, 'buzz']);

// Participant join page
Route::get('/p/{competition:code}', function (Competition $competition) {
    return view('participant.buzzer', compact('competition'));
})->name('participant.buzzer');

// Host control panel
Route::get('/host/{competition}', function (Competition $competition) {
    return view('host.control-panel', compact('competition'));
})->name('host.control-panel');

// Join competition page
Route::get('/join', function () {
    return view('participant.join');
})->name('participant.join');
