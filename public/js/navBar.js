$(document).on('click', '.dropdownlist', function(e){
    $(".dropdown-content").css('display', 'none');
    $(this).children(".dropdown-content").css('display', 'block');
    e.stopPropagation();
});
