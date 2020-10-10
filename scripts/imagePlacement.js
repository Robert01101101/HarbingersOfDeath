//Define image array
var random_images_array = new Array();
var loadedImages = new Array();
var totalDeathImgs = 6;
var portraitCount = 0;

for (let i = 0; i < totalDeathImgs; i++) {
  random_images_array.push("death" + (i+1) + ".jpg");
}

//Pick random images & add to page
function getRandomImage(imgAr, count, doc, path) {
	//Create wrapper div
	const newDiv = document.createElement("div"); 
	newDiv.classList.add("bgImages");
	doc.insertBefore(newDiv, doc.firstChild)

	//clone array
	const imagesClone = [...imgAr];

	//pick random image
	for (let i = 0; i < count; i++) {
	  	path = path || '/assets/images/'; // default path here
	    var num = Math.floor( Math.random() * imagesClone.length );

	    //Pick image & remove from cloned array to prevent double picks
	    let removed = imagesClone.splice(num, 1) 
	    let img = document.createElement("img");
	    img.src = path + removed;
	    newDiv.appendChild(img);

	    //Init image
	    img.onload = function(){
			//console.log("loaded");
			
			//Main setup
			img.style.position = "absolute";

			//respond to aspect ratio
			let imgHeight = img.height
			let imgWidth = img.width;
			let aspectRatio = imgWidth/imgHeight;
			
			if (aspectRatio < 1) {
				//portrait image
				img.style.left = 0;
				img.style.bottom = 0;
				portraitCount++;

				//deal with very tall images -> limit height to half of viewport
				if (imgHeight > vh/2) {
					let newWidth = imgWidth-((imgHeight-vh/2)/imgHeight)*imgWidth;
					img.style.maxWidth = newWidth + "px";
					console.log("shrunk " + img.src + " from height " + imgHeight + " to new height " + vh/2);
				}
			} else {
				//landscape image
				img.style.left = 0;
				img.style.top = 0;
			}
			
			loadedImages.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
			if (loadedImages.length == totalPicks) imageLayout();
		}		
	} 
}

//Pick 2-3 images
var totalPicks = Math.floor(Math.random() * 2)+2;
getRandomImage(random_images_array, totalPicks, document.getElementById("modal--login"));
getRandomImage(random_images_array, totalPicks, document.getElementById("modal--register"));

//Check for viewport size
const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0)
console.log(vh);


class LayoutImage {
  constructor(image, aspect, width, height) {
    this.image = image;
    this.aspect = aspect;
    this.width = width;
    this.height = height;
  }
  
  get info() {
    return this.infoString();
  }
  infoString() {
    return "Image: " + this.image + ", Aspect: " + this.aspect + ", Width: " + this.width  + ", Height: " + this.height;
  }
  image(){
  	return this.image;
  }
  aspect(){
  	return this.aspect;
  }
  width(){
  	return this.width;
  }
  height(){
  	return this.height;
  }
}

function randomIntFromInterval(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}

//Set layout of images once all have completed loading
function imageLayout(){
	//console.log(portraitCount);
	var ticker = 0;

	for (let i = 0; i < loadedImages.length; i++) {
		let curImg = loadedImages[i];
		//console.log(curImg.info);

		
		if (portraitCount === 1){
			//portrait in btm left with landscape along top edge
			if (curImg.aspect>1){
				if (totalPicks === 3) {
					//2 landscape
					if (ticker === 0){
						curImg.image.style.left = randomIntFromInterval(vw*.6, vw*.667) + "px";
					} else {
						curImg.image.style.left = randomIntFromInterval(0, vw*.2) + "px";
					}
					ticker++;
				} else {
					//1 landscape
					curImg.image.style.left = randomIntFromInterval(0, vw*.667) + "px";
				}
				
			}
		} else {
			//Not exactly 1 portrait
			if (portraitCount === 0) {
				//No portrait
				if (ticker === 0){
					curImg.image.style.left = randomIntFromInterval(.2, vw*.667) + "px";
				} else {
					curImg.image.style.top = "auto";
					curImg.image.style.bottom = randomIntFromInterval(.2, vh*.667) + "px";
				}
				ticker++;
			} else {
				//multiple portraits
				if(portraitCount === 2) {
					if (ticker === 0) {
						curImg.image.style.left = 0;
						curImg.image.style.bottom = 0;
					} else {
						curImg.image.style.top = 0;
						curImg.image.style.bottom = "auto";
						curImg.image.style.left = randomIntFromInterval(0, vw*.667) + "px";
					}
					ticker++;
				} else {
					if (ticker === 0) {
						curImg.image.style.top = 0;
						curImg.image.style.bottom = "auto";
						curImg.image.style.left = 0;
					} else if (ticker === 1) {
						curImg.image.style.top = "auto";
						curImg.image.style.bottom = 0;
						curImg.image.style.left = randomIntFromInterval(0, vw*.33) + "px";
					} else {
						curImg.image.style.top = 0;
						curImg.image.style.bottom = "auto";
						curImg.image.style.left = randomIntFromInterval(vw*.6, vw*.7) + "px";
					}
					ticker++;
				}
			}
		}

	}
}
