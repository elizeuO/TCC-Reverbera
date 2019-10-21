class GalleryController {
    constructor() {
        this.fileFrame = null;
    }

    run() {
        document.addEventListener('DOMContentLoaded', () => {
            this.registerEventsToGallery();
        });
    }

    setFileFrame(title = 'Adicionar', buttonText = 'Selecionar', multiple = true) {
        return wp.media.frames.file_frame = wp.media({
            title: title,
            button: {
                text: buttonText
            },
            multiple: multiple
        });
    }

    addItems(addItemsButton) {
        addItemsButton.addEventListener('click', () => {
            this.fileFrame = this.setFileFrame();

            this.fileFrame.open();

            this.fileFrame.on('select', () => {
                let parent = addItemsButton.closest('.js-gallery');
                let container = parent.querySelector('.js-gallery-container');
                let index = container.getElementsByClassName('js-gallery-item').length;
                let selection = this.fileFrame.state().get('selection');

                selection.map((attachment) => {
                    let element = parent.querySelector('.js-gallery-item-clone').cloneNode(true);
                    attachment = attachment.toJSON();

                    if (container.querySelector("input[value='" + attachment.id + "']")) {
                        return false;
                    }

                    let data = {
                        id: attachment.id,
                        imageUrl: this.getImageUrl(attachment, parent)
                    };

                    this.setNames(element, parent.getAttribute('data-meta-key'), index);
                    this.setValues(element, data);
                    this.registerEventsToItem(element);

                    element.classList.remove('c__hidden', 'js-gallery-item-clone');

                    container.appendChild(element);

                    index++;
                });
            });
        });
    }

    changeItem(item) {
        item.querySelector('.js-gallery-item-change').addEventListener('click', () => {
            let parent = item.closest('.js-gallery');

            if (this.fileFrame) {
                this.fileFrame.close();
            }

            this.fileFrame = this.setFileFrame('Alterar Imagem', 'Selecionar', false);

            this.fileFrame.on('select', () => {
                let attachment = this.fileFrame.state().get('selection').first().toJSON();
                let data = {
                    id: attachment.id,
                    imageUrl: this.getImageUrl(attachment, parent)
                };

                this.setValues(item, data);
            });

            this.fileFrame.open();
        });
    }

    deleteItem(item) {
        item.querySelector('.js-gallery-item-delete').addEventListener('click', () => {
            let container = item.closest('.js-gallery-container');
            item.remove();
            this.resetIndex(container);
        });
    }

    registerSortableEvent(containerItems) {
        jQuery(containerItems).sortable({
            opacity: 0.6
        });
    }

    setNames(element, metaKey, index) {
        element.querySelector('.js-gallery-item-id').name = metaKey + '[' + index + '][id]';
    }

    /**
     * @param element is a new attachment
     * @param data is a literal object
     * */
    setValues(element, data = {}) {
        element.querySelector('.js-gallery-item-id').value = data.id;
        element.querySelector('.js-gallery-item-image-url').setAttribute('style', 'background: url(' + data.imageUrl + ') no-repeat center center; -webkit-background-size: cover; background-size: cover;');
    }


    resetIndex(container) {
        let parent = container.closest('.js-parent');
        container.querySelectorAll('.js-item').forEach((element, index) => {
            this.setNames(element, parent.getAttribute('data-meta-key'), index);
        });
    }

    getImageUrl(attachment, parent) {
        let galleryIcon = parent.querySelector('.js-gallery-icon');

        switch (attachment.subtype) {
            case "vnd.openxmlformats-officedocument.wordprocessingml.document":
                return galleryIcon.getAttribute('data-icon-doc');
            case "pdf":
                return galleryIcon.getAttribute('data-icon-pdf');
            case "zip":
                return galleryIcon.getAttribute('data-icon-zip');
            case "vnd.ms-powerpoint":
                return galleryIcon.getAttribute('data-icon-ppt');
            case "vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                return galleryIcon.getAttribute('data-icon-xls');
            case "png":
            case "jpeg":
            case "gif":
                return attachment.sizes.full.url;
            default:
                return galleryIcon.getAttribute('data-icon-default');
        }
    }

    registerEventsToItem(item) {
        this.changeItem(item);
        this.deleteItem(item);
    }

    registerEventsToGallery() {
        document.querySelectorAll('.js-gallery').forEach((gallery) => {
            let containerItems = gallery.querySelector('.js-gallery-container');
            let addItemsButton = gallery.querySelector('.js-add-gallery-items');

            this.addItems(addItemsButton);
            this.registerSortableEvent(containerItems);

            containerItems.querySelectorAll('.js-gallery-item').forEach((item) => {
                this.registerEventsToItem(item);
            });
        });
    }
}

(new GalleryController()).run();