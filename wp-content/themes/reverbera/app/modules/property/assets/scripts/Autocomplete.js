class Autocomplete {
    constructor() {
        this.registerStyles();
        this.handleCloseDropdown();
    }

    search() {
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.js-autocomplete').forEach((input) => {
                this.createDropdown(input);
                let dropdown = input.nextElementSibling;

                input.addEventListener('keyup', () => {
                    this.showDropdown(dropdown, input)
                });

                input.addEventListener('click', () => {
                    this.showDropdown(dropdown, input)
                })
            });
        });
    }

    showDropdown(dropdown, input) {
        let closeDropdown = true;

        dropdown.querySelectorAll('p').forEach((element) => {
            if (-1 === element.innerText.toLowerCase().indexOf(input.value.toLowerCase())) {
                if (!element.classList.contains('c__hidden')) {
                    element.classList.add('c__hidden');
                }
            } else {
                if (element.classList.contains('c__hidden')) {
                    element.classList.remove('c__hidden');
                }
                closeDropdown = false;
            }
        });

        if (closeDropdown) {
            this.closeDropdown(dropdown);
        } else {
            if (dropdown.classList.contains('c__hidden')) {
                dropdown.classList.remove('c__hidden');
            }
        }
    }

    handleCloseDropdown() {
        document.addEventListener('click', (event) => {
            if (!event.target.classList.contains('js-autocomplete') && !event.target.classList.contains('js-autocomplete-dropdown')) {
                document.querySelectorAll('.js-autocomplete-dropdown').forEach((dropdown) => {
                    this.closeDropdown(dropdown);
                });
            }
        });
    }

    closeDropdown(dropdown) {
        if (!dropdown.classList.contains('c__hidden')) {
            dropdown.classList.add('c__hidden');
        }
    }

    createDropdown(input) {
        let dropdown = document.createElement('div');
        dropdown.classList.add('c-autocomplete', 'js-autocomplete-dropdown', 'c__hidden');

        let data = JSON.parse(input.getAttribute('data-value'));

        for (let value of data) {
            if (null === value) {
                continue;
            }

            let p = document.createElement('p');

            p.innerText = value;

            p.addEventListener('click', () => {
                input.value = p.innerText;
                this.closeDropdown(dropdown)
            });

            dropdown.appendChild(p);
        }

        input.parentNode.insertBefore(dropdown, input.nextSibling);
    }

    registerStyles() {
        let style = document.createElement('style');
        style.innerHTML = `
        .c-autocomplete { 
            position: absolute;
            z-index: 999;
            background: white;
            max-width: 100%;
            max-height: 300px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow-y: scroll;
        }
        
        .c-autocomplete p {
            text-align: center;
            margin: 5px 0;
            cursor: pointer;
            border-bottom: 1px solid #ccc;
        }
        
        .c-autocomplete p:hover {
            color: #111;
        }
        
        .c__hidden {
            display: none;
        }`;

        document.head.appendChild(style);
    }
}

(new Autocomplete()).search();