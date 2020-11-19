//Define image array
var random_images_array = new Array();
var loadedImagesLogin = new Array();
var loadedImagesRegister = new Array();
var totalDeathImgs = 6;
var portraitCountLogin = 0;
var portraitCountRegister = 0;

for (let i = 0; i < totalDeathImgs; i++) {
  random_images_array.push("death" + (i+1) + ".jpg");
}

//Pick 2-3 images
var totalPicksLogin = Math.floor(Math.random() * 2)+2;
var totalPicksRegister = Math.floor(Math.random() * 2)+2;
getRandomImage(random_images_array, totalPicksLogin, document.getElementById("modal--login"), true);
getRandomImage(random_images_array, totalPicksRegister, document.getElementById("modal--register"), false);

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


//Pick random images & add to page
function getRandomImage(imgAr, count, doc, loginCall) {
	//Create wrapper div
	const newDiv = document.createElement("div"); 
	newDiv.classList.add("bgImages");
	doc.insertBefore(newDiv, doc.firstChild)

	//clone array
	const imagesClone = [...imgAr];

	//pick random image
	for (let i = 0; i < count; i++) {
	  	path = '/assets/images/'; // default path here
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
				if (loginCall) portraitCountLogin++; else portraitCountRegister++;

				//deal with very tall images -> limit height to half of viewport
				if (imgHeight > vh/2) {
					let newWidth = imgWidth-((imgHeight-vh/2)/imgHeight)*imgWidth;
					img.style.maxWidth = newWidth + "px";
					imgWidth = newWidth;
					imgHeight = vh/2;
					console.log("shrunk " + img.src + " from height " + imgHeight + " to new height " + vh/2);
				}
			} else {
				//landscape image
				img.style.left = 0;
				img.style.top = 0;
			}
			
			
			if (loginCall) {
				loadedImagesLogin.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
				if (loadedImagesLogin.length == totalPicksLogin) imageLayout(loginCall);
			} else {
				loadedImagesRegister.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
				if (loadedImagesRegister.length == totalPicksRegister) imageLayout(loginCall);
			}
		}		
	} 
}


function randomIntFromInterval(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}

//Set layout of images once all have completed loading
function imageLayout(loginCall){
	if (loginCall){
		portraitCount = portraitCountLogin;
		totalPicks = totalPicksLogin;
		loadedImages = loadedImagesLogin;
	} else {
		portraitCount = portraitCountRegister;
		totalPicks = totalPicksRegister;
		loadedImages = loadedImagesRegister;
	}
	
	console.log("PortraitCount: " + portraitCount);
	console.log("Total Images: " + totalPicks);
	console.log(loginCall);

	for (let i = 0; i < loadedImages.length; i++) {
		let curImg = loadedImages[i];
		console.log(curImg.info);
		if (totalPicks === 2) {
			///////2 images total -> one along top, between center & right corner. Another along left edge.
			//console.log("2 Img Layout");

			if (i === 0){
				//Top
				curImg.image.style.left = randomIntFromInterval(vw*.5, vw-curImg.width) + "px";
				curImg.image.style.top = 0;
				if (curImg.aspect<1) verticalShrink(curImg.image); //prevent portraits along the top from being too tall
			} else {
				//Left
				curImg.image.style.top = randomIntFromInterval(0, vh-curImg.height) + "px";
				curImg.image.style.bottom = "auto";
			}

			
		} else {
			///////3 images total -> one along top, between center & right corner. Another along left edge, up to 60% down. Another along the bottom edge, up to 40% right.
			if (i === 0){
				//Top
				curImg.image.style.left = randomIntFromInterval(vw*.5, vw-curImg.width) + "px";
				curImg.image.style.top = 0;
				if (curImg.aspect<1) verticalShrink(curImg.image); //prevent portraits along the top from being too tall
			} else if (i === 1) {
				//Left
				var top = vh*.4-curImg.height;
				if (top < 0) top = 0;
				curImg.image.style.top = randomIntFromInterval(0, top) + "px";
				curImg.image.style.bottom = "auto";
			} else {
				//Bottom
				var left = vw*.4-curImg.width;
				if (left < 0) left = 0;
				curImg.image.style.left = randomIntFromInterval(0, left) + "px";
				curImg.image.style.top = "auto";
				curImg.image.style.bottom = 0;
			}
		}
		


	}
}

function verticalShrink(img){
	let newWidth = img.width-((img.height-vh*.4)/img.height)*img.width;
	img.style.maxWidth = newWidth + "px";
}
