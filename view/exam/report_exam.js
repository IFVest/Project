console.log('a')
let questionsAnalizesBtns = document.querySelectorAll('.questions-analizes-btn')
let questionsView = document.querySelectorAll('.questions-view')

questionsAnalizesBtns.forEach(element=>{
          element.addEventListener('click', (event)=>{
                    questionsView.forEach(elementDiv =>{
                              elementDiv.style.display = 'none'
                              console.log(event)
                              console.log('questions-view' + event.target.name)
                              console.log(elementDiv.className)
                              if(('questions-view' + event.target.name) == elementDiv.className){
                                        elementDiv.style.display = 'block'
                              }
                    })  
          })
})