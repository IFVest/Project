let btnAlts = document.querySelectorAll('.btn-alt')

btnAlts.forEach(element =>{
    element.addEventListener('click', ()=>{
        element.style.color = 'blue'
    })
})