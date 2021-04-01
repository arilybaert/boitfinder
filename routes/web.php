<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\GigController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User Specific Routes
Route::get('/admin', [AdminController::class, 'getIndex'])->name('admin')->middleware('admin');
Route::get('/artist', [ArtistController::class, 'getIndex'])->name('artist')->middleware('artist');
Route::get('/event', [EventController::class, 'getIndex'])->name('event')->middleware('event');

/*
*** Event Profile Routes
*/
Route::get('/event/profile/events', [EventController::class, 'getEvents'])->name('event.profile.events');
Route::get('/event/profile/applicants/{event}', [EventController::class, 'getEventApplicants'])->name('event.applicants');
Route::get('/event/accept/artist/{event}/{accepted_applicant}', [EventController::class, 'acceptApplicant'])->name('artist.accept');

// edit profile
Route::get('/event/edit/{event}', [EventController::class, 'editEvent'])->name('event.edit');
Route::get('/event/create/event', [EventController::class, 'createEvent'])->name('event.create');

Route::get('/event/profile/edit', [EventController::class, 'editProfileEvent'])->name('edit.profile.event');

Route::post('/event/profile/edit', [EventController::class, 'saveProfileEvent'])->name('save.profile.event');

Route::get('/event/password/change', [EventController::class, 'changePassword'])->name('event.password.change');
Route::post('/event/password/change', [ChangePasswordController::class, 'changePassword'])->name('event.password.submit');

Route::get('/event/media/', [EventController::class, 'getEventMedia'])->name('event.media');


// Find Gig Routes
Route::get('/', [GigController::class, 'getIndex'])->name('home');
Route::get('/find/event', [GigController::class, 'getFindEvent'])->name('find.event');
Route::get('/find/event/{event}', [GigController::class, 'getEvent'])->name('event');

// Find Artist Routes
Route::get('/find/artist', [ArtistController::class, 'getFindArtist'])->name('find.artist');
Route::get('/find/artist/{artist}', [ArtistController::class, 'getArtist'])->name('artist');
Route::get('/find/artist/rider/download', [ArtistController::class, 'getRider'])->name('download.rider');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
