class BlockUIController {
    block(node) {
        if (!this.isBlocked(node)) {
            let overlay = document.createElement('div');
            overlay.classList.add('blockOverlay', 'js-block-element');
            overlay.style.width = node.offsetWidth + "px";
            overlay.style.height = node.offsetHeight + "px";

            node.classList.add('processing');
            node.prepend(overlay);
        }
    }

    unblock(node) {

        if (!this.isBlocked(node)) {
            return false;
        }

        node.classList.remove('processing');
        node.querySelector('.js-block-element').remove();
    }

    isBlocked(node) {
        return node.classList.contains('processing');
    }
}