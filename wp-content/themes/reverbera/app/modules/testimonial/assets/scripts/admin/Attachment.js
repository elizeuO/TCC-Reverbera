class Attachment {
    constructor() {
        this.attachment = document.getElementById('js-item-attachment');
        this.addButton = document.getElementById('js-add-attachment');
        this.removeButton = document.getElementById('js-remove-attachment');

        this.eventsManager();
    }

    eventsManager() {
        document.addEventListener('DOMContentLoaded', () => {
            this.addAttachment();
            this.removeAttachment();
        });
    }

    addAttachment() {
        this.addButton.addEventListener('click', () => {

            if (this.fileFrame) {
                this.fileFrame.close();
            }

            this.fileFrame = wp.media.frames.file_frame = wp.media({
                title: 'Adicionar Imagem',
                button: {
                    text: 'Selecionar Imagem'
                },
                multiple: false
            });

            this.fileFrame.open();

            this.fileFrame.on('select', () => {
                let attachment = this.fileFrame.state().get('selection').toJSON()[0];

                this.attachment.querySelector('.js-attachment-id').value = attachment.id;
                this.attachment.querySelector('.js-attachment-src').setAttribute('src', attachment.url);

                if (this.removeButton.classList.contains('c__hidden')) {
                    this.removeButton.classList.remove('c__hidden');
                }
            });
        });

    }

    removeAttachment() {
        this.removeButton.addEventListener('click', () => {
            this.attachment.querySelector('.js-attachment-id').value = '';
            this.attachment.querySelector('.js-attachment-src').setAttribute('src', '');
            this.removeButton.classList.add('c__hidden');
        });
    }
}

new Attachment();