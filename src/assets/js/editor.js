var example1 = $('#document1').get(0);

var hot = new Handsontable(example1, {
    data: Handsontable.helper.createSpreadsheetData(25, 25),
    colHeaders: true,
    rowHeaders: true,
    contextMenu: true,
    manualColumnResize: true,
    manualRowResize: true,
    stretchH: 'all'
});