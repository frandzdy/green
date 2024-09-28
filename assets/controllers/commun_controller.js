import {Controller} from '@hotwired/stimulus';
import {Modal} from 'bootstrap';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['container', 'modal', 'contactForm'];
    modal = null;

    connect() {
    }

    openModal(title, href, size) {
        const modal = Modal.getOrCreateInstance(this.modalTarget);
        $.get(href).done((response) => {
            if (title) {
                $(this.modalTarget).find('.modal-title').html(title);
            }
            if (size === true) {
                $(this.modalTarget).find('.modal-dialog').addClass('modal-lg')
            } else {
                $(this.modalTarget).find('.modal-dialog').removeClass('modal-lg')
            }
            $(this.modalTarget).find('.wrapper').html(response);
            this.handleModalForm(this.modalTarget)
            modal.show();
        }).fail((error) => {
            toastr.error("Une erreur est survenue.")
        });
    }

    modalOpen(event) {
        event.preventDefault()
        const item = $(event.currentTarget)
        const href = item.attr('href')
        const title = item.data('modal-title')
        const size = item.data('lg-size')
        this.openModal(title, href, size)
    }

    /**
     * Traitement des formulaires en modale
     * @param target
     */
    handleModalForm(target) {
        $(target).find('form').on('submit', (event) => {
            event.preventDefault();

            const data = new FormData($(event.currentTarget)[0]);
            const action = $(event.currentTarget).attr('action');

            this.handleAjaxForm(target, data, action);
        });
    };

    handleAjaxForm(target, data, action) {
        try {
            let $btn = $('#submit-btn');
            $btn
                .html(
                    '<img style="width: 50px;" src="' + $btn.data('loading-img') + '" alt="Envoi en cours"> Envoi en cours'
                )
                .attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: action,
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: (response) => {
                    if (response.template) {
                        $(target).html($(response.template));
                    }

                    if (response.error) {
                        toastr.error(response.error);
                        $btn.html($btn.data('title')).removeAttr('disabled');
                        return false;
                    }

                    if (!response.success) {
                        if ($(target).hasClass('modal')) {
                            $(target).find('.wrapper').html($(response));
                            this.handleModalForm(target);
                        } else if (!response.template) {
                            $(target).html($(response));
                        }
                        $btn.html($btn.data('title')).removeAttr('disabled');
                        return false;
                    }

                    if (response.success && response.redirectUrl) {
                        if (response.message) {
                            toastr.success(response.message);
                        }
                        if (response.reload) {
                            window.location.reload()
                        }
                        Turbo.visit(response.redirectUrl, {action: "replace"});
                        return false;
                    }

                    if (response.success && response.callback) {
                        if (response.callbackData) {
                            window[response.callback](response.callbackData)
                        } else {
                            window[response.callback]();
                        }
                        const modal = Modal.getOrCreateInstance(this.modalTarget);
                        modal.hide();
                    }

                    if (response.message) {
                        toastr.success(response.message);
                        $btn.html($btn.data('title')).removeAttr('disabled');
                    }
                },
                error: (response) => {
                    if (response.status === 422) {
                        if ($(target).hasClass('modal')) {
                            $(target).find('.wrapper').html(response.responseText);
                            this.handleModalForm(target);
                        } else if (!response.template) {
                            $(target).html($(response));
                        }
                        $btn.html($btn.data('title')).removeAttr('disabled');
                    } else {
                        $btn.html($btn.data('title')).removeAttr('disabled');
                        toastr.error("Une erreur est survenue.");
                    }
                }
            });
        } catch (e) {
            $btn.html($btn.data('title')).removeAttr('disabled');
            toastr.error("Une erreur est survenue.");
        }
    }
}
