    document.getElementById('increaseSize').setAttribute('onClick','increaseFontSize()');
    document.getElementById('decreaseSize').setAttribute('onClick','decreaseFontSize()');

    function increaseFontSize() {
        let body = document.querySelector('body');
        let size = window.getComputedStyle(body).getPropertyValue('font-size');
        size = size.replace('px','');
        size++;
        document.body.style.fontSize = size + "px";
        document.body.style.lineHeight = size + "px";

    }

    function decreaseFontSize() {
        let body = document.querySelector('body');
        let size = window.getComputedStyle(body).getPropertyValue('font-size');
        size = size.replace('px','');
        size--;
        document.body.style.fontSize = size + "px";
        document.body.style.lineHeight = size + "px";
    }


