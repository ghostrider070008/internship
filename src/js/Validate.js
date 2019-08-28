import 'jquery-validation';

export class Validate {
  constructor($validate) {
    this.$validate = $validate;

    this.init();
  }

  init() {
    this.$validate.validate({
      highlight: function(element) {
        $(element)
          .closest('.form-group')
          .addClass('has-danger');
        $(element).addClass('form-control-danger');
      },
      unhighlight: function(element) {
        $(element)
          .closest('.form-group')
          .removeClass('has-danger')
          .addClass('has-success');
        $(element)
          .removeClass('form-control-danger')
          .addClass('form-control-success');
      },
      rules: {
        name: {
          required: true,
          rangelength: [2, 20]
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          digits: true
        },
        message: {
          required: true,
          maxlength: 255
        }
      },
      messages: {
        name: {
          required: 'This field is required.',
          rangelength: 'This field must contain between 2 and 20 characters.'
        },
        email: {
          required: 'This field is required.',
          email: 'Please enter a valid email.'
        },
        phone: {
          required: 'This field is required.',
          digits: 'Please enter a valid phone number.'
        },
        message: {
          required: 'This field is required.',
          maxlength: "This field can't have more than 255 characters."
        }
      },
      errorElement: 'p',
      errorPlacement: function(error, element) {
        error.appendTo(
          $(element)
            .closest('.form-group')
            .find('.error-msg')
        );
      }
    });
  }
}
