$('.action__edit').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.attr('data-id');
        var form = $('#comment_form');
        var text =  $this.parent().parent().find('.comment__body').text();
        var input = form.find('.leave__comment');

         form.attr('action', '/comment/edit/'+id);
         input.val(text);
         input.css('border', '2px solid green');
        console.log(text);

    }
);
