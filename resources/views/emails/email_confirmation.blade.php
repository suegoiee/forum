@component('mail::message')
# 歡迎來到優分析論壇!

感謝您加入 [優分析論壇](http://www.uanalyze.com.tw)!

我們需要認證您的信箱來開通您的帳號，請點選下方按鈕完成認證:

@component('mail::button', ['url' => route('email.confirm', [$user->emailAddress(), $user->confirmationCode()])])
認證信箱
@endcomponent

再次感謝您對[優分析論壇](http://www.uanalyze.com.tw)的支持

{{ config('app.name') }}<br>
敬啟。
@endcomponent
