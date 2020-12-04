//Loads & places images in the background of the login / register modals. Images are loaded randomly and placed semi-randomly.
//There is an attempt to achieve an aesthetically pleasing composition, but at random, so that it has a unique look every time.

//Variables
var random_images_array = new Array();
var loadedImagesLogin = new Array();
var loadedImagesRegister = new Array();
var loadedImagesAccount = new Array();
var loadedImagesSearch = new Array();
var totalDeathImgs = 6;
var portraitCountLogin = 0;
var portraitCountRegister = 0;
var portraitCountAccount = 0;
var portraitCountSearch = 0;

//Check for viewport size
const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
var body = document.body,
    html = document.documentElement;
var dh = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );
//console.log(vh);

//Define Image class for easier access to certain properties, such as aspect ratio
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

//Define strings of all possible images
for (let i = 0; i < totalDeathImgs; i++) {
  random_images_array.push("death" + (i+1) + ".jpg");
}

//Pick a number of images (more for search), load & analyze them
var totalPicksLogin = Math.floor(Math.random() * 2)+2;
var totalPicksRegister = Math.floor(Math.random() * 2)+2;
var totalPicksAccount = Math.floor(Math.random() * 2)+2;
var totalPicksSearch = 3;
getRandomImage(random_images_array, totalPicksLogin, document.getElementById("modal--login"), 0);
getRandomImage(random_images_array, totalPicksRegister, document.getElementById("modal--register"), 1);
getRandomImage(random_images_array, totalPicksAccount, document.getElementById("modal--account"), 2);
if (document.getElementById("searchPage") !== null) getRandomImage(random_images_array, totalPicksSearch, document.getElementById("searchPage"), 3);


//Pick random images & add to page
function getRandomImage(imgAr, count, doc, call) {
	//Create wrapper div
	const newDiv = document.createElement("div"); 
	newDiv.classList.add("bgImages");
	doc.insertBefore(newDiv, doc.firstChild);
	if (call === 3) newDiv.classList.add("bgImages--search");

	//clone array
	const imagesClone = [...imgAr];

	//console.log("getRandomImage CALL " + call);

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
				switch (call) { 
					case 0: portraitCountLogin++; break;
					case 1: portraitCountRegister++; break;
					case 2: portraitCountAccount++; break;
					case 3: portraitCountSearch++; break;
				}

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
			
			switch (call) { 
				case 0: 
					loadedImagesLogin.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
					if (loadedImagesLogin.length == totalPicksLogin) imageLayout(call);
					break;
				case 1: 
					loadedImagesRegister.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
					if (loadedImagesRegister.length == totalPicksRegister) imageLayout(call);
					break;
				case 2:
					loadedImagesAccount.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
					if (loadedImagesAccount.length == totalPicksAccount) imageLayout(call);
					break;
				case 3: 
					loadedImagesSearch.push(new LayoutImage(img, aspectRatio, imgWidth, imgHeight));
					if (loadedImagesSearch.length == totalPicksSearch) imageLayout(call);
					break;
			}
		}		
	} 

	if (call === 3) {
		const stylingDiv = document.createElement("div"); 
		stylingDiv.classList.add("bgImages--search--fg");
		newDiv.appendChild(stylingDiv);
	}
}


function randomIntFromInterval(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}

//Set layout of images once all have completed loading
function imageLayout(call){
	switch (call) {
		case 0:
			portraitCount = portraitCountLogin;
			totalPicks = totalPicksLogin;
			loadedImages = loadedImagesLogin;
			break;
		case 1:
			portraitCount = portraitCountRegister;
			totalPicks = totalPicksRegister;
			loadedImages = loadedImagesRegister;
			break;
		case 2:
			portraitCount = portraitCountAccount;
			totalPicks = totalPicksAccount;
			loadedImages = loadedImagesAccount;
			break;
		case 3:
			portraitCount = portraitCountSearch;
			totalPicks = totalPicksSearch;
			loadedImages = loadedImagesSearch;
			break;
	}

	console.log("_____________________________");
	console.log("Image Layout CALL: " + call);
	console.log("PortraitCount: " + portraitCount);
	console.log("Total Images: " + totalPicks);
	
	//Place Login & Register Images
	if (call < 2){
		for (let i = 0; i < loadedImages.length; i++) {
			let curImg = loadedImages[i];
			console.log(curImg.info);
			if (totalPicks === 3) {
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
	} else {
		//SEPARATE LAYOUT FOR SEARCH, LESS RANDOM, FIXED TO SIDES & CORNERS
		var altZigZag = false;
		for (let i = 0; i < loadedImages.length; i++) {
			let curImg = loadedImages[i];
			console.log(curImg.info);
			switch (i) {
				case 0:
					//place in either left or right top corner
					curImg.image.style.bottom = "auto";
					curImg.image.style.top = "0px";
					if (Math.random() < 0.5) {
						altZigZag = true;
						curImg.image.style.left = "auto";
						curImg.image.style.right = "0px";
					}
					break;
				case 1:
					curImg.image.style.bottom = "auto";
					curImg.image.style.top = dh/2 - curImg.height/2 + "px";
					if (!altZigZag){
						curImg.image.style.left = "auto";
						curImg.image.style.right = "0px";
					}
					break;
				case 2:
					curImg.image.style.bottom = "0px";
					curImg.image.style.top = "auto";
					if (altZigZag){
						curImg.image.style.left = "auto";
						curImg.image.style.right = "0px";
					} 
					break;
			}
		} 
	}
}

function verticalShrink(img){
	let newWidth = img.width-((img.height-vh*.4)/img.height)*img.width;
	img.style.maxWidth = newWidth + "px";
}
