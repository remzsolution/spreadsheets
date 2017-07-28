$(function () {
    var startId = $('templates .spreadsheet').attr('id');
    if (startId) {
        openNewDocument(startId);
    }

    loadSpreadsheets($('div.table-responsive'));
});

function initializeTable(content, element) {
    var spreadsheetId = $(element).attr('id');
    console.log("New spreadsheet being initialized with id = ", spreadsheetId);

    var hot = new Handsontable(element, {
        data: [],
        rowHeaders: true,
        colHeaders: true,
        dropdownMenu: true,
        contextMenu: true,
        manualColumnResize: true,
        manualRowResize: true,
        stretchH: 'all',
        afterChange: function (change, source) {
            autoSaveDocument(spreadsheetId, change, source);
        },
        afterCreateCol: function (change) {
            saveDocumentStructure(spreadsheetId, 'createCol', change);
        },
        afterRemoveCol: function (change) {
            saveDocumentStructure(spreadsheetId, 'removeCol', change);
        },
        afterCreateRow: function (change) {
            saveDocumentStructure(spreadsheetId, 'createRow', change);
        },
        afterRemoveRow: function (change) {
            saveDocumentStructure(spreadsheetId, 'removeRow', change);
        }
    });

    hot.loadData(content.data);
    $(element).data('hot', hot);

    return hot;
}

function loadDocument(id, $container) {
    $.ajax({
        'url': '../index.php?getdoc=' + id,
        dataType: 'json',
        success: function (response) {
            var name = response.name;
            var content = response.content;

            $container.attr('id', id);
            initializeTable(content, $container[0]);

            var $newTab = $('<li><a href="#">' + name + '</a></li>');
            $('.tabbar > li').removeClass('active');
            $('.tabbar').append($newTab.addClass('active'));

            $('div.spreadsheet', '#document-container').hide();
            $container.show();

            console.log("New document loaded with id =", $container.attr('id'));
        }
    });
}

// New documents won't save
function autoSaveDocument(id, change, source) {
    if (source === 'loadData') {
        return; //don't save this change
    }

    $.ajax({
        url: '../index.php',
        type: 'POST',
        data: {
            'autosave': JSON.stringify({id: id, data: change})
        },
        success: function () {
            console.log('Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')');
        },
        error: function (data) {
            alert(data);
        }
    });

}

function saveDocumentStructure(id, event, change) {
    $.ajax({
        url: '../index.php',
        type: 'POST',
        data: {
            'updatestructure': JSON.stringify({id: id, event: event, change: change})
        },
        success: function () {
            console.log("Document structure successfully updated");
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function openNewDocument(id) {
    var $hotContainer = $('templates .spreadsheet').clone();
    loadDocument(id, $hotContainer);
    $('#document-container').append($hotContainer);
}

function closeDocument(id) {
    $('#' + id).remove();
    $('#document-container').children(':last-child').show();

    var $navPill = $('li.active');
    $navPill.parent().children().eq(-2).addClass('active');
    $navPill.remove();
}

function exitEditor() {
    window.location = "../index.php";
}

function loadSpreadsheets($container) {
    $.ajax({
        'url' : '../index.php?sheetsTable',
        type: 'GET',
        success: function(response) {
            console.log("Successfully loaded spreadsheets table");
            var $table = $(response);

            $table.find('tr')
            .hover(function () {
                $(this).css('cursor', 'pointer');
            }).click(function () {
                var $a = $(this).find('a');
                var id = $a.attr('href').split('=')[1];
                openNewDocument(id);
                $('#openFileModal').modal('toggle');
            });

            $table.find('a').click(function (event) {
                event.preventDefault()
            });

            $container.append($table);
        },
        error: function(data) {
            alert(data);
        }
    });
}

$('#open-button').on('click', function (event) {
    event.preventDefault();

    $('#openFileModal').modal('toggle');
});

$('#close-button').on('click', function (event) {
    event.preventDefault();
    var id = $('div:visible', '#document-container').attr('id');
    closeDocument(id);
});

$('#exit-button').on('click', function (event) {
    event.preventDefault();
    exitEditor();
});


$(document).on('click', '.tabbar > li > a', function (event) {
    var $closestLi = $(this).closest('li');
    var index = $closestLi.index();

    $('div.spreadsheet', '#document-container')
        .hide()
        .filter(':eq(' + index + ')')
        .show();

    $('.tabbar > li').removeClass('active');
    $closestLi.addClass('active');
});