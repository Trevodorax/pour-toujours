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
ctx.strokeStyle = "red" 
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
    ctx.clearRect(0,0, canva.width, canva.height)
}

//We need this to send to php and then to the server the signature
function saveAsImage(){
    
    let signature = canva.toDataURL("image/png");
    console.log(signature)
    //DO AJAX : 
    const request = new XMLHttpRequest();
  
    request.open('POST', 'save_signature.php');

    request.onreadystatechange = function(){

        if ( request.readyState == 4){

            console.log(request.responseText)
            displaySignature(signature);
        } 
    }

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // $data ="sign=data%3Aimage%2Fpng%3Bbase64%2CiVBORw0KGgoAAAANSUhEUgAAASwAAABkCAYAAAA8AQ3AAAAAAXNSR0IArs4c6QAAGp1JREFUeF7tnQu4dGVVx%2F9vlpqWaGWamhcs85aGZqldlMxUBNFSQgUVRS1MgRBLLqESBoKKIcbFRBTxCnlNMkwlwDJBVBSzNMkLKJmAQpbJ8vmd9e7vvN8%2BM2f2zOy9Z%2FactZ5nnvPB7P1e1rv3f9Z9JQUFB4IDwYGBcCANZJ2xzOBAcCA4oACseAiCA8GBwXAgAGswRxULDQ4EBwKw4hkIDgQHBsOBAKzBHFUstA0OmHSCpPPyWDck6aw2xo0x%2BuFAAFY%2FfI5ZloADJp0k6dnFUq5M0s8swdJiCQ05EIDVkFFx2bA5YNJTJb0%2B7%2BKLknbM%2Fz4sSUcNe3dbZ%2FUBWFvnrLfsTk06VNKfZwacL%2Bkpkv5M0tPy%2F7tU0jFJOmPLMmkgGw%2FAGshBxTJn54BJ35F0c0knJekPq5FM2k3S8VnaMtTFJJ06%2B0xxZ9ccCMDqmsMx%2FkI5YNIvSvqUpGuTtEN9MSbdRNLHJd07f3dykv5goYuOycdyIAArHo6V5oBJ%2B0k6UdKbkrTXuM2aG%2BMxykNXSto%2FSW9baeYMcHMBWAM8tFhycw6Y9OksPaHunbLZnSb9sqSzJf0sEpmkvZP07uazxZVdcyAAq2sOzzB%2B%2FrW%2FOklvneH2uKXggEnflat9uyXpvZOYY9IPSXq%2FpN%2FJ1x6QpFdNui%2B%2B74cDAVj98LnxLCbdWRJeK4zE%2B6R1V3zjMeJC50A2qiMhXZRcempM5l5FvIvQ8Uk6sPHNcWFnHAjA6oy1sw1srpI8TtJbkvTE2UaJuzJgfU7SL0g6PK2HNTRmjknPkPTafMO7JP1pkhgzaEEcCMBaEONHTWseB%2FRkSVdLumeSrlii5Q1qKeYSKnz8YUmPTRKAMzWZ9FvycyEiHvXyMUn6%2B6kHihta4UAAVitsbGcQkz4v6eclnZqkZ7Uz6tYcpfAOfiBJj5iHCybdN%2Bcf3iKHSOyapC%2FPM2bcOxsHArBm41vrd5kD1MmSLknSTq1PsMUGNOmfJf2KpL2S9KZ5t2%2FSLSW9R9KvB2jNy83Z7w%2FAmp13rd5pbhvB3vKUJL2x1cG32GAmPVzSByR9PUm3bWv75oGneBoDtNpi6pTjBGBNybAuLl826cqkmya31wySTPqspHtI%2BtskPbrNTQRotcnN6ccKwJqeZ63fUdiuFipdmas8O0u6YF67T%2BtMmmJAk74h6daSHt9FvasaaBGCsm9yFTSoYw4EYHXM4EnDm3SmPHzhq0m6w6Tru%2FzepMsk3V3S9yTdYohSlkmPQrLCzpTcWN4JZdBingdL%2Bi9J9wtDfCes3m7QAKzueTx2BpN%2BXNIXsjTwmiQ9Z4HLIdDyzZL2zGt4d5J2X%2BR6Zpnb3HGBA%2BPFSXrRLGM0vcc8heejkm4fhvimXJvvugCs%2Bfg3190mHSvp%2BZLOSS4ZLJQKCYt1PCdJr1nogmaYvFAHd0rSJTMMMdUty2bTMg%2FhoNYXCdy3T9IDp9rQkl8cgLWgAzIvZ0JiLvTg5L%2FUC6MiqvsGeT7d4CLtTTpc0ku6Vgfrh7QMoGXSkZKehypfrO%2B6JP3Ywh6qDiYOwOqAqU2GNOntGIXrReWa3Nv2NSY9Ur4eHu4PS3qopP2S9Fdtz9XleIV38CPJ99AbLQq0THqhpMMk3azY7Pcl%2Faekf8c%2BmqRv9saIjicKwOqYwaOGN2nXHIT4P5LuuugUnMLwT63ziyQ9QdJL03ry7wK4NP2UhTq45yIqXfQFWuaxZRQZPEDbFyX8qqQjkvTX03NvGHcEYC3gnEz6uqSflvTCJB29gCVsN6V5RU4qc%2B5Ngq%2Bkew1NJezLOzjprGqg9RVJuyfp4kn3TfrepF%2BT26coe%2FOrteuZ55lJOmfSOEP%2FPgCr5xM06WWSDpb0f5SQSdL%2F97yEOljRkOF0XPNJurW5oZ2654NSCfv0Dk46rwxaeH9%2FcppKEbkW189JKj8EvpJ4%2FaMj5sWwflySXj5pTavyfQBWjydpnttWBRgenKTjepx%2B5FSFOnhZku5p0rmSHkZLrCTts%2Bj1NZ2%2Fb%2B%2FgpHWZ9HuS3oEtKUl3GmMaeIDci8cHNfxHJo2bvydO7gXJG2hsKQrA6vG4zV3Nt5F0QnKPzsIpR7djU3t6kk4zLx44KJWwaOP1ueQpOUtB5vbA%2B5GAnYNLMYyjzgFQ%2FL3piIUSpY9t81Y1jx%2BXovK9U9KFad3DvBR77WsRAVg9cdokfk0%2FJlcBb5Y8mnzhZNI1%2BcW4I5HaQ1QJC6nww8lTi1onk34zh3vUVTZsf4SC0CasJN6tG0na7B3DkwdAQXfMds362v9O0t%2FwSevXtr6%2FoQwYgNXTSZmHCODZeV3ySpYLJ5OeLvcofSV51DZv3aBsWOYSK5IrdJckfWlexpqHd1RSEJIQINhHPBMFB%2F8pmw0wHXwheY20oMyBAKyeHgVzMR8V4GFJ%2Boeept10GnOwArQ%2Bk3JfvqGphOYODBwZSCC%2FOy1fzeOXkJ4IFQCc%2BIyqR4aThP6FxDb9W%2F7LvQQAU5W0nreI5HpBBjrGJ0%2BT879LbY3%2FK%2BmPAKmtquZNc2YBWNNwa8ZrzUMX%2FkTSVcnDGZaCilScbSBq0kfyC3xm8nLNS00FwI4sg2xeuwpAQfIiuZwP0mT1758as0EknErawSFxibmnbhd5GhWf2xX3EqyJzYoA3PMyoB2RbVisoSLWQc7mjSUdxHXJq8wGNeBAAFYDJs1zibkaWEWMPzQ5ICyczD2Ar6t3RB6SSmjSCyQdU%2B4h2wpLwzY2p80ICQewwb5I9YU1kEoedoKKTNzTkyQBbIBV%2Bc4gbdESjLpb55hXbsDDyuchIyb9fPIijYxbNXj9VpJ%2BYuEPxEAWEIDV8UGZdF1Om1iqMAGT%2FiIHiW5XknkogEWRQXn8ES8%2BNiwqtgJU9Xil6yUBSoARAZbVBwCi2%2FN3k%2FQbGUTumSUiPHvVh4oaJf1jBimA6jsFQAFSdeBBLSRthhLNmAF%2BiR%2BvJO1XANY2dbzjR3Elhg%2FA6vAYzUu1IP7TFBU39dKQSf8q6W51m9oyApZJqFZ3ze7%2BykuHV20UYStCnVtT6UZVbDCXkug7eEgO4CXxHICqgxPj02yC61kDwaCEgKDCISlRO6wkQPOD%2BXNukr5dfVmLwdtXzn%2FA7%2FwKMJfm4VjihQRgdXg4RcjAK5P0xx1ONdXQJj2VwFAAIG2fNIuqMnUclrk9hoaltL%2FCm3Z%2FSeQl7ihXgQmYRfLh3w9MHiQ5lswN06hi1WeUh47wEMIJmBuQIIgSVe6qcuCcd0fowX3yp%2Fo3IQd1%2Bg95Gg05eUhPBHIS9InkxYcqFiX9dwFQH0xukN9sX2QQ4IVFBcVRQOLytWn7fMCpznKrXRyA1eGJF4C1VLWlTHppflmQAmjYsI1MekPOKTwkudq4KeXuyqhm0xiOT0vunSznxdb3zBy7VPe4Idl8K4MsoMAHVe9rqHspB2CaxzJRvI%2BcO6qAAlKlYbyckvgnHCCAx2eyUR6AHQVM1X3MS%2BgBHl%2Baql44iT%2F1780bsxLWArBSxvnK5Kk3QQ04EIDVgEmzXlJ0wnlE8i4uCydz1RR1CYDZEGLRRCXMcUp43igUhzQFYRuiNA2SCW3hUXlQm5CqcP2TV0dji8pjRskT6oEh0SH1lEZqVCn4tfYZFVtlnqQNoGKfokkq9qtRKTAADMndzAUwIVkBYqh2zDuKACYaWWz3SQ5Uc5H5%2FKylisgnabnqLj3X2Fvh5gCsjk65CBRFbdk7ee32hVOWiFDfvp%2B8K%2FJ2NA6wzG08J%2BRyJqTulHRYko5qsjnzqG1UxLrkc22WnF5b1uEyl4IAojvnv4RaoF5if6s%2Fv4AgYIxB%2FuysohLCgFGdWCg%2BdVUQCQs1EGmJ9mqfnReYcvgDBvhxH8wDqLIQaihhEKMIyQvb3fmb8JYfAGxnSJSjCN7Bg3Fj8EPBDw32tDXpNbnkupQUgNXRsZjbQXgpl6L8cbXNrDZdLumKNEJdMultVT0sSWdJelWuHlDv78cLzovyyST9ZRM25kRrosbLsQB08iopZwwI8T0qHSobIDUpwpzUFdYMUCFtAaxUoEDiQpqsAxSxUgAEYP1cSZ9Ifs9IyhUUUN3qH4CU%2F7dbli4B0Qqgbt6EH0t8TfXjwf4IHXnnsjQkCcDq4Kkx%2F6Um4fXy5C%2Fd0lABWBuqCJirbZ%2FIv8jkOpbVAwgdIEaJaO%2Fjk4drTEW2nm%2BH%2FQkiUpwcvM2eQwzbACwBl3zowAyYEYgLYWxH4gN0WH%2BdKoACpPhgCwNsiC4n5AA1j2j5CoCwYwF2SBn8v3GBpZvtHeBk3XyQ%2Bqp%2F8xfbHcBGyg2gyXwkNb9lxIDY0wBdIubHEXWyWCuS2ihCPb%2FJJmM8KPOfs6g8sPU98yys5TMuGrwCsKZ65ZpdbNIVWYo4OXng6NKQeY4cbnyMvqhKSEo88Lw4ZZld1gxI8ZB%2BuYkBftImC6mzfilBmtiLsDHxl%2FACwOWjSbra%2FEWq4qJ44albzktYJ%2FYEqLFursGuBihgZwMkkOZmASDG5QNQVv%2Bu%2FsI3pGnirNYAahyYm%2FS4rKquqePmwMiPAHTf5La2hVP%2B4eLZoEQOjgxU6YrwzlaFCXtfbwBWy4%2BHSWfIU1q2C8hseZqZhysAC8mGh6%2BUovhvqqHStgqg2qPNAoO2XkkBg%2FMrsx3nmuRS0xrVwIkKFwRbjosEZw%2BA3Sjw2oxHSD2AInYkHAFE%2FJdAhCoPAAF8pFPVKzHMxP%2BieOMbk6utZbL52ckBYunIXEsAbB9bAy8KP768zxzIAKwWHw%2Fz2CZinKC3J2mPFodvZaisEhK3VKWsINE8LSf8vk9ujyKJ%2BKTklUdbJZP2z949bD6ohsQjYVwGmDDGz%2FJMVkAL2AIy%2FC0%2FjE9oBJIlEhG2OUAJQ%2FSuyUvsdEo5Mh%2FDOPatMneTahPErCHdUk4Zh8jSkrk3F3MHwa8VoVZXGR37d%2Bn1nOXhWFpmLnphRW30pf21zL%2FqeJ4qulFZwsQ8pw7JZkOM1jz8zUnIGMjrauekYQmToG5UlVLDS48hGCJuixpYmwZslhMUNjzsTLfpEaz4kSDXEGmtktjemqQnFTmRFyUPCVl6Mvde4u0kNaok1OJ7pfWSP63uJQCrJXYW3jVsGLPYSVpayXzDmAeSEv%2F0L8klnrnJPEGYVmIlYcjl4UbCKAn7H8CGmx0wQvrYRubdsV%2FNvWm0kX3T9WYJD0P9N9LGuefea32ALFlRjobqEHUHw7Yod3NQJvwAjxzq1yDIHGCrGmSoiCSIv2NSNsOsmwvAmpVztftyvhut0d%2Bf%2FNAGSeb2IOw60K0wes%2ByEfM8O%2FIoiVovnzMCRQlVKL2nPPDU5iJIFAlvLJnnAB4q6di0Lmk1WqK5KsNLRYrNpWl84Gij8ZpeZBJhAlWeIkGx5DAS07Ytyt2kE7O08r7kQa2DI3N1G8cJcXCdNOINwGrhscgtprD9YBc6OnmO2GDJ3N7Dw3dUctd%2FIzJ%2FKVER4AO2vM2aKqDiAR7vSeuNOSbOY%2B49xIO1W5LeO%2FGGfEEOfMVGRwzY15I7Fnoh833SNBewQt3GuI7T4UspF%2FTL%2BZNIk4MuN2PSW3HWZMa%2BIa3bdFvhdQDWnGwsVBRG4oE8a0jdZkZt31wdI4J6rRTKOBaZdGD%2Brgo5IG6oThjEKxsTkhUG2kOTF7qbimrlkHdILrlMJHOjPlIcXsHeu0JXC8ztv%2BAnuZwQdbRo47VG5rFZpEw9IHm82yDJfO2Ekjy57QyPAKw5Hwnz4m7UO%2FpkrkRQqVNzjry42ws71sdSrWmnuX0O6Qm3PMnFJZHmwv5PlUSCc6txOvmFR0WlhtWoPn0jmZY9W2t5jml0CZlemG0OTpVUuKGCR1Gy%2BqAkvaKXRXUwiXkQKyr%2FickDdFujAKw5WVlk3y9l3NUs26vZsYiZwq6FIRjDedl1GIkSqeCUnI93cfLgzE6oAKztYrcmTVY4RF6W1iPkJ93W%2BvfmzgycGp9OG8EeCasq%2B%2FOu5DFPg6Riny9K0ovb3EQA1hzcNK8SgOpEYONStJ2fdTu5qB1R5L%2BfU2E2s0ERK3R68gTj3sjci4Y37Ya0MUdwnHR1ZE7B4fsHpfXI8t7WzURFjB7rv3dZ3K9ayArZsULC6vXpmjBZToglKbgSd7fV6l6mdW62lgxQVQWD6m9VQaC8FTWPUjEEZBJDtVdyo3zvVADWt5On3oylbFukBHJVQqYzV%2FuEdcAzAoqrooVPSN4RehzAVnasTa%2FrnflTTGgeoEsK2HOTh6C0RiFhzcBKk0gYrYq34XkiZmmD6JtLo7wkG1KpgYQ6Bc%2Br%2FDFmJ3KYqgdEZkM84HiS6s0qaD1V5diVq256f3UPsVUkCWNjqAMUdjhUOtJSSFWh288GO9YMLGvllgKwNq3Sae5FJJYLOxcAQAHFc1tZxBSDmHRctvVR9QCaGLJg3kIML%2BvEa6dYSq%2BXFh3OWw9tCMCa4SjNf7UxKOMB%2B1BOHkY1pDIAXjDKpJA02pvrfIZtcAsAVVUxOK%2FsLNxWPNaM6xonfVQqoaWN5YrX7slghWEbCYzaVvXaXW0uadw6cesTBV7Z%2B%2FgBwJBOCZ1NyTzGjFizpfmhmLTm8nvzkB68oPzg3aHqPjTNGJtdG4A1AyczYCH2Nql7BIjxKw%2FAITlBZcE21DFc7tg2IKQopKl6UbcqY37U%2F29yf7VTwJbASUr8Vm3Sx714VcDjqclLDy%2BUCglrpLfPpAOyVIiT4Iwk7d3ngk3CXkZeJlHtEOfyqSTtPs06ikDTeySXvgdD5pU%2FCCOhxv1vt73wAKwZOZo9OtQior4SCcT8G7Wvig0CYA5Onn4ySDLP1cMDuC3AcZEbKQBrQ7VUc%2B8fKiz0oeTNU3uj2vyo9wTdEs0%2BNeVAU8JGBuXIKRoGU1ONZiNrvR3bpACsNrm5gmOZ29tQbZ436wvYFlsKwLo%2BZek216g%2FuTBqb2hw0db8o8YZMf%2FcSeNF3azBqIU1wO6sYXAAVpdP8wqMbZ5mQbrFNpBY1LYKwPpekm6cjdqUOcZ5gKT77Fki6Jvux7wYYNXyi78PzWDe%2BvzmzTwwOeySPHl8acm8pDXOJ8pRX5hc2%2BiEArA6YetqDWqeckRazauT10FfCBWBo8yPN7PqE4hn7ZH1yg5tLTJXJKBuPP0SRxEq0OPbnN88nYkSLq9L3hZsKck8R5Ikd8D8lOTdtDujAKzOWLs6A5s3NCVMACIOi1Sk3ikDFik2FPuDqPV%2BZPJKD61TLg2DIf35xeDEpJXtv3CoELlOfa3WaAhqoXnVCTya4EjnYAVzA7Bae8RWeyDzODP6EJIreLfkLdx7p5zLSGYBZZW%2FmMa3t5prbSYRP7dP4fFDisCON66d1lzzjbq58BbePXnw7tJQTQ28LLmq3DkFYHXO4tWYIEs3gBRhF3hDH70o0OqKo7kpBDmTqGBVEUZiqOi7SBhLr7Ss3kJztY%2F6XdisepGsKsYHYPX6CA57sgxaGFerEI7Bg1YBUiQb06m6IiqiUgbn2EWdmnkCNM1AlsZbaNJJODcyT3rvChWAtaincaDzZtAikpzI%2Fssk7dl2GZmuWWMuQVER9TE5K6GaEglyrfceWQtN6211uV5z2xheSJwKlR2xyylHjm1eTohuUNgzIQJa75MkgL03CsDqjdWrM1ENtEhF2rftQm1tcyu3N0NiQeUjdWoDSCVPs1oqMgcGJD943IlzYdKGc7oTTTSoIAuok2Y0dQHGSfM0%2BT4AqwmX4poNHMiufiSRKl%2BSVvHPSF7TeynIPE2GcsQAVAlSZB%2Fw4h24jCBVMs88jITy262XG25ySLXcTEIt7r9IyTMAq8mpxTVjOWDS82immeNw6ApDpcxXJM8p651yhQyqwD4x9zkchCQ1jlHmTTxImr48bd%2B4o3Pe1sCq99zMURsMwOr82Fd%2FghwNf1TRnBXgIun7WUkiqLJzMm%2F%2BCkgRyFgRIQi0kT8meXDjIMncTkRg5sP7KpOT64mRm0nA8FKAFYcXgDXIR3g5F509bpRVqbqmdCJx5e48xP08ivCK3M%2Bv7G%2BIqvrmJBGdPngy6YLchHWPPmxHWbKinDPtut49bbWJLhkegNUld7fo2CZRapmGp3TTgQCui%2BnCkxuFfrMpa8yL2THOQbm4Yb2nYTUU4yNFnbkodbTpnqa9LgexHt5HC7maGvjxtF4Sadpld3J9AFYnbI1BM0pR5aGUuCrGAFh0vyEAtSKuxVaDG%2F92uSIqgYlUR60T11TpMTtIOj9Jx6wq14t4LBrNkmjcCZlnMtCHEm%2Fg0qiB5WYDsDo5%2Bhi05IB5b0O676DGUScMe0xTwniP9EQ1Bpqvvj55QcQtQ%2BbVa8mbvEbSnZL%2FbYXMwYlQj7JCKs1tiVFbOgrAWrojWe0F5RItlNG9Qtvn5SFhEXNUvYzUnqeR60JyFpftFEyiGQjVKXZqUmq5yfrNq8gSyV819KBCKnXYl7ZzeQBWk5ONa4IDC%2BaAuQqN%2BnvLNiSsWsdyquSSLzlThdQ%2BWROA1Se3Y67gwAwcyJkFqMZ0VJoLsLIKSIVWKlFAZycPrh0EBWAN4phikVudA%2BY2PErq7JwkaoJNTeYGdbryEK5AbBcVWk%2BbeqAF3hCAtUDmx9TBgaYcMOm1uewNeXxkEzQmk3bOSd2olBDq5UOGlrTOwgOwGh97XBgcWBwHcrWE0yW9K3nZmUZkblSvKqaSqE4nHrqWD5ICsAZ5bLHorcYBk3bJjR42tDgbxYssVdE8pOo6ffQye%2F%2BanmcAVlNOxXXBgQVzwDwU5LakJCXpnHHLMYl6ZaQsQdfnQoTHL3j5rUwfgNUKG2OQ4ED3HDDpRZKOyF3Ez80zXpfbgRFYSgoTXaYxzkMrIVWVnA3A6v45ixmCA61woCg1M2m8qySdkCQ6%2FqwUBWCt1HHGZladA%2BYNS0lxonQO6uEXJe0o6dJcpPCQ5I1vV5ICsFbyWGNTwYHV5EAA1mqea%2BwqOLCSHAjAWsljjU0FB1aTAwFYq3musavgwEpyIABrJY81NhUcWE0OBGCt5rnGroIDK8mBAKyVPNbYVHBgNTkQgLWa5xq7Cg6sJAcCsFbyWGNTwYHV5EAA1mqea%2BwqOLCSHAjAWsljjU0FB1aTAwFYq3musavgwEpy4AdJLjO%2FKqKeTwAAAABJRU5ErkJggg%3D%3D%0A"
    // request.send($data)
    request.send('sign=' + signature)

}

function displaySignature(pic){

    section = document.getElementById('signature')
    displayed = document.getElementById('displayed_sign')

    //Checking if a signature is already on the page before adding it.

    if (displayed == null){
        image = document.createElement("img");
        image.setAttribute("src", pic)
        image.setAttribute("alt", "votre signature")
        image.setAttribute("class", "mt-3")
        image.id = "displayed_sign"
        section.appendChild(image)  
    }
    if (displayed !== null){
        displayed.remove()
        image = document.createElement("img");
        image.setAttribute("src", pic)
        image.setAttribute("alt", "votre signature")
        image.setAttribute("class", "mt-3")
        image.id = "displayed_sign"
        section.appendChild(image)  
    }
}
