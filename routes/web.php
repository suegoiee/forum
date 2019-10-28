<?php

// Home
//Route::get('/', 'HomeController@show')->name('home');
Route::get('/', function () {
    return redirect('forum');
})->name('home');
Route::get('bin/{paste?}', 'HomeController@pastebin');

// Authentication
Route::namespace('Auth')->group(function () {
    // Sessions
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');
    Route::get('logout', 'LoginController@logout')->name('logout');


    Route::post('facebook/login', 'FacebookController@login')->name('facebook.login.post');
    Route::post('google/login', 'GoogleController@login')->name('google.login.post');

    // Registration
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register.post');

    // Password reset
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.forgot');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.forgot.post');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset.post');

    // Email address confirmation
    Route::get('email-confirmation', 'EmailConfirmationController@send')->name('email.send_confirmation');
    Route::get('email/confirmation', 'EmailConfirmationController@confirm')
        ->name('email.confirm');

    // Social authentication
    Route::get('login/github', 'GithubController@redirectToProvider')->name('login.github');
    Route::get('auth/github', 'GithubController@handleProviderCallback');

    //Google Login
    Route::get('/google/auth', 'SocialiteController@redirectToProvider');
    Route::get('/google/auth/callback', 'SocialiteController@handleProviderCallback');
});

// Users
Route::get('dashboard', 'DashboardController@show')->name('dashboard');
Route::get('user/{email_address}', 'ProfileController@show')->name('profile');
Route::get('avatar/{username}', 'ProfileController@avatar')->name('avatar');

// Settings
Route::get('settings', 'Settings\ProfileController@edit')->name('settings.profile');
Route::put('settings', 'Settings\ProfileController@update')->name('settings.profile.update');
Route::get('settings/password', 'Settings\PasswordController@edit')->name('settings.password');
Route::put('settings/password', 'Settings\PasswordController@update')->name('settings.password.update');

// Experts
Route::prefix('experts')->name('experts')->namespace('Experts')->group(function () {
    Route::get('/', 'ExpertController@overview');
    Route::get('/{expert_id}', 'ExpertController@show')->name('.profile');
});

// Courses
Route::prefix('courses')->name('courses')->namespace('Courses')->group(function () {
    Route::get('/', 'CourseController@overview');
    Route::get('/online', 'CourseController@Online')->name('.online');
    Route::get('/online/{online_courses_id}', 'CourseController@showOnline')->name('.online.show');
    Route::get('/online/{online_courses_id}/signIn', 'CourseController@onlineSignIn')->name('.online.signIn');
    Route::get('/pysical', 'CourseController@Pysical')->name('.pysical');
    Route::get('/pysical/{pysical_courses_id}', 'CourseController@showPysical')->name('.pysical.show');
    Route::get('/pysical/{pysical_courses_id}/signIn', 'CourseController@physicalSignIn')->name('.pysical.signIn');
});

// Forum
Route::prefix('forum')->namespace('Forum')->group(function () {
    Route::get('/', 'ThreadsController@overview')->name('forum');
    Route::get('create-thread', 'ThreadsController@create')->name('threads.create');
    Route::post('create-thread', 'ThreadsController@store')->name('threads.store');
    Route::post('ban-thread', 'ThreadsController@banThreads')->name('threads.ban');
    Route::post('top-thread', 'ThreadsController@topThreads')->name('threads.top');

    Route::get('{thread}', 'ThreadsController@show')->name('thread');
    Route::get('{thread}/edit', 'ThreadsController@edit')->name('threads.edit');
    Route::put('{thread}', 'ThreadsController@update')->name('threads.update');
    Route::delete('{thread}', 'ThreadsController@delete')->name('threads.delete');
    Route::put('{thread}/mark-solution/{reply}', 'ThreadsController@markSolution')->name('threads.solution.mark');
    Route::put('{thread}/unmark-solution', 'ThreadsController@unmarkSolution')->name('threads.solution.unmark');
    Route::get('{thread}/subscribe', 'ThreadsController@subscribe')->name('threads.subscribe');
    Route::get('{thread}/unsubscribe', 'ThreadsController@unsubscribe')->name('threads.unsubscribe');

    Route::get('tags/{tag}', 'CategoriesController@show')->name('forum.tag');
});

// Replies
Route::post('replies', 'ReplyController@store')->name('replies.store');
Route::get('replies/{reply}/edit', 'ReplyController@edit')->name('replies.edit');
Route::put('replies/{reply}', 'ReplyController@update')->name('replies.update');
Route::delete('replies/{reply}', 'ReplyController@delete')->name('replies.delete');
Route::post('ban-replies', 'ReplyController@banReplies')->name('replies.ban');

// Subscriptions
Route::get('subscriptions/{subscription}/unsubscribe', 'SubscriptionController@unsubscribe')
    ->name('subscriptions.unsubscribe');

