class ThumbnailSelector {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => {
            this.container = document.getElementById('js-container');
            this.handleClick();
            this.onSubmit();
        });
    }

    initFileFrame() {
        this.fileFrame = wp.media.frames.file_frame = wp.media({
            title: 'Adicionar Imagem Destacada',
            button: {
                text: 'Selecionar Imagem'
            },
            multiple: false
        });
    }

    handleClick() {
        this.container.addEventListener('click', (ev) => {
            if (ev.target.classList.contains('js-add-attachment')) {
                this.addAttachment(ev.target.closest('.js-item-attachment'));
            } else if (ev.target.classList.contains('js-remove-attachment')) {
                this.removeAttachment(ev.target.closest('.js-item-attachment'));
            }
        });
    }

    addAttachment(itemAttachment) {
        if (this.fileFrame) {
            this.fileFrame.close();
        }

        this.initFileFrame();
        this.fileFrame.open();

        this.fileFrame.on('select', () => {
            let attachment = this.fileFrame.state().get('selection').toJSON()[0];
            let img = document.createElement('img');

            itemAttachment.querySelector('.js-attachment-id').value = attachment.id;
            img.setAttribute('src', attachment.url);
            img.style.width = '100%';
            img.style.marginBottom = '15px';

            itemAttachment.querySelector('.js-remove-attachment').style.display = 'inline-block';
            itemAttachment.querySelector('.js-attachment-img').innerHTML = '';
            itemAttachment.querySelector('.js-attachment-img').appendChild(img);
        });
    }

    onSubmit() {
        if (document.querySelector('[name="submit"]')) {
            document.querySelector('[name="submit"]').addEventListener('click', () => {
                let items = document.querySelectorAll('.js-item-attachment');

                items.forEach((item) => {
                    item.querySelector('.js-attachment-img').innerHTML = '';
                    item.querySelector('.js-remove-attachment').style.display = 'none';
                    item.querySelector('.js-attachment-id').value = '';
                });
            });
        }
    }

    removeAttachment(itemAttachment) {
        itemAttachment.querySelector('.js-attachment-img').innerHTML = '';
        itemAttachment.querySelector('.js-remove-attachment').style.display = 'none';
        itemAttachment.querySelector('.js-attachment-id').value = '';
    }
}

(new ThumbnailSelector());