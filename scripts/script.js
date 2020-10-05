// uses: https://github.com/desandro/colcade

let grid = document.querySelector('[data-js="grid"]');

let colcade = new Colcade(grid, {
  columns: '[data-js="column"]',
  items: '[data-js="tile"]'
});



document.addEventListener('DOMContentLoaded', function() {
  // Open modal on click 
  
    var modal = document.querySelector('[data-js="modal"]');
    var registerButton = document.querySelector('[data-js="registerButton"]');

    registerButton.addEventListener('click', function ( event){
      modal.classList.add("modal--open")
      event.preventDefault();
    });


});




