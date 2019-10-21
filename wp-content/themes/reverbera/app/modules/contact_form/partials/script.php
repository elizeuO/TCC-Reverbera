<script>
    class GoogleReCaptcha {
        static insertToken(form) {
            if (undefined === form.elements['recaptcha']) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'recaptcha';
                form.appendChild(input);
            }

            return new Promise((resolve, reject) => {
                grecaptcha.execute('<?= get_option( 'siteKey' ) ?>', {action: 'contact'}).then((token) => {
                    form.elements['recaptcha'].value = token;
                    resolve();
                });
            });
        }
    }
</script>