// Admin
Route::prefix('admin')->name('admin')->namespace('Admin')->group(function () {
    //Route::get('/', 'AdminController@index');
    Route::get('/', 'AdminController@index');
    Route::get('/justifyAuthorId', 'AdminController@changeAuthorIdToUaVersion')->name('.justifyAuthorId');
    Route::get('/addCategoeyTypeToCategoryThread', 'AdminController@addCategoeyTypeToCategoryThread')->name('.addCategoeyTypeToCategoryThread');
    Route::get('/migrateData', 'AdminController@migrateData')->name('.migrateData');
    Route::get('category', 'AdminController@category')->name('.category');
    Route::post('category', 'AdminController@newCategory')->name('.category.create');
    Route::post('newCategoryProduct', 'AdminController@newCategoryProduct')->name('.newCategoryProduct.create');
    Route::post('deleteCategoryProduct', 'AdminController@deleteCategoryProduct')->name('.deleteCategoryProduct.delete');
    Route::delete('deleteCategory/{tag}', 'AdminController@deleteCategory')->name('.Category.delete');
    Route::post('permission', 'AdminController@update')->name('.users.master');
    Route::post('delete', 'AdminController@delete')->name('.users.master.delete');
    Route::get('users/{username}', 'UsersController@show')->name('.users.show');
    Route::put('users/{username}/ban', 'UsersController@ban')->name('.users.ban');
    Route::put('users/{username}/unban', 'UsersController@unban')->name('.users.unban');
    Route::delete('users/{username}', 'UsersController@delete')->name('.users.delete');
});

Route::post('ckeditor/images','CkeditorImageController@store')->name('ckeditor.image.store');

// freebie
Route::prefix('freebie')->name('freebie')->namespace('Freebie')->group(function () {
    Route::get('/stocksummary/{InfoCh}/{StockCode}', 'FreebieController@stocksummary')->name('.stockbasicinfo.stocksummary');
    Route::get('{InfoType}/Chart/{InfoCh}/{StockCode}', 'FreebieController@Chart')->name('.Chart');
    Route::get('{InfoType}/Table/{InfoCh}/{StockCode}', 'FreebieController@Table')->name('.Table');
    Route::get('{InfoType}/Report/{InfoCh}/{StockCode}', 'FreebieController@Report')->name('.Report');
    Route::get('{InfoType}/IPOSchedule/{InfoCh}', 'FreebieController@IPOSchedule')->name('.IPOSchedule');
});

// Tools
Route::prefix('Tools')->name('Tools')->namespace('Tools')->group(function () {
    Route::get('/bargain', 'ToolsController@bargain')->name('.bargain');
    Route::get('/buffett', 'ToolsController@buffett')->name('.buffett');
    Route::get('/buyCheckForm', 'ToolsController@buyCheckForm')->name('.buyCheckForm');
    Route::get('/Compound', 'ToolsController@Compound')->name('.Compound');
    Route::get('/deposit', 'ToolsController@deposit')->name('.deposit');
    Route::get('/estimate', 'ToolsController@estimate')->name('.estimate');
    Route::get('/gordon', 'ToolsController@gordon')->name('.gordon');
    Route::get('/interest', 'ToolsController@interest')->name('.interest');
    Route::get('/lowestRetire', 'ToolsController@lowestRetire')->name('.lowestRetire');
    Route::get('/money', 'ToolsController@money')->name('.money');
    Route::get('/npv', 'ToolsController@npv')->name('.npv');
    Route::get('/proportion', 'ToolsController@proportion')->name('.proportion');
    Route::get('/retire', 'ToolsController@retire')->name('.retire');
    Route::get('/PayBack', 'ToolsController@PayBack')->name('.PayBack');
    Route::get('/secondDCF', 'ToolsController@secondDCF')->name('.secondDCF');
    Route::get('/DepositTest', 'ToolsController@DepositTest')->name('.DepositTest');
    Route::get('/DepositInGroup', 'ToolsController@DepositInGroup')->name('.DepositInGroup');
});

// blog
Route::prefix('blogs')->namespace('Blogs')->group(function () {
    Route::get('/', 'ArchivesController@overview')->name('blogs');
    Route::get('create-archive', 'ArchivesController@create')->name('archives.create');
    Route::post('create-archive', 'ArchivesController@store')->name('archives.store');

    Route::get('{archive}', 'ArchivesController@show')->name('archives');
    Route::get('{archive}/edit', 'ArchivesController@edit')->name('archives.edit');
    Route::put('{archive}', 'ArchivesController@update')->name('archives.update');
    Route::delete('{archive}', 'ArchivesController@delete')->name('archives.delete');

    Route::get('tags/{tag}', 'CategoriesController@show')->name('blogs.tag');
});
