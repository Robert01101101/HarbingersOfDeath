// uses: https://github.com/desandro/colcade

let grid = document.querySelector('[data-js="grid"]');

let colcade = new Colcade(grid, {
    columns: '[data-js="column"]',
    items: '[data-js="tile"]'
});



// source: https://stackoverflow.com/questions/346021/how-do-i-remove-objects-from-a-javascript-associative-array/9973592#9973592
Object.prototype.removeItem = function (key) {
    if (!this.hasOwnProperty(key))
        return
    if (isNaN(parseInt(key)) || !(this instanceof Array))
        delete this[key]
    else
        this.splice(key, 1)
};






document.addEventListener('DOMContentLoaded', function() {

    /*************************************
     *
     *          MODAL MANAGEMENT
     *
     *************************************/

        // Open modal on click

    let modal = document.querySelector('[data-js="modal"]');
    let body = document.body;
    let content = document.querySelector('.content');
    let buttonRegister = document.querySelector('[data-js="buttonRegister"]');
    let buttonClose = document.querySelector('[data-js="buttonClose"]');


    // TODO: make closing modal more user friendly (i.e. esc key)

    buttonRegister.addEventListener('click', function ( event){
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

    /*************************************
     *
     *          TAXONOMY MANAGEMENT
     *
     *  references:
     *  https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
     *  https://stackoverflow.com/questions/316781/how-to-build-query-string-with-javascript
     *************************************/

        // document.querySelectorAll(["data-js="tag-link"])


        // Gets the URL Parameters
    let urlParams = {};
    (window.onpopstate = function () {
        let match,
            pl = /\+/g,  // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);

        while (match = search.exec(query)) {
            if (decode(match[1]) in urlParams) {
                if (!Array.isArray(urlParams[decode(match[1])])) {
                    urlParams[decode(match[1])] = [urlParams[decode(match[1])]];
                }
                urlParams[decode(match[1])].push(decode(match[2]));
            } else {
                urlParams[decode(match[1])] = decode(match[2]);
            }
        }
    })();




    let omenList = document.querySelector('[data-js="filtered-omen-list"]')

    terms("aspect");
    terms("death");
    terms("fault");

    function terms(taxonomy) {
        let terms = document.querySelectorAll('[data-js-term-' + taxonomy + ']');
        terms.forEach(term => {
            term.addEventListener('click', event => {

                event.preventDefault();

                let termSlug = term.getAttribute('data-js-term-' + taxonomy);

                if (urlParams[taxonomy] === termSlug) {
                    urlParams.removeItem(taxonomy);
                    term.classList.remove("tile__listItem--active");
                } else {
                    urlParams[taxonomy] = termSlug;
                    terms.forEach(tempTerm => {
                        if (tempTerm.classList.contains("tile__listItem--active")) {
                            tempTerm.classList.remove("tile__listItem--active")
                        }
                    })
                    term.classList.add("tile__listItem--active");
                }

                window.console.log(urlParams);

                let esc = encodeURIComponent;
                let query = Object.keys(urlParams)
                    .map(k => esc(k) + '=' + esc(urlParams[k]))
                    .join('&');



                if (omenList == null) {
                    window.location.href = "/omen/?" + query;
                } else {

                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {

                            omenList.innerHTML = this.responseText;
                            colcade.destroy()
                            let grid = document.querySelector('[data-js="grid"]');
                            colcade = new Colcade(grid, {
                                columns: '[data-js="column"]',
                                items: '[data-js="tile"]'
                            });
                        }
                    };

                    xmlhttp.open("GET", "/omen/ajax/?" + query, true);
                    xmlhttp.send();
                }

            })
        })
    }


});




