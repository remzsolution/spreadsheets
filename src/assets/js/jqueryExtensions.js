$.expr[':'].name = $.expr.createPseudo(function (filterParam) {
    var name = filterParam;
    return function (element, content, isXml) {
        return $(element).is('[name=' + name + ']');
    }
});

$.expr[':'].numeric = $.expr.createPseudo(function () {
    return function (element, content, isXml) {
        return $.isNumeric($(element).text());
    }
});

$.expr[":"].containsIgnoreCase = $.expr.createPseudo(function (arg) {
    return function (elem) {
        if (arg === "") return true;

        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

