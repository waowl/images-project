
var container = $('.search__results');
$('#squery').on('input', function (e) {
    container.innerHTML = "";
    var query = e.target.value;
    if(!query){
        container.innerHTML = "";
        container.fadeOut();
        container.addClass('hidden');
        return;
    }

    var params = {
        'query': query
    };

    $.post('/user/search/user', params, data => {
       if(data.success){
           container.fadeIn();
           container.removeClass('hidden');
           appendToDOM(container, data.results);
           container.css('bottom', '-' + (container.innerHeight()+14) + 'px');
    } else {
           container.fadeIn();
           container.removeClass('hidden');
           container.html("<p class='no-result'>No results</p>");
           container.css('bottom', '-' + (container.innerHeight()+14) + 'px');

       }
    });

    function fillResults(data) {
        var nickname = data.nickname || data.id;
        var html = `
                <div class="avatar__container"><img src="${data.picture}"></div>
                <a class="results__item__link" href="/profile/${nickname}">
                        <div class="info__container">
                            <p class="info__container__name">${data.username}</p>
                            <p class="info__container__nickname">${data.nickname}</p>
                        </div>
                </a>
            `;
        return html;
    };

    function renderResults(data) {
         var fragment = document.createDocumentFragment();
        data.forEach(result => {
            let item = document.createElement('div');
            item.classList.add('search__results__item');
            item.innerHTML = fillResults(result);
            fragment.append(item);
        });
            return fragment;
    };

    function appendToDOM(el, data) {
        clearList(el);
        var  fragment = renderResults(data);
        el.append(fragment);
    };

    function clearList(el) {
        el.html("");
    }
});

