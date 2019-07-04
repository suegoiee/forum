
    $(document).on('click', "#new_participant_button", function(){
        var new_participant = parseInt($("#number_of_new_participant").val());
        if(parseInt($("#new_participant_body tr:last").attr("value"))){
            var largest = parseInt($("#new_participant_body tr:last").attr("value"))+1;
        }
        else{
            var largest = 0;
        }
        for(var i = largest; i < largest + new_participant; i++){
            $("#new_participant_body").append('<tr value="'+i+'" id="new_participant'+i+'"><td><div class="form-group"><input name="participant_name[]" type="text" class="form-control w-small" placeholder="姓名" data-error="請輸入姓名" required="required"><div class="help-block with-errors pr-3"></div></div></td><td><div class="form-check"><input name="participant_gender['+i+']" class="form-check-input" type="radio" id="r'+i+'_male" value="male" checked><span class="form-check-label" for="r'+i+'_male">男</span></div><div class="form-check"><input name="participant_gender['+i+']" class="form-check-input" type="radio" id="r'+i+'_female" value="female"><span class="form-check-label" for="r'+i+'_female">女</span></div></td><td><div class="form-group"><input name="participant_department[]" type="text" class="form-control w-small" placeholder="組別"></div></td><td><div class="form-group"><input name="participant_email[]" type="email" class="form-control w-small" placeholder="Email" data-error="信箱格式錯誤" required="required"><div class="help-block with-errors pr-3"></div></div></td><td><div class="form-group"><i class="fas fa-times cancel_new_participant" value="new_participant'+i+'" style="cursor:pointer"></i></div></td></tr>');
        }
    });
    $(document).on('click', ".cancel_new_participant", function(){
        var new_participant_id = $(this).attr("value");
        $("#master_row"+new_participant_id).remove();
    });
    $(document).on('submit', "#permission_table", function(){
        $(".form-control").empty();
    });

    function searchPool(data, id, postName) {
        var availableTags = [];
        if(id == 'masterBar'){
            for (var i = 0; i < data.length; i++) {
                availableTags.push({
                    'id': data[i]['id'],
                    'value': data[i]['email']+' ('+data[i]['username']+')',
                    'name': data[i]['name'],
                });
            }
        }
        else if(id == 'categoryBar'){
            for (var i = 0; i < data.length; i++) {
                availableTags.push({
                    'id': data[i]['id'],
                    'value': data[i]['name'],
                });
            }
        }
        $("."+id).autocomplete({
            autoFocus: true,
            delay: 0,
            source: function (request, response) {
                var results = $.ui.autocomplete.filter(availableTags, request.term);
                response(results.slice(0, 5));
            },
            select: function (e, ui) {
                $("#"+$(this).parent().attr("value")).val(ui['item']['id']);
            }
        });
    }