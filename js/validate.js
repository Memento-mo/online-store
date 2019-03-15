$(document).ready(function() {
  $('#form_reg').validate (
    {
      rules: {
        "login": {
          required: true,
          minlength: 5,
          maxlength: 15,
          remove: {
            type: "post",
            url: "../reg/check_login.php"
          }
        },
        "password": {
          required: true,
          minlength: 7,
          maxlength: 15,
        },
        "last": {
          required: true,
          minlength: 3,
          maxlength: 15,
        },
        "first": {
          required: true,
          minlength: 3,
          maxlength: 15,
        },
        "patronymic": {
          required: true,
          minlength: 3,
          maxlength: 25,
        },
        "email": {
          required: true,
          email: true
        },
        "phone": {
          required: true
        },
        "address": {
          required: true
        }
      },

      messages: {
        "loging": {
          required: "Укажите логин!",
          minlength: "От 5 до 15 символов!",
          maxlength: "От 5 до 15 символов!",
          remote: "Логин занят"
        },
        "password": {
          required: "Укажите пароль!",
          minlength: "От 7 до 15 символов!",
          maxlength: "От 7 до 15 символов!"
        },
        "surname": {
          required: "Укажите вашу фамилию!",
          minlength: "От 3 до 20 символов!",
          maxlength: "От 3 до 20 символов!",
        }
      }
    }
  )
})