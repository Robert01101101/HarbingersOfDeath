// MANAGE MODALS, AJAX

// uses: https://github.com/desandro/colcade

let grid = document.querySelector('[data-js="grid"]');

var colcade = new Colcade(grid, {
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


document.addEventListener('DOMContentLoaded', function () {

    /*************************************
     *
     *          MODAL MANAGEMENT
     *
     *************************************/

        // Open modal on click


    let body = document.body;
    let content = document.querySelector('.content');

    // modals
    let modalLogin = document.querySelector('[data-js-modal="login"]');
    let modalRegister = document.querySelector('[data-js-modal="register"]');
    let modalAccount = document.querySelector('[data-js-modal="account"]');

    // modal buttons
    let buttonRegister = document.querySelector('[data-js-modal="registerButton"]');
    let buttonAccount = document.querySelector('[data-js-modal="accountButton"]');
    let buttonLogin = document.querySelector('[data-js-modal="loginButton"]');
    let buttonLoginAlt = document.querySelector('[data-js-modal="buttonLoginAlt"]');
    let buttonClose = document.querySelector('[data-js-modal="close"]');
    let buttonCloseLogin = document.querySelector('[data-js-modal="closeLogin"]');
    let buttonCloseAccount = document.querySelector('[data-js-modal="closeAccount"]');

    let formLogin = document.querySelector('[data-js-modal="loginForm"]');

    let submitLogin = document.querySelector('[data-js-modal="loginSubmitButton"]');

    let responseLogin = document.querySelector('[data-js-modal="loginResponse"]');

    // TODO: make closing modal more user friendly (i.e. esc key)
    if (typeof (buttonRegister) != 'undefined' && buttonRegister != null) {
        buttonRegister.addEventListener('click', function (event) {
            // adds "js-modal--open" class to model container to open model
            modalRegister.classList.add("js-modal--open");

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
    }

    if (typeof (buttonLogin) != 'undefined' && buttonLogin != null) {
        buttonLogin.addEventListener('click', function (event) {
            // adds "js-modal--open" class to model container to open model
            modalLogin.classList.add("js-modal--open");

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
    }

    if (typeof (buttonAccount) != 'undefined' && buttonAccount != null) {
        buttonAccount.addEventListener('click', function (event) {
            // adds "js-modal--open" class to model container to open model
            modalAccount.classList.add("js-modal--open");

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
    }

    if (typeof (buttonLoginAlt) != 'undefined' && buttonLoginAlt != null) {
        buttonLoginAlt.addEventListener('click', function (event) {
            // adds "js-modal--open" class to model container to open model
            modalLogin.classList.add("js-modal--open");

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
    }


    if (typeof (buttonClose) != 'undefined' && buttonClose != null) {
        buttonClose.addEventListener('click', function (event) {
            // gets current scroll position from CSS variable in body and parses it to an int and making it positive
            const scrollY = parseInt(document.body.style.getPropertyValue('--js-scrollPosY') || 0) * -1;

            // removes "js-modal--open" class from model container to close model
            if (modalLogin.classList.contains("js-modal--open")) {
                modalLogin.classList.remove("js-modal--open");
            }
            if (modalRegister.classList.contains("js-modal--open")) {
                modalRegister.classList.remove("js-modal--open");
            }


            // removes "js-fixed" class from body (this prevents scrolling)
            body.classList.remove("js-fixed");

            // removes "js-blurred" class from body (this makes things blurry)
            content.classList.remove("js-blur");

            window.scrollTo(0, parseInt(scrollY || '0') * -1);

            event.preventDefault();
        });
    }

    //quick bug fix where login close button would just refresh the page, causing lack of fade out
    if (typeof (buttonCloseLogin) != 'undefined' && buttonCloseLogin != null) {
        buttonCloseLogin.addEventListener('click', function (event) {
            // gets current scroll position from CSS variable in body and parses it to an int and making it positive
            const scrollY = parseInt(document.body.style.getPropertyValue('--js-scrollPosY') || 0) * -1;

            // removes "js-modal--open" class from model container to close model
            if (modalLogin.classList.contains("js-modal--open")) {
                modalLogin.classList.remove("js-modal--open");
            }
            if (modalRegister.classList.contains("js-modal--open")) {
                modalRegister.classList.remove("js-modal--open");
            }


            // removes "js-fixed" class from body (this prevents scrolling)
            body.classList.remove("js-fixed");

            // removes "js-blurred" class from body (this makes things blurry)
            content.classList.remove("js-blur");

            window.scrollTo(0, parseInt(scrollY || '0') * -1);

            event.preventDefault();
        });
    }

    //Account Close
    if (typeof (buttonCloseAccount) != 'undefined' && buttonCloseAccount != null) {
        buttonCloseAccount.addEventListener('click', function (event) {
            // gets current scroll position from CSS variable in body and parses it to an int and making it positive
            const scrollY = parseInt(document.body.style.getPropertyValue('--js-scrollPosY') || 0) * -1;

            // removes "js-modal--open" class from model container to close model
            if (modalAccount.classList.contains("js-modal--open")) {
                modalAccount.classList.remove("js-modal--open");
            }
            


            // removes "js-fixed" class from body (this prevents scrolling)
            body.classList.remove("js-fixed");

            // removes "js-blurred" class from body (this makes things blurry)
            content.classList.remove("js-blur");

            window.scrollTo(0, parseInt(scrollY || '0') * -1);

            event.preventDefault();
        });
    }

    // var paramsLogin = null;
    // var urlLogin = '';
    // if (typeof(formLogin) != 'undefined' && formLogin != null){
    // 	formLogin.addEventListener('submit', function (event){

    // 		event.preventDefault();


    // 		let xmlhttp = new XMLHttpRequest();

    // 		urlLogin = '/login/ajax/';
    // 		paramsLogin = new FormData(formLogin);


    // 		xmlhttp.open("POST", urlLogin);

    // 		// xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // 		xmlhttp.send(paramsLogin);


    // 		xhr.onloadend = function (response) {
    // 			if (response.target.status === 0) {

    // 				// Failed XmlHttpRequest should be considered an undefined error.

    // 				console.log = form.dataset.formError;
    // 				console.log("000");

    // 			} else if (response.target.status === 400) {

    // 				// Bad Request
    // 				formStatus.className += ' alert-danger';
    // 				console.log("400");

    // 			} else if (response.target.status === 200) {

    // 				console.log("200");

    // 			}
    //         };


    // 		// xmlhttp.onreadystatechange = function () {
    //         //     if (this.readyState === 4 && this.status === 200) {

    //         //         responseLogin.innerHTML = this.responseText;

    //         //     } else {
    // 		// 		responseLogin.innerHTML = "ajax error";
    //         //     }
    //         // };

    //     }, false);
    // }

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


                // remove existing breadcrumbs
                const removeElements = (elements) => elements.forEach(element => element.remove());
                removeElements(document.querySelectorAll("[data-js-breadcrumb]"));
                //remove breadcrumb added initially by php
                document.querySelectorAll('.hardcoded--delete').forEach(e => e.remove());

                // add new breadcrumbs
                for (const [taxonomy, term] of Object.entries(urlParams)) {
                    let liLinkTaxonomy = document.createElement('li');
                    liLinkTaxonomy.setAttribute('class', 'nav__link');
                    liLinkTaxonomy.setAttribute('data-js-breadcrumb', 'taxonomy');
                    let textTaxonomy = document.createTextNode("[ " + taxonomy + " : " + term + " ]");
                    liLinkTaxonomy.appendChild(textTaxonomy);

                    let navLeft = document.querySelector('[data-js="breadcrumbs"]');
                    navLeft.appendChild(liLinkTaxonomy);

                }


                let esc = encodeURIComponent;
                let query = Object.keys(urlParams)
                    .map(k => esc(k) + '=' + esc(urlParams[k]))
                    .join('&');

                let urlPathAjax = "/omen/ajax/?" + query;
                let urlPath = "/omen/?" + query;


                if (omenList == null) {
                    window.location.href = "/omen/?" + query;
                } else {

                    let xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {

                            window.history.replaceState({"query": query}, "", urlPath);

                            let omenCollection = JSON.parse(this.responseText);
                            const markup = `
                                <div data-js="column" class="tile__panel__column g-span2of8"></div>
                                <div data-js="column" class="tile__panel__column g-span2of8"></div>
                                <div data-js="column" class="tile__panel__column g-span2of8"></div>
                                <div data-js="column" class="tile__panel__column g-span2of8 g-last"></div>

                                ${omenCollection.map(omen =>
                                `
                                <div data-js="tile" class="tile">
                                    <a href="${omen.path}">
                                        <span class="tile__text  tile__text--title">${omen.title}</span>
                                        <span class="tile__text">${omen.semanticDeath}</span>
                                    </a>
                                </div>
                                `
                                ).join('')}
                            `;

                            colcade.destroy();

                            let test = document.querySelector('[data-js="grid"]');

                            test.innerHTML = markup;


                            colcade = new Colcade(test, {
                                columns: '[data-js="column"]',
                                items: '[data-js="tile"]'
                            });
                        }
                    };

                    xmlhttp.open("GET", urlPathAjax, true);
                    xmlhttp.send();
                }
            })
        })
    }

    /*************************************
     *
     *          SEARCH
     *
     *  references:
     *  https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
     *  https://stackoverflow.com/questions/316781/how-to-build-query-string-with-javascript
     *  https://stackoverflow.com/questions/13125817/how-to-remove-elements-that-were-fetched-using-queryselectorall
     *************************************/

    let searchForm = document.querySelector('[data-js-searchForm="searchForm"]');
    let searchBar = document.querySelector('[data-js-searchForm="searchBar"]');
    let queryDisplay = document.querySelector('[data-js-searchForm="queryDisplay"]');
    let searchOmenList = document.querySelector('[data-js="grid"]');


    const inputHandler = function (e) {
        let queryString = e.target.value;
        queryDisplay.innerHTML = queryString;

        urlParams["query"] = queryString;
        let esc = encodeURIComponent;
        let query = Object.keys(urlParams)
            .map(k => esc(k) + '=' + esc(urlParams[k]))
            .join('&');

        let urlPathAjax = "/search/ajax/?" + query;
        let urlPath = "/search/?" + query;

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {


                window.history.replaceState({"query": queryString}, "", urlPath);

                let omenCollection = JSON.parse(this.responseText);
                const markup = `
                    <div data-js="column" class="tile__panel__column g-span2of6"></div>
                    <div data-js="column" class="tile__panel__column g-span2of6"></div>
                    <div data-js="column" class="tile__panel__column g-span2of6 g-last"></div>

                    ${omenCollection.map(omen =>
                    `
                        <div data-js="tile" class="tile">
                            <a href="${omen.path}">
                                <span class="tile__text  tile__text--title">${omen.title}</span>
                                <span class="tile__text">${omen.semanticDeath}</span>
                            </a>
                        </div>
                        `
                    ).join('')}
                `;

                colcade.destroy();

                searchOmenList.innerHTML = markup;

                colcade = new Colcade(searchOmenList, {
                    columns: '[data-js="column"]',
                    items: '[data-js="tile"]'
                });
            }
        };

        xmlhttp.open("GET", urlPathAjax, true);
        xmlhttp.send();
    }

    searchBar.addEventListener('input', inputHandler);
    searchBar.addEventListener('propertychange', inputHandler);

    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();
        return false;
    });


});




