$.expr[':'].name = $.expr.createPseudo(function (filterParam) {
    var name = filterParam;
    return function (element, content, isXml) {
        return $(element).is('[name=' + name + ']');
    }
});

