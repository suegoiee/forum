<?php

// Home
Route::get('/', 'HomeController@show')->name('home');
Route::get('rules', 'HomeController@rules')->name('rules');
Route::get('terms', 'HomeController@terms')->name('terms');
Route::get('privacy', 'HomeController@privacy')->name('privacy');
Route::get('bin/{paste?}', 'HomeController@pastebin');

// Authentication
Route::namespace('Auth')->group(function () {
    // Sessions
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');
    Route::get('logout', 'LoginController@logout')->name('logout');

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
    Route::get('email-confirmation/{email_address}/{code}', 'EmailConfirmationController@confirm')
        ->name('email.confirm');

    // Social authentication
    Route::get('login/github', 'GithubController@redirectToProvider')->name('login.github');
    Route::get('auth/github', 'GithubController@handleProviderCallback');
});

// Users
Route::get('dashboard', 'DashboardController@show')->name('dashboard');
Route::get('user/{username}', 'ProfileController@show')->name('profile');
Route::get('avatar/{username}', 'ProfileController@avatar')->name('avatar');

// Settings
Route::get('settings', 'Settings\ProfileController@edit')->name('settings.profile');
Route::put('settings', 'Settings\ProfileController@update')->name('settings.profile.update');
Route::get('settings/password', 'Settings\PasswordController@edit')->name('settings.password');
Route::put('settings/password', 'Settings\PasswordController@update')->name('settings.password.update');

// Forum
Route::prefix('forum')->namespace('Forum')->group(function () {
    Route::get('/', 'ThreadsController@overview')->name('forum');
    Route::get('create-thread', 'ThreadsController@create')->name('threads.create');
    Route::post('create-thread', 'ThreadsController@store')->name('threads.store');

    Route::get('{thread}', 'ThreadsController@show')->name('thread');
    Route::get('{thread}/edit', 'ThreadsController@edit')->name('threads.edit');
    Route::put('{thread}', 'ThreadsController@update')->name('threads.update');
    Route::delete('{thread}', 'ThreadsController@delete')->name('threads.delete');
    Route::put('{thread}/mark-solution/{reply}', 'ThreadsController@markSolution')->name('threads.solution.mark');
    Route::put('{thread}/unmark-solution', 'ThreadsController@unmarkSolution')->name('threads.solution.unmark');
    Route::get('{thread}/subscribe', 'ThreadsController@subscribe')->name('threads.subscribe');
    Route::get('{thread}/unsubscribe', 'ThreadsController@unsubscribe')->name('threads.unsubscribe');

    Route::get('tags/{tag}', 'TagsController@show')->name('forum.tag');
});

// Replies
Route::post('replies', 'ReplyController@store')->name('replies.store');
Route::get('replies/{reply}/edit', 'ReplyController@edit')->name('replies.edit');
Route::put('replies/{reply}', 'ReplyController@update')->name('replies.update');
Route::delete('replies/{reply}', 'ReplyController@delete')->name('replies.delete');

// Subscriptions
Route::get('subscriptions/{subscription}/unsubscribe', 'SubscriptionController@unsubscribe')
    ->name('subscriptions.unsubscribe');

// Admin
Route::prefix('admin')->name('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::get('users/{username}', 'UsersController@show')->name('.users.show');
    Route::put('users/{username}/ban', 'UsersController@ban')->name('.users.ban');
    Route::put('users/{username}/unban', 'UsersController@unban')->name('.users.unban');
    Route::delete('users/{username}', 'UsersController@delete')->name('.users.delete');
});

// freebie
Route::prefix('freebie')->name('freebie')->namespace('Freebie')->group(function () {
    Route::get('/stocksummary', 'FreebieController@stocksummary')->name('.stockbasicinfo.stocksummary');
    Route::get('/InstitutionalInvestorsNet', 'FreebieController@InstitutionalInvestorsNet')->name('.InstitutionalInvestorsNet');
    Route::get('/HistoricalDividendRecord', 'FreebieController@HistoricalDividendRecord')->name('.HistoricalDividendRecord');
    Route::get('/MonthlyRevenue', 'FreebieController@MonthlyRevenue')->name('.MonthlyRevenue');
    Route::get('/MonthlyRevenueGrowthRate', 'FreebieController@MonthlyRevenueGrowthRate')->name('.MonthlyRevenueGrowthRate');
    Route::get('/ShortTermRevenueVSLongTermRevenue', 'FreebieController@ShortTermRevenueVSLongTermRevenue')->name('.ShortTermRevenueVSLongTermRevenue');
    Route::get('/BoardHoldingsVSStockPrice', 'FreebieController@BoardHoldingsVSStockPrice')->name('.BoardHoldingsVSStockPrice');
    Route::get('/QFIIHoldingsVSStockPrice', 'FreebieController@QFIIHoldingsVSStockPrice')->name('.QFIIHoldingsVSStockPrice');
    Route::get('/ShortInterestAsOfMarginPurchase', 'FreebieController@ShortInterestAsOfMarginPurchase')->name('.ShortInterestAsOfMarginPurchase');
    Route::get('/MarginBalanceVSMarginUtilization', 'FreebieController@MarginBalanceVSMarginUtilization')->name('.MarginBalanceVSMarginUtilization');
    Route::get('/MarginPurchaseIncrease', 'FreebieController@MarginPurchaseIncrease')->name('.MarginPurchaseIncrease');
    Route::get('/MonthlyRevenueVSStockPrice', 'FreebieController@MonthlyRevenueVSStockPrice')->name('.MonthlyRevenueVSStockPrice');
    Route::get('/CashDividendPayoutRatio', 'FreebieController@CashDividendPayoutRatio')->name('.CashDividendPayoutRatio');
    Route::get('/StockPriceVSYield', 'FreebieController@StockPriceVSYield')->name('.StockPriceVSYield');
    Route::get('/HistoricalPer', 'FreebieController@HistoricalPer')->name('.HistoricalPer');
    Route::get('/HistoricalPbr', 'FreebieController@HistoricalPbr')->name('.HistoricalPbr');
    Route::get('/ShortInterestIncrease', 'FreebieController@ShortInterestIncrease')->name('.ShortInterestIncrease');
    Route::get('/ShortInterestVSShortSellUtilization', 'FreebieController@ShortInterestVSShortSellUtilization')->name('.ShortInterestVSShortSellUtilization');
    Route::get('/StatementOfFinancialPosition', 'FreebieController@StatementOfFinancialPosition')->name('.StatementOfFinancialPosition');
    Route::get('/IncomeStatement', 'FreebieController@IncomeStatement')->name('.IncomeStatement');
    Route::get('/CashFlows', 'FreebieController@CashFlows')->name('.CashFlows');
});

// tools
Route::prefix('tools')->name('tools')->namespace('tools')->group(function () {
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