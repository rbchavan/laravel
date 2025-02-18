import $ from 'jquery';

$(document).ready(function () {

    window.toggleCreateForm = function () {
        $('#createUserForm').toggleClass('hidden');
    };



    $('#userForm').on('submit', function (e) {
        e.preventDefault();


        $('#nameError, #emailError, #passwordError, #passwordConfirmationError').text('');


        $.ajax({
            url: '/user/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                
                location.reload();
            },
            error: function (xhr) {
                if (xhr.responseJSON?.errors) {
                    const errors = xhr.responseJSON.errors;
                    if (errors.name) $('#nameError').text(errors.name[0]);
                    if (errors.email) $('#emailError').text(errors.email[0]);
                    if (errors.password) $('#passwordError').text(errors.password[0]);
                    if (errors.password_confirmation) $('#passwordConfirmationError').text(errors.password_confirmation[0]);
                }
            }
        });
    });
});