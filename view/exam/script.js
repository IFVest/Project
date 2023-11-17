console.log('a')
let filterDiv = document.querySelector('.filters')
let inputType = document.querySelector('.exam_type')

inputType.addEventListener('change', changeFiltersDiv)

function changeFiltersDiv(event){
  if(event.target.value == 'personalized'){
    filterDiv.style.display = 'flex'
  }
}

let examCreateButton = document.querySelector('.create-exam-btn')
examCreateButton.addEventListener('click', ()=>{
  examCreateButton.setAttribute('disabled', true)
  document.querySelector('.text-create').style.display = 'none'
  document.querySelector('.loading').style.display = 'flex'
})