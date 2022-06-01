var indexValue = 0;
var images = document.getElementsByClassName('images');
function slideShow(){
  setTimeout(slideShow, 10000);
  var x;
  const img = document.querySelectorAll("img");
  for(x = 0; x < img.length; x++){
    img[x].style.display = "none";
  }
  indexValue++;
  if(indexValue > img.length){indexValue = 1}
  img[indexValue -1].style.display = "block";
}
slideShow();