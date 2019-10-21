class FormController {
    constructor() {
        this.ajax = new XMLHttpRequest();
        this.blockUI = new BlockUIController();
        this.notificationElement = document.createElement('span');
    }

    eventsManager() {
        document.addEventListener('DOMContentLoaded', () => {
            this.registerEvents();
            this.handleClickInputFile();
        });
    }

    registerEvents() {
        let forms = document.querySelectorAll('.js-contact-form');

        if (undefined === forms) {
            return false;
        }

        forms.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                GoogleReCaptcha.insertToken(form).then(() => {
                    this.validate(form);
                });
            });
        });
    }

    validate(form) {
        let invalid = false;

        for (let field of form) {
            if ("" === field.value && ('hidden' !== field.type && 'submit' !== field.type)) {
                invalid = true;
                this.addWarning(field);
            } else if (("email" === field.type && !this.checkEmail(field.value)) || ("tel" === field.type && !this.validatePhone(field))) {
                invalid = true;
                this.addWarning(field)
            } else {
                if ('hidden' !== field.type && 'submit' !== field.type) {
                    this.removeWarning(field);
                }
            }
        }

        if (invalid) {
            this.setWarningMessage(form);
            return false;
        }

        this.deleteNotification(form);
        this.sendAjax(form);
    }

    sendAjax(form) {

        if (form.querySelector('.js-whatsapp')) {
            form.querySelector('.js-whatsapp').click();
        }

        this.blockUI.block(form);

        this.ajax.onreadystatechange = () => {
            if (this.ajax.readyState === XMLHttpRequest.DONE) {

                if (200 === this.ajax.status && this.ajax.responseText) {
                    for (let field of form) {
                        if ('submit' !== field.type && 'hidden' !== field.type) {
                            field.value = '';
                        }
                    }

                    if ('whatsapp' === this.ajax.responseText) {
                        this.blockUI.unblock(form);
                        return true;
                    }

                    this.setSuccessMessage(form);
                } else {
                    console.log(this.ajax.responseText);

                    this.setErrorMessage(form);
                }

                this.blockUI.unblock(form);
            }
        }
        ;

        this.ajax.open("POST", ajaxurl + "?action=sendContactForm", true);

        let formData = new FormData(form);
        formData.append('route', form.getAttribute('name'));

        this.ajax.send(formData);
    }

    checkEmail(email) {
        let check = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        return check.test(String(email).toLowerCase());
    }

    validatePhone(phone) {
        if ("" !== phone.value && phone.value.match(/\d/g).length >= 10) {
            return true;
        }
        return false;
    }

    removeWarning(field) {
        if ('file' === field.type && null !== field.closest('.js-file-container') && field.closest('.js-file-container').classList.contains('c__validate--warning')) {
            field.closest('.c-file-area').classList.remove('c__validate--warning');
            return true;
        } else if (!field.classList.contains('c__validate--warning')) {
            return false;
        }

        field.classList.remove('c__validate--warning')
    }

    addWarning(field) {
        if (field.classList.contains('c__validate--warning')) {
            return false;
        }

        if ('file' === field.type && null !== field.closest('.c-file-area')) {
            field.closest('.c-file-area').classList.add('c__validate--warning');
        } else {
            field.classList.add('c__validate--warning');
        }
    }

    setWarningMessage(form) {
        if (form.classList.contains('js-form-whatsapp')) {
            return false;
        }

        this.deleteNotification(form);

        let el = this.notificationElement.cloneNode(true);

        el.classList.add('js-warning', 'c__validate--warning', 'c__validate--message');
        el.innerText = 'Existem campos inválidos, verifique!';

        form.appendChild(el);
    }

    setErrorMessage(form) {
        if (form.classList.contains('js-form-whatsapp')) {
            return false;
        }

        this.deleteNotification(form);

        let el = this.notificationElement.cloneNode(true);

        el.classList.add('js-error', 'c__validate--error');
        el.innerText = 'Houve um erro ao enviar a Mensagem, tente novamente!';

        form.appendChild(el);
    }

    setSuccessMessage(form) {
        this.deleteNotification(form);

        let el = this.notificationElement.cloneNode(true);

        el.classList.add('js-success', 'c__validate--success');
        el.innerText = 'Agradecemos sua mensagem.';

        form.appendChild(el);
    }

    deleteNotification(form) {
        if (form.querySelector('.js-success')) {
            form.querySelector('.js-success').remove();
        }

        if (form.querySelector('.js-warning')) {
            form.querySelector('.js-warning').remove();
        }

        if (form.querySelector('.js-error')) {
            form.querySelector('.js-error').remove();
        }
    }

    handleClickInputFile() {
        document.addEventListener('click', (ev) => {
            if (!ev.target.classList.contains('js-input-file')) {
                return false;
            }

            if (ev.target.nextElementSibling.classList.contains('js-warning')) {
                ev.target.nextElementSibling.remove();
            }
        });
    }
}

(new FormController()).eventsManager();