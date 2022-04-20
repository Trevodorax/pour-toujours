//Here will be found everything regarding the canva signature space.

//This allows the browser to understand we are doing an animation (the drawing) AND it should'nt crash.
window.requestAnimFrame = (function(callback) {
  return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimaitonFrame ||
    function(callback) {
      window.setTimeout(callback, 1000 / 60);
    };
})();


let canva = document.querySelector('canvas')
//Setting of the line
let ctx = canva.getContext('2d')
ctx.strokeStyle = "black" 
ctx.lineWidth = 2;


//Initial positions of mouse when we are not drawing:
let sign = false
let beforeX =0
let beforeY =0
//The following variable gives us the gap between the reality and the fiction.
let rect = canva.getBoundingClientRect()



//Touch detection for mobile

canva.addEventListener("touchstart", function(e){
    //Prevent the scrolling effect if we are on the canva
    if (e.target == canva) {
        e.preventDefault();
        }

    //Starting to draw
    sign = true

    //path of the cursor position in the event obj
    let touch = e.targetTouches[0]

     //New positions of cursor 
    beforeX = touch.clientX -rect.left
    beforeY = touch.clientY - rect.top 
})

canva.addEventListener("touchmove", function(e){

    //Prevent the scrolling effect if we are on the canva
    if (e.target == canva) {
        e.preventDefault();
        }

    if (sign == true) {
      
        //path of the cursor position in the event obj
        let touch = e.targetTouches[0]
  
        //New positions of cursor
        let nowX = touch.clientX - rect.left
        let nowY = touch.clientY - rect.top

        draw(beforeX, beforeY, nowX, nowY)

        //using the starting point of the line the ex-end
        beforeX = nowX
        beforeY = nowY    
    }
}, false)

function draw(srcX, srcY, destX, destY){

//This is how you draw on a canva, you make a stroke/line bewteen two points

    ctx.beginPath()
    ctx.moveTo(srcX, srcY)
    ctx.lineTo(destX, destY)
    ctx.closePath()
    ctx.stroke()
    console.log("is drawing")

}

//As the name might tells you already, this erase the canva !
function eraseCanva(){
    console.log("AH")
    ctx.clearRect(0,0, canva.width, canva.height)
}