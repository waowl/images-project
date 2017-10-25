$('.comment').click(function (e) {
        var $this = $(this);
        var text;
        if (e.target.classList.contains('edit')) {
            text = $this.find('.comment-body').text();

            var edit = $('.edit-form');
            var id = $this.attr('data-id');
            var form = edit.find("form");
            var action = form.attr("action");
            form.attr('action', action + id);
            console.log(id);
            $("[name='comment']").val(text);
            edit.insertAfter($this);
        }
    }
);
