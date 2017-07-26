$.ajax({
    url: '../index.php?sheetsTable',
    success: function (response) {
        $(response).hide().appendTo($('.table-responsive'));
        var $table = $('.table');
        var $pagination = $('.pagination');

        var numPages = +$table.data('pages');

        for (var i = 1; i <= numPages; i++) {
            var $item = $('<li><a href="#">' + +i + '</a></li>');
            $pagination.children(':last-child').before($item);
        }

        $pagination.find('li:contains(' + $table.data('active-page') + ')').toggleClass('active');

        $table.find('tbody tr').each(function (index, element) {
            updateVisibilityByPage(index, element, $table.data('active-page'));
        });

        $table.fadeIn();
    },
    error: function (data) {
        console.log(data);
    }
});


$("#search-bar").on('input', function () {
    var input = $.trim($(this).val().replace(/\s+/g, " ").toUpperCase());

    $('tbody tr').each(function (index, element) {
        if ($(element).text().toUpperCase().indexOf(input.toUpperCase()) >= 0) {
            $(element).removeClass('hidden');
        } else {
            $(element).addClass('hidden');
        }
    });
});

function updateVisibilityByPage(index, element, pageNumber) {
    var $element = $(element);
    if (+$element.data('page') === +pageNumber) {
        $element.removeClass('hidden');
    } else {
        if (!$element.is('.hidden')) {
            $element.addClass('hidden');
        }
    }
}

$(document).on('click', 'a:numeric', function (event) {
    event.preventDefault();
    $('ul.pagination li.active').removeClass('active');

    $(this).closest('li').addClass('active');

    var $table = $('.table');


    $table
        .data('active-page', $(this).text())
        .find('tbody tr').each(function (index, element) {
        updateVisibilityByPage(index, element, $table.data('active-page'));
    });
});

// TODO
// $('.pagination a:not(:numeric)').on('click', function (event) {
//     event.preventDefault();
//
//     var $table = $('.table'),
//         currentPage = $table.data('active-page'),
//         targetPage;
//
//     if ($(this).is(':first-child')) {
//         targetPage = currentPage - 1;
//     } else {
//         targetPage = currentPage + 1;
//     }
//
//     if (targetPage <= 0) {
//         targetPage = 1;
//     } else if ()
//
//     $('a:')
//
// });

