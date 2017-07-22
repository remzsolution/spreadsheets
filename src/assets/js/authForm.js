$('.panel.panel-default').fadeIn(1000);

$('form').submit(function (event) {
    event.preventDefault();
});

$("input:button").on('click', function (event) {
    event.preventDefault();

    var username = $("input[name='username']").val();
    var password = $("input[type='password']").val();

    var isValid = validateCredentials(username, password);

    if (isValid) {
        asyncLogin(username, password);
    } else {
        invalidateCredentials();
    }
});

function asyncLogin(username, password) {

    $.ajax("../index.php", {
        //TODO: JQuery in action AJAX chapter.
    });
}

function validateCredentials(username, password) {
    var usernameRegExp = /^[a-zA-Z0-9]{6, 16}$/;
    var passwordRegExp = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;

    return username.match(usernameRegExp) && password.match(passwordRegExp);
}

function invalidateCredentials() {
    $(".panel-login")
        .text('Invalid username or password')
        .closest('div').fadeToggle();

    $("form div.form-group").each(function () {
        var $this = $(this);
        $this
            .toggleClass('has-error')
            .closest('input:password').val('');
    });
}