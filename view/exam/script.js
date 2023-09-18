console.log('a')
let filterDiv = document.querySelector('.filters')
let inputType = document.querySelector('.exam_type')

inputType.addEventListener('change', changeFiltersDiv)

function changeFiltersDiv(event){
  if(event.taret.value == 'personalized'){
    filterDiv.style.display = 'flex'
  }
}