@include('layouts._ads._footer')
@include('layouts._sponsors')

<div id="footer" class="container text-center" style="font-size: 12.5px;height: 40px; width: 100%; padding-top: 10px; color:#545454;">
    <div>
        <a class="footerWord" style="cursor: pointer;" data-toggle="modal" data-target="#rule">網站規則</a>
            @include('_partials._rule_modal')
        <span style="margin-left: 5px; margin-right:5px;">｜</span>
        <a class="footerWord" style="cursor: pointer;" data-toggle="modal" data-target="#term">免責聲明</a>
            @include('_partials._term_modal')
        <span style="margin-left: 5px; margin-right:5px;">｜</span>
        <a class="footerWord" style="cursor: pointer;" data-toggle="modal" data-target="#privacy">隱私權政策</a>
            @include('_partials._privacy_modal')
        <span style="margin-left: 5px; margin-right:5px;">｜</span>
        <a class="footerWord" href="https://www.facebook.com/UAnalyze" aria-label="uanalyze facebook"><i class="fab fa-facebook-f"></i>
        <span style="margin-left: 5px; margin-right:5px;">｜</span>
        <a class="footerWord" href="mailto:service@uanalyze.com.tw" aria-label="uanalyze email"><i class="far fa-envelope"></i></a> 
        <span style="margin-left: 5px; margin-right:5px;">｜</span>
        <a class="footerWord" href="tel:+886-2-2747-3447" aria-label="uanalyze telephone"><i class="fas fa-phone"></i></a>
    </div>
    <div>
        優分析 UAnalyze 商拓財經有限公司 © 2018
    </div>    
</div>
