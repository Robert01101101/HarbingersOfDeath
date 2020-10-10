const labelMod = "input__label--selected";
const labelModFloating = "input__label--floating"

//For floating labels: User clicks on text input and label floats up.

//Each class contains a label & a text input. The input listens for user inputs and styles the label.
//________________________________________________________________ Pair Class
var Pair = function(label, input) {
	this.label = label;
	this.input = input;

	//add floating modifier
	if (!this.label.classList.contains(labelModFloating)) this.label.classList.add(labelModFloating);

	this.input.addEventListener('input', (event) => {
	  this.label.classList.add("input__label--selected");
	  //console.log("Focus on: " + this.input.id + ", with label: " + this.label.innerHTML);
	  //console.log("text:" + event.target.value);

	  //Change label style on input
	  if (event.target.value === ""){
	  	if (this.label.classList.contains(labelMod)) this.label.classList.remove(labelMod);
	  } else {
	  	if (!this.label.classList.contains(labelMod)) this.label.classList.add(labelMod);
	  }
	});
};



//Find all cells
var cells = [...document.querySelectorAll(".form__cell")];

//Create pair classes for each cell that contains exactly one label & one input
for (let i = 0; i < cells.length; i++) {
	
	let cell = cells[i];
	let labels = [...cell.querySelectorAll(".input__label")];
	let inputs = [...cell.querySelectorAll(".input__text")];

	if (labels.length === 1 && inputs.length === 1){
		new Pair(labels[0], inputs[0]);
	}
}

