//Let's make this canva works ! 


(function() {
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
ctx.lineWidth = 4;


//Initial positions of mouse when we are not drawing:
let sign = false
let beforeX =0
let beforeY =0

//Touch detection for mobile
canva.addEventListener("touchstart", function(e){
    //Prevent the scrolling effect if we are on the canva
    if (e.target == canva) {
        e.preventDefault();
        }

    //Starting to draw
    sign = true

    //New positions of cursor
        //path of the cursor position in the event obj
        let touch = e.targetTouches[0]

    beforeX = touch.clientX - canva.offsetLeft
    beforeY = touch.clientY -  canva.offsetTop
})

canva.addEventListener("touchmove", function(e){
    
    //Prevent the scrolling effect if we are on the canva
    if (e.target == canva) {
        e.preventDefault();
        }

    if (sign == true) {
      //New positions of cursor
            //path of the cursor position in the event obj
            let touch = e.targetTouches[0]

        let nowX = touch.clientX - canva.offsetLeft
        let nowY = touch.clientY -  canva.offsetTop
        console.log(beforeX, beforeY, nowX, nowY)
        draw(beforeX, beforeY, nowX, nowY)
        console.log(beforeX, beforeY, nowX, nowY)
        
    }
}, false)

function draw(srcX, srcY, destX, destY){
    ctx.beginPath()
    ctx.moveTo(srcX, srcY)
    ctx.lineTo(destX, destY)
    ctx.closePath()
    ctx.stroke()
    console.log("is done")

    srcX = destX
    srcY = destY
}

})();