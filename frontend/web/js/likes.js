$(document).ready(function () {
    var like =  $('.like');
    var unlike =  $('.unlike');
    var icon = $(this).children('.icon');

    $(like).click(function () {
        var params = {
            'id' : $(this).attr('data-id'),
            '_csrf-frontend':  $(this).attr('data-token')
        };
        $.post('/post/default/like', params, data => {
            console.log($(this).children('.icon'));
            if (data.success) {
            $('.count').text(data.count);
            $(like).addClass("hidden");
            $(unlike).removeClass("hidden");
        }
    });
        return false;
    });

    $(unlike).click(function () {
        var params = {
            'id' : $(this).attr('data-id'),
            '_csrf-frontend':  $(this).attr('data-token')
        };
        $.post('/post/default/unlike', params, data => {
            if (data.success) {
            $('.count').text(data.count);
            $(unlike).addClass("hidden");
            $(like).removeClass("hidden");
        }
    });
        return false;
    });

});
