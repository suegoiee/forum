@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" style="padding-right: 35px;width: 12%;float: right;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!! session()->pull('error') !!}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-dismissible" style="padding-right: 35px;width: 12%;float: right;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!! session()->pull('success') !!}
    </div>
@endif
