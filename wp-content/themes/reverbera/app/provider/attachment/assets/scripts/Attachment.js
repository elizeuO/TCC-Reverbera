class Attachment {
    constructor() {
        this.items = document.querySelectorAll('.jsImage');
    }

    registerEvents() {
        document.addEventListener('DOMContentLoaded', () => {
            this.handleActions();
        });
    }

    handleActions() {
        this.items.forEach((item) => {
            item.querySelector('.jsImageButton').addEventListener('click', () => {
                if ('' === item.querySelector('.jsImageID').value) {
                    this.addAttachment(item);
                } else {
                    this.removeAttachment(item);
                }
            });

            item.querySelector('.jsImageUrl').addEventListener('click', () => {
                this.addAttachment(item);
            });
        });
    }

    addAttachment(item) {
        if (this.fileFrame) {
            this.fileFrame.close();
        }

        this.fileFrame = wp.media.frames.file_frame = wp.media({
            title: 'Adicionar Foto',
            button: {
                text: 'Selecionar Foto'
            },
            multiple: false
        });

        this.fileFrame.open();

        this.fileFrame.on('select', () => {
            let attachment = this.fileFrame.state().get('selection').toJSON()[0];
            item.querySelector('.jsImageID').value = attachment.id;
            item.querySelector('.jsImageUrl').setAttribute('src', attachment.url);
            item.querySelector('.jsImageButton').innerHTML = 'Remover Imagem';

            let info = item.querySelector('.jsImageInfo');

            if (info.classList.contains('c_hidden')) {
                info.classList.remove('c_hidden');
            }
        });
    }

    removeAttachment(item) {
        item.querySelector('.jsImageID').value = '';
        item.querySelector('.jsImageUrl').setAttribute('src', '');
        item.querySelector('.jsImageButton').innerHTML = 'Adicionar Imagem';

        let info = item.querySelector('.jsImageInfo');

        if (!info.classList.contains('c_hidden')) {
            info.classList.add('c_hidden');
        }
    }
}

(new Attachment()).registerEvents();