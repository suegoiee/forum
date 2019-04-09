function FBLogin(form){
	FB.login(function(response) {
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      FB.api('/me?fields=email,name', function(response) {
        $(form).find('input[name="email"]').val(response.email);
        $(form).find('input[name="password"]').val(response.id);
        $(form).find('input[name="username"]').val(response.name);
        $(form).submit();
      });
    } else {
    // The person is not logged into your app or we are unable to tell.
      console.log('Please log ' + 'into this app.');
    }
	}, {scope: 'public_profile,email'});
}
window.fbAsyncInit = function() {
    FB.init({
      appId      : '666419040444174',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.2' // The Graph API version to use for the call
    });
};
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));