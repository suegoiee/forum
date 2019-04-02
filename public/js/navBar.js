if($(window).width() <= 768){
    $(document).on('click', '.dropdownlist', function(e){
        $(".dropdown-content").css('display', 'none');
        $(this).children(".dropdown-content").css('display', 'block');
        e.stopPropagation();
    });
}
else{
    $('.dropdownlist').mouseover(function(){
        $(".dropdown-content").hide();
        $(this).children(".dropdown-content").show();
    });
    $('.dropdownlist').mouseleave(function(){
        $(".dropdown-content").hide();
    });
}
    
$(document).on('click', '.menu', function(){
    $(".dropdown-content").css('display', 'none');
});