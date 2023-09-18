let questionsAnalizesBtns = document.querySelectorAll('.questions-analizes-btn')
let questionsView = document.querySelectorAll('.questions-view')

questionsAnalizesBtns.forEach(element=>{
          element.addEventListener('click', (event)=>{
                    questionsView.forEach(elementDiv =>{
                              elementDiv.style.display = 'none'
                              if(('questions-view-' + event.target.name) == elementDiv.className.split(' ')[1]){
                                        elementDiv.style.display = 'flex'
                                        
                              }
                    })  
          })
})