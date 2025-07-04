<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::controller(InvitationController::class)->group(function () {
    Route::get('/', 'show')->name('invitation');
    Route::get('/data/love-story', 'getLoveStory')->name('invitation.love-story');
    Route::post('/store', 'store')->name('invitation.store');;
});
