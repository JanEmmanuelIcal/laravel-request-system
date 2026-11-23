<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->is_admin) {
        $counts = [
            'total' => App\Models\ServiceRequest::count(),
            'pending' => App\Models\ServiceRequest::where('status', 'pending')->count(),
            'approved' => App\Models\ServiceRequest::where('status', 'approved')->count(),
            'rejected' => App\Models\ServiceRequest::where('status', 'rejected')->count(),
        ];
        $recentRequests = App\Models\ServiceRequest::latest()->take(5)->get();
    } else {
        $counts = [
            'total' => App\Models\ServiceRequest::where('user_id', $user->id)->count(),
            'pending' => App\Models\ServiceRequest::where('user_id', $user->id)->where('status', 'pending')->count(),
            'approved' => App\Models\ServiceRequest::where('user_id', $user->id)->where('status', 'approved')->count(),
            'rejected' => App\Models\ServiceRequest::where('user_id', $user->id)->where('status', 'rejected')->count(),
        ];
        $recentRequests = App\Models\ServiceRequest::where('user_id', $user->id)->latest()->take(5)->get();
    }

    return view('dashboard', compact('counts', 'recentRequests'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/requests', [ServiceRequestController::class, 'index'])
        ->name('requests.index');

    Route::get('/requests/{serviceRequest}', [ServiceRequestController::class, 'show'])
        ->name('requests.show');

    Route::post('/requests', [ServiceRequestController::class, 'store'])
        ->name('requests.store');

    Route::patch('/requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])
        ->name('requests.updateStatus');
});

require __DIR__.'/auth.php';