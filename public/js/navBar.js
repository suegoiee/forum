$(document).on('click', '.dropdownlist', function(e){
    $(".dropdown-content").css('display', 'none');
    $(this).children(".dropdown-content").css('display', 'block');
    e.stopPropagation();
});
  
$(document).on('click', '.menu', function(){
    $(".dropdown-content").css('display', 'none');
});
