@if (session()->has('error'))
    <div class="alert alert-dismissible" style="background: rgba(255,255,255,0.9);border-left: 3px solid #ef3474;color: #393939 ;box-shadow: 2px 2px 2px 0px rgba(2%,2%,4%,0.12); margin-right: -15px;">
        <i class="fas fa-exclamation-circle" style="color: #ef3474;padding-right: 1%;"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #ef3474;">&times;</button>
        {!! session()->pull('error') !!}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-dismissible" style="background: rgba(255,255,255,0.9);border-left: 3px solid #4abf70;color: #393939;box-shadow: 2px 2px 2px 0px rgba(2%,2%,4%,0.12);">
        <i class="fas fa-check-circle" style="color: #4abf70;padding-right: 1%;"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #4abf70;">&times;</button>
        {!! session()->pull('success') !!}
    </div>
@endif
