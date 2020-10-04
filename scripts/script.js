// uses: https://github.com/desandro/colcade

var grid = document.querySelector('[data-js="grid"]');

var colcade = new Colcade(grid, {
  columns: '[data-js="column"]',
  items: '[data-js="tile"]',
});
