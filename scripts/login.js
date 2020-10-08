// uses: https://github.com/desandro/colcade

function localScope() {
    let grid = document.querySelector('[data-js="grid"]');

    let colcade = new Colcade(grid, {
        columns: '[data-js="column"]',
        items: '[data-js="tile"]'
    });



    document.addEventListener('DOMContentLoaded', function() {
        // Open modal on click

        let modal = document.querySelector('[data-js="modal-l"]');
        let body = document.body;
        let content = document.querySelector('.content');
        let buttonLogin = document.querySelector('[data-js="buttonLogin"]');
        let buttonClose = document.querySelector('[data-js="buttonClose-l"]');


        // TODO: make closing modal more user friendly (i.e. esc key)

        buttonLogin.addEventListener('click', function ( event){
            // adds "js-modal--open" class to model container to open model
            modal.classList.add("js-modal--open");

            // sets width of modal scroll bar to a CSS variable in the modal
            // CSS then removes visible scrollbar from modal (not good ux!)
            // although...... this doesn't work at all.
            // TODO: make this work
            // TODO: OR: custom scroll bars everywhere
            //const scrollBarWidth = modal.offsetWidth - modal.clientWidth;
            //modal.style.setProperty('--js-scrollBarWidth', `-${scrollBarWidth}px`);

            // sets current scroll position in CSS variable in body element
            body.style.setProperty('--js-scrollPosY', `-${window.scrollY}px`);

            // adds "js-fixed" class to body (this prevents scrolling)
            body.classList.add("js-fixed");

            // adds "js-blurred" class to the body (this makes things blurry)
            content.classList.add("js-blur");

            // stops click from doing anything
            event.preventDefault();

           // child.style.paddingRight = child.offsetWidth - child.clientWidth + "px";
        });

        buttonClose.addEventListener('click', function ( event){
            // gets current scroll position from CSS variable in body and parses it to an int and making it positive
            const scrollY = parseInt(document.body.style.getPropertyValue('--js-scrollPosY') || 0) * -1;

            // removes "js-modal--open" class from model container to close model
            modal.classList.remove("js-modal--open");

            // removes "js-fixed" class from body (this prevents scrolling)
            body.classList.remove("js-fixed");

            // removes "js-blurred" class from body (this makes things blurry)
            content.classList.remove("js-blur");

            window.scrollTo(0, parseInt(scrollY || '0') * -1);

            event.preventDefault();
        });

    });
}

localScope();
