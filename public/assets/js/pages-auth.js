/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Username harus diisi'
              },
              stringLength: {
                min: 6,
                message: 'Username harus lebih dari 6 karakter'
              }
            }
          },
          name: {
            validators: {
              notEmpty: {
                message: 'Nama harus diisi'
              },
              stringLength: {
                min: 6,
                message: 'Username harus lebih dari 6 karakter'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Email harus diisi'
              },
              emailAddress: {
                message: 'Alamat email tidak valid'
              }
            }
          },
          'email-username': {
            validators: {
              notEmpty: {
                message: 'Email / username harus diisi'
              },
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Password harus diisi'
              },
              stringLength: {
                min: 6,
                message: 'Password harus lebih dari 6 karakter'
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'Password harus diisi'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'Konfirmasi password tidak sama'
              },
              stringLength: {
                min: 6,
                message: 'Password harus lebih dari 6 karakter'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree terms & conditions'
              }
            }
          },
          nama_alias: {
            validators: {
              notEmpty: {
                message: 'Nama panggilan harus diisi'
              },
            }
          },
          no_telp: {
            validators: {
              notEmpty: {
                message: 'Nomor Whatsapps harus diisi'
              },
            }
          },
          jekel: {
            validators: {
              notEmpty: {
                message: 'Jenis kelamin harus dipilih'
              },
            }
          },
          tanggal_lahir: {
            validators: {
              notEmpty: {
                message: 'Tanggal lahir harus diisi'
              },
            }
          },
          provinsi: {
            validators: {
              notEmpty: {
                message: 'Provinsi harus diisi'
              },
            }
          },
          kab_kota: {
            validators: {
              notEmpty: {
                message: 'Kab / Kota harus dipilih'
              },
            }
          },
          alamat_lengkap: {
            validators: {
              notEmpty: {
                message: 'Alamat harus diisi'
              },
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-5'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),

          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});
