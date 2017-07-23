$('.panel.panel-default').fadeIn();

$("form").submit(function (event) {
    var username = $("input:name('username')").val();
    var password = $("input:name('password')").val();
    var isValid = validateCredentials(username, password);

    if (isValid) {
        $("div.login-info")
            .fadeOut('fast')
            .find('.panel-login')
                .each(function () {
                    $(this).text('');
                });

        $("form div.form-group")
            .removeClass('has-error')
            .addClass('has-success');

        return true;
    } else {
        $("div.login-info").fadeIn('slow')
            .find('.panel-login.text-danger')
                .text('Invalid username or password')
                .fadeIn('fast');

        $("form div.form-group")
            .removeClass('has-success')
            .addClass('has-error')
            .find('input:password').val('');

        return false;
    }
});

function validateCredentials(username, password) {
    // var usernameRegExp = /^[a-zA-Z0-9]{6,16}/;
    // var passwordRegExp = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    //
    // return usernameRegExp.test(username) && passwordRegExp.test(password);

    return true;
}
