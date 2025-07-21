<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::controller(InvitationController::class)->group(function () {
    Route::get('/', 'show')->name('invitation');
    Route::get('/generate-link', 'generateLink')->name('invitation.generate-link');
    Route::get('/data/love-story', 'getLoveStory')->name('invitation.love-story');
    Route::post('/api/store', 'store')->name('invitation.store');
    Route::get('/api/messages', 'getMessages')->name('invitation.messages');
});
