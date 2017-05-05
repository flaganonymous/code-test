<?php

Route::group(['middleware' => ['web', 'auth', 'CanViewCRM']], function() {

    // Dashboard (overview) routes
    Route::get('/crm/dashboard', 'testCRm\CrmLauncher\Controllers\DashboardController@index');
    Route::get('/crm/launch', 'testCRm\CrmLauncher\Controllers\DashboardController@launch');

    // Helper routes
    Route::get('/crm/help', 'testCRm\CrmLauncher\Controllers\DashboardController@help');
    Route::get('/crm/help/disable', 'testCRm\CrmLauncher\Controllers\DashboardController@disableHelp');

    // Facebook login routes
    Route::get('facebook', 'testCRm\CrmLauncher\Controllers\FacebookLoginController@askFbPermissions');
    Route::get('/callback', 'testCRm\CrmLauncher\Controllers\FacebookLoginController@fbCallback');

    // Publish routes
    Route::get('/crm/publisher', 'testCRm\CrmLauncher\Controllers\PublishController@index');
    Route::get('/crm/publisher/{id}', 'testCRm\CrmLauncher\Controllers\PublishController@detail');
    Route::post('/crm/publish', 'testCRm\CrmLauncher\Controllers\PublishController@publish');
    Route::get('/crm/publishment/{id}/delete', 'testCRm\CrmLauncher\Controllers\PublishController@delete');
    Route::get('/crm/reaction/{id}/delete', 'testCRm\CrmLauncher\Controllers\PublishController@deleteReaction');
    Route::post('/crm/publisher/{id}/answer', 'testCRm\CrmLauncher\Controllers\PublishController@replyTweet');
    Route::post('/crm/publisher/{id}/post', 'testCRm\CrmLauncher\Controllers\PublishController@replyPost');

    // Cases routes (1/3) - general
    Route::get('/crm/cases', 'testCRm\CrmLauncher\Controllers\CasesController@index'); // Dashboard overview
    Route::get('/crm/cases/filter', 'testCRm\CrmLauncher\Controllers\CasesController@filter'); // Filter dashboard overview
    Route::get('/crm/case/{id}', 'testCRm\CrmLauncher\Controllers\CasesController@detail'); // Detail page of a specific case
    Route::get('/crm/case/{caseId}/close', 'testCRm\CrmLauncher\Controllers\CasesController@toggleCase'); // Close or re-open a case

    // Cases routes (2/3) - Facebook related
    Route::post('/crm/answer/{id}/post', 'testCRm\CrmLauncher\Controllers\CasesController@replyPost'); // Reply to a Facebook post
    Route::post('/crm/answer/reply/{id}', 'testCRm\CrmLauncher\Controllers\CasesController@replyPrivate'); // Reply to a Facebook post
    Route::get('/crm/case/{caseId}/post/{messageId}', 'testCRm\CrmLauncher\Controllers\CasesController@deletePost'); // Delete Facebook post
    Route::get('/crm/case/{caseId}/inner/{messageId}', 'testCRm\CrmLauncher\Controllers\CasesController@deleteInner'); // Delete inner Facebook post

    // Cases routes (3/3) - Twitter related
    Route::post('/crm/answer/{id}', 'testCRm\CrmLauncher\Controllers\CasesController@replyTweet'); // Reply to a tweet
    Route::get('/crm/case/{caseId}/tweet/{messageId}', 'testCRm\CrmLauncher\Controllers\CasesController@deleteTweet'); // Delete a tweet
    Route::get('/crm/case/{caseId}/follow', 'testCRm\CrmLauncher\Controllers\CasesController@toggleFollowUser'); // Follow a user on Twitter


    // Case summary routes
    Route::post('/crm/case/{id}/summary/add', 'testCRm\CrmLauncher\Controllers\SummaryController@addSummary'); // Add a case summary
    Route::get('/crm/case/{id}/summary/{summaryId}/delete', 'testCRm\CrmLauncher\Controllers\SummaryController@deleteSummary'); // Delete a case summary

    // User management routes
    Route::get('/crm/users', 'testCRm\CrmLauncher\Controllers\UsersController@index'); // Team overview
    Route::get('/crm/user/add', 'testCRm\CrmLauncher\Controllers\UsersController@addUser'); // Add user
    Route::post('/crm/user/add', 'testCRm\CrmLauncher\Controllers\UsersController@postUser'); // Team overview
    Route::post('/crm/user/{id}', 'testCRm\CrmLauncher\Controllers\UsersController@toggleUser'); // Auth/de-auth user to see CRM
    Route::get('/crm/users/filter', 'testCRm\CrmLauncher\Controllers\UsersController@searchUser'); // Search user by name/e-mail
});
