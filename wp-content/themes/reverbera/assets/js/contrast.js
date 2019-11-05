//sets variable for contrast check

function checkContrast(href) {
    let currentValue = window.localStorage.getItem('contrast');
    let button = document.querySelector('.c__contrast-button');

    if (currentValue == 'on') {
        //adds a new stylesheet
        let link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = href;
        link.id = 'contrast';
        document.getElementsByTagName('head')[0].appendChild(link);

        //acessibility state
        button.setAttribute('title', 'Desligar alto contraste');
        button.setAttribute('aria-pressed', 'true');
    }

}

function toogleContrast(href) {
    let currentValue = window.localStorage.getItem('contrast');
    let button = document.querySelector('.c__contrast-button');

    if (currentValue == 'off') {
        //changes the value of local storage variable
        window.localStorage.setItem('contrast', 'on');

        let link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = href;
        link.id = 'contrast';
        document.getElementsByTagName('head')[0].appendChild(link);

        //acessibility state
        button.setAttribute('title', 'Desligar alto contraste');
        button.setAttribute('aria-pressed', 'true');

    } else if (currentValue == 'on') {
        window.localStorage.setItem('contrast', 'off');
        //acessibility state
        button.setAttribute('title', 'Ligar alto contraste');
        button.setAttribute('aria-pressed', 'false');

        //removes the stylesheet
        document.querySelector('#contrast').remove();
    }

}

