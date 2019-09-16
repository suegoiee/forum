$(function(){
    $('#thread_title').keypress(function(e){
        // invalid char:[ / ]
        let invalid_char = [47];
        if(invalid_char.indexOf(e.which) !== -1 ){
            $("#invalid_title_text").html(" 標題請勿輸入下列特殊字元: '/' ");
            return false;
        }
        else{
            $("#invalid_title_text").html(" 字數不可超過60字! ");
        }
    });
});