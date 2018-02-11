$(document).ready(function () {
    //change text
    $('.task_edit').on('click',function () {
       var id = $(this).attr('data-id');
       var content = $('.task_content[data-id="'+id+'"]')[0].innerHTML;
       var container  = $('.task_content[data-id="'+id+'"]');
       var button = $(this);

       $(this).css('display','none');

       container[0].innerHTML = '<textarea id="area_container" style="width: 600px;height:170px">'+content+'</textarea><button id="change">Изменить</button>';

        $('#change').on('click',function() {
            $.ajax({
                url:'/tasks/content',
                method: 'post',
                data: {
                    id: id,
                    content: $('#area_container').val()
                },
                success:function (data) {
                    if(data.hasOwnProperty('error')){
                        button.parentNode.append('<div style="color: red;">'+data.error+'</div>');
                    }
                    else {
                        container[0].innerHTML = data.content;
                        button.css('display','block');
                    }
                }
            });
        });

        $('#area_container').click(function(event){
            event.stopPropagation();
        });
    });




    //change status
    $('.task_status').on('click',function (e) {
        var img = $(this).children();
        var id = img.attr('data-id');


        if(img.attr('src')=='/web/static/img/unchecked_box.png')
            var status = 1;
        else
            var status = 0;

        $.ajax({
            url:'/tasks/status',
            method: 'post',
            data: {
                id: id,
                status: status
            },
            success:function (data) {
                if(status==1)
                    img.attr('src','/web/static/img/checked_box.png');
                else
                    img.attr('src','/web/static/img/unchecked_box.png');
            }
        })
    });


    //sort
    $('.sort').on('change',function (e) {
        if($('.sort').val()=='id')
            window.location.href = '/';
        else
            window.location.href = '/?sort='+$('.sort').val();
    });
    
    //preview task
    $('#preview_button').on('click',function (e) {

        if($("#create_post input[name='name']").val().length>0
            &&$("#create_post textarea[name='content']").val().length>0
            &&$("#create_post input[name='email']").val().length>0){


            $('#preview').append('<div class="post_author">' +
                '<img style="max-height: 240px;max-width: 320px">'+
                '                   <h3>'+$("#create_post input[name='name']").val()+'</h3>' +
                '                   <h4>'+$("#create_post input[name='email']").val()+'</h4>' +
                '                   <p>' +
                '                       '+$("#create_post textarea[name='content']").val() +
                '                   </p>' +
                '               </div>');


            if($("#image").val().length>0) {
                $("#image").change(function (e) {
                    var file, reader;
                    file = e.target.files[0];
                    reader = new FileReader();
                    reader.onload = function (e) {
                        var image;
                        image = new Image();
                        image.src = e.target.result;
                        return image.onload = function () {
                            return $("#preview img").attr('src', this.src);
                        };
                    };
                    return reader.readAsDataURL(file);
                    e.preventDefault();
                });
                $("#image").trigger('change');
            }

        }
        else
            $('#preview_error')[0].innerHTML = '<h1 style="color:red">Пожалуйста заполните форму полностью!</h1>';
    });


    //login
    $('#login').submit(function (e) {
        $.ajax({
            url:'/users/login',
            method: 'post',
            data: {
                name: $('#login input[name="name"]').val(),
                password: $('#login input[name="password"]').val(),
                token: $('#login input[name="token"]').val(),
            },
            success:function (data) {
                $('.login_errors').empty();
                if(!data.hasOwnProperty('error')){
                   window.location.reload();
                }
                else {
                    $('.login_errors').append(data.error);
                }
            }
        })
    });




    //modal login
    $('.login').on('click',function (e) {
        $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
            function () { // пoсле выпoлнения предъидущей aнимaции
                $('#overlay').css('display', 'block')
                    .animate({opacity: 0.8}, 200);
                $('#login_modal')
                    .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                    .animate({opacity: 1, top: '50%'}, 200)
            }); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз

        e.preventDefault();
    });
    $('#login_close').click( function(){ // лoвим клик пo крестику или пoдлoжке
        $('#login_modal')
            .animate({opacity: 0}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                }
            );
        $('#overlay')
            .animate({opacity: 0}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                }
            );
    });
    $('#overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
        $('#login_modal')
            .animate({opacity: 0}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                }
            );
        $('#overlay')
            .animate({opacity: 0}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                }
            );
    });
});