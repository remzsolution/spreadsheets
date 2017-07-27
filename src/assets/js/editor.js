$(function(){
    var $hotContainer = $('templates .spreadsheet');
    var id = $hotContainer.attr('id');

    if (id) {
        loadDocument(id, $hotContainer);
        $('body > .container-fluid').append($hotContainer);
    } else {
        alert("No ID");
    }
});

function initializeTable(content, element) {
    var hot = new Handsontable(element, {
        data: content.data,
        rowHeaders: true,
        colHeaders: true,
        dropdownMenu: true,
        contextMenu: true,
        manualColumnResize: true,
        manualRowResize: true,
        stretchH: 'all'
    });

    return hot;
}

function loadDocument(id, $container) {
    $.ajax({
        'url': '../index.php?getdoc=' + id,
        dataType: 'json',
        success: function(response) {
            var name = response.name;
            var content = response.content;

            var hot = initializeTable(content, $container[0]);
            $container.data('hot', hot);

            var $newTab = $('<li><a href="#">' + name + '</a></li>');

            var $tabBar = $('.tabbar');
            if ( !$tabBar.is(':has(li)')) {
                $newTab.addClass('active');
            }

            $tabBar.append($newTab);
        }
    });
}



