const increaseSizeButton = '#increaseSize';
const decreaseSizeButton = '#decreaseSize';

document.addEventListener('click', (ev) => {
    if (null !== ev.target.closest(increaseSizeButton)) {
        increaseFontSize();
    } else if (null !== ev.target.closest(decreaseSizeButton)) {
        decreaseFontSize();
    } else {
        return;
    }
});

document.addEventListener('keyup', (ev) => {
    if ('Enter' !== ev.key) {
        return;
    } else {
        if (null !== ev.target.closest(increaseSizeButton)) {
            increaseFontSize();
        } else if (null !== ev.target.closest(decreaseSizeButton)) {
            decreaseFontSize();
        } else {
            return;
        }
    }

});

function increaseFontSize() {
    let body = document.querySelector('body');
    let size = window.getComputedStyle(body).getPropertyValue('font-size');
    size = size.replace('px', '');
    size++;
    document.body.style.fontSize = size + "px";
    document.body.style.lineHeight = size + "px";

}

function decreaseFontSize() {
    let body = document.querySelector('body');
    let size = window.getComputedStyle(body).getPropertyValue('font-size');
    size = size.replace('px', '');
    size--;
    document.body.style.fontSize = size + "px";
    document.body.style.lineHeight = size + "px";
}


