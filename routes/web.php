<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TASK Route

Route::resource('tasks', TaskController::class);


// use OpenAI\Client;

// Route::get('/test-openai', function () {
//     try {
//         $client = \OpenAI::client(env('OPENAI_API_KEY'));
//         $response = $client->chat()->create([
//             'model' => 'gpt-3.5-turbo',
//             'messages' => [
//                 ['role' => 'system', 'content' => 'You are a helpful assistant.'],
//                 ['role' => 'user', 'content' => 'Hello, what is the current time?'],
//             ],
//         ]);
//         return $response->choices[0]['message']['content'];
//     } catch (\Exception $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// });


require __DIR__.'/auth.php';

