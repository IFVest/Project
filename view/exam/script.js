import * as flt from "../../js/filterByModule.js"

var filterContainer = document.querySelector('.filters')
var personalizedContainerExamDiv = document.querySelector('.container-personalized')
var typeExamRadio = document.querySelectorAll('.exam_type');
let subjectSelect = document.querySelector(".subjects");

typeExamRadio.forEach(element =>{

  element.addEventListener('click', (event)=>{
    console.log(event.target.value)
    if(event.target.value == 'personalized'){
      filterContainer.style.display = 'flex'
      personalizedContainerExamDiv.style.display = 'block'
      subjectSelect.addEventListener("click", () => {
        flt.startPage(true, true)
      })
    }else{
      personalizedContainerExamDiv.style.display = 'none'
      filterContainer.style.display = 'none'
    }
  })
})


let newFilterButton = document.querySelector('.new-filter-button')

newFilterButton.addEventListener('click', (event)=>{
  event.preventDefault()
  // Create the div
  let newDiv = document.createElement('div')
  newDiv.setAttribute('class', 'container-personalized')
  newDiv.style.border = '1px solid black'

  // Create the Select
  let newSelect = document.createElement('select')
  newSelect.setAttribute('class', 'subjects')
  newSelect.setAttribute('name', 'subjects')

  // Create the Options
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "SubjectController.php?action=findAllSubjects", true );
  xhttp.onload = function () {
    if (xhttp.status >= 200 && xhttp.status < 400) {
      let subjects = JSON.parse(this.responseText);
      for(subj of subjects){
        let option = document.createElement('option')
        option.setAttribute('value', subj)
        option.setAttribute('class', 'subject')
        option.innerHTML = subj
        newSelect.appendChild(option);
      }
    }
  };

  // Create Module Div
  let moduleDiv = document.createElement('div')
  moduleDiv.setAttribute('class', 'modules')

  xhttp.send();

})