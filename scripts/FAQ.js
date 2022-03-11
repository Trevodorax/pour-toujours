const question_titles = document.querySelectorAll('section');

question_titles.forEach(function(element){
    element.addEventListener('click', function(){
        element.classList.toggle('open-section');
    })
})
