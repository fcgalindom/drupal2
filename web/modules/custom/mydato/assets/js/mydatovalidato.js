

// Wait for the DOM to be ready
jQuery(function () {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    jQuery("#mydato-form").validate({
      // Specify validation rules
      rules: {

        id: {
            required: true,
            // namestring: true ,
          },
        primer_nombre: {
          required: true,
          // namestring: true ,
        },

        segundo_nombre: {
           // required: true,
            // namestring: true ,
          },
        primer_apellido:{
            required: true,
        } ,
        segundo_apellido:{
            required: true,
        } ,
  
  
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
  
        email: {
          required: true,
          // Specify that email should be validated
          emailDomainRestriction: true,// by the built-in "email" rule
          email: true,
          emailname: true
        },
        telefono: {
          required: true,
          digits: true,
  
          minlength: 10,
          maxlength: 10,
        },
        terminos: {
          required: true,
        }
  
  
      },
      // Specify validation error messages
      messages: {

        id: {
            required: "Por favor ingrese un identificacion válido.",
            digits: 'Por favor ingrese solo números.',
    
            minlength: "La identificacion debe tener 10 caracteres.",
            maxlength: "El teléfono debe tener 10 caracteres.",
          }
          ,
        primer_nombre: {
          required: "Este campo es obligatorio.",
          // namestring : "Ingrese sólo letras o espacios"
        },
        primer_apellido:{
            required: "Este campo es obligatorio.",
            // namestring : "Ingrese sólo letras o espacios"
          },
          segundo_apellido:{
            required: "Este campo es obligatorio.",
            // namestring : "Ingrese sólo letras o espacios"
          },
        email: {
          required: "Por favor ingrese un email válido.",
          emailDomainRestriction: "El dominio de correo no esta permitido."
        },
        telefono: {
          required: "Por favor ingrese un teléfono válido.",
          digits: 'Por favor ingrese solo números.',
  
          minlength: "El teléfono debe tener 10 caracteres.",
          maxlength: "El teléfono debe tener 10 caracteres.",
        }
        ,
        terminos: {
          required: "Debe aceptar términos y condiciones y políticas de protección de datos personales.",
        },
  
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function (form) {
        form.submit();
      }
    });
  });
  
  
  
  