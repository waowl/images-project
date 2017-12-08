$(document).ready(function () {
    var button = $('.menu__item_lang');
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    button.click(function (e) {
        e.preventDefault();
        console.log(button);
            var params = {
                'language' :  $(this).attr('data-lang'),
            };
            $.post('/site/language', params, function (data) {
                if(data.success){
                    location.reload();
                }

            });
            return false;
        });
});