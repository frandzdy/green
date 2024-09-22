import {Controller} from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['contactForm']

    checkRecaptcha(event) {
        event.preventDefault();
        grecaptcha.ready(() => {
            grecaptcha.execute(ggRecaptchaPkey, {action: 'submit'}).then((token) => {
                let $btn = $('input[type="submit"]');
                $btn
                    .attr('disabled', 'disabled');
                alert('sez' + token)
                // Add your logic to submit to your backend server here.
                $.post(
                    Routing.generate('front_recaptcha_check', {'token': token})
                ).done(async (data) => {
                    if (data.response) {
                        const $form = $(this.contactFormTarget);
                        $form.submit();
                    } else {
                        $btn.html('Envoyer').removeAttr('disabled');
                        toastr.error("Vous avez été identifié comme robot; si ce n'est pas le cas, veuillez réessayer.");
                    }
                });
            });
        });
    }
}