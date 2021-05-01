<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\GigController;


// Admin
Route::get('/admin', [AdminController::class, 'getIndex'])->name('admin')->middleware('admin');
// Admin
Route::get('/admin', [AdminController::class, 'getIndex'])->name('admin.profile.events')->middleware('admin');
// Admin users
Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users')->middleware('admin');
Route::get('/admin/users/deleted', [AdminController::class, 'getDeletedUsers'])->name('admin.users.deleted')->middleware('admin');
Route::get('/admin/users/edit/{user}', [AdminController::class, 'editUsers'])->name('admin.users.edit')->middleware('admin');
Route::post('/admin/users/save', [AdminController::class, 'postUsers'])->name('admin.users.save')->middleware('admin');
Route::get('/admin/users/delete/{user}', [AdminController::class, 'deleteUsers'])->name('admin.users.delete')->middleware('admin');
Route::get('/admin/users/activate/{user}', [AdminController::class, 'activateUsers'])->name('admin.users.activate')->middleware('admin');

Route::get('/admin/microphones', [AdminController::class, 'getIndex'])->name('admin.microphones')->middleware('admin');
Route::get('/admin/pas', [AdminController::class, 'getIndex'])->name('admin.pas')->middleware('admin');

/*
*** Event Profile Routes
*/
Route::get('/event/profile/events', [EventController::class, 'getEvents'])->name('event.profile.events')->middleware('event');
Route::get('/event/profile/applicants/{event}', [EventController::class, 'getEventApplicants'])->name('event.applicants')->middleware('event');
Route::get('/event/accept/artist/{event}/{accepted_applicant}', [EventController::class, 'acceptApplicant'])->name('artist.accept')->middleware('event');
Route::get('/event/reject/artist/{event}/{rejected_applicant}/{application}', [EventController::class, 'rejectApplicant'])->name('artist.reject')->middleware('event');

// edit event
Route::get('/event/create/event/{event?}', [EventController::class, 'createEvent'])->name('event.create')->middleware('event');
Route::post('/event/create/event', [EventController::class, 'saveEvent'])->name('event.create.save')->middleware('event');

// Edit event profile
Route::get('/event/profile/edit', [EventController::class, 'editProfileEvent'])->name('edit.profile.event')->middleware('event');
Route::post('/event/profile/edit', [EventController::class, 'saveProfileEvent'])->name('save.profile.event')->middleware('event');


/*
*** Artist Profile Routes
*/
Route::get('/artist/profile/events', [ArtistController::class, 'getEvents'])->name('artist.profile.events')->middleware('artist');
Route::get('/artist/members', [ArtistController::class, 'getMembers'])->name('artist.members')->middleware('artist');
Route::get('/artist/members/{user}', [ArtistController::class, 'deleteMembers'])->name('artist.members.delete')->middleware('artist');
Route::post('/artist/members', [ArtistController::class, 'postMembers'])->name('artist.members.save');
Route::get('/artist/queries/', [ArtistController::class, 'getQueries'])->name('artist.queries')->middleware('artist');
Route::get('/artist/queries/', [ArtistController::class, 'getQueries'])->name('artist.queries')->middleware('artist');
Route::get('/artist/queries/delete/{querie}', [ArtistController::class, 'deleteQuerie'])->name('artist.queries.delete')->middleware('artist');

/*
*** Event + Artist Profile Routes
*/
// change password
Route::get('/event/password/change', [EventController::class, 'changePassword'])->name('event.password.change')->middleware('artistEvent');
Route::post('/event/password/change', [ChangePasswordController::class, 'changePassword'])->name('event.password.submit')->middleware('artistEvent');
// manage media
Route::get('/event/media/', [EventController::class, 'getEventMedia'])->name('event.media')->middleware('artistEvent');

//
// Find Gig Routes
//
// Home (redirect to find.event)
Route::get('/', [GigController::class, 'getIndex'])->name('home');
// Show all gigs
Route::get('/find/event', [GigController::class, 'getFindEvent'])->name('find.event');
// filter gigs
Route::post('/find/event', [GigController::class, 'postFindEvent'])->name('find.event.apply');
// Show gig details
Route::get('/find/event/{event}', [GigController::class, 'getEvent'])->name('event');
// Apply for event
Route::post('/find/event/apply', [GigController::class, 'postEventApply'])->name('event.apply');

// Find Artist Routes
Route::get('/find/artist', [ArtistController::class, 'getFindArtist'])->name('find.artist');
Route::post('/find/artist', [ArtistController::class, 'postFindArtist'])->name('find.artist.apply');
Route::get('/find/artist/{artist}', [ArtistController::class, 'getArtist'])->name('artist');
Route::get('/find/artist/rider/download/{artist}', [ArtistController::class, 'getRider'])->name('download.rider');


Route::get('/forbidden', [ArtistController::class, 'getForbidden'])->name('forbidden');
require __DIR__.'/auth.php';
