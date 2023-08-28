let allFilters = document.querySelector('.allFilters')
let filterDiv = document.querySelector('.filters')
let inputType = document.querySelectorAll('.exam_type')
let newFilter = document.querySelector('.new-filter-button')
let numFilters = 1

inputType.forEach(element =>{
  element.addEventListener('click', (event)=>{
    allFilters.style.display = (event.target.value == 'personalized')? 'flex' : 'none';
  })
})

newFilter.addEventListener('click', ()=>{
  numFilters++
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "SubjectsController.php?action=findAll", true);
  xhttp.onload = function (){
    if (xhttp.status >= 200 && xhttp.status < 400) {
      let divParam = document.createElement('div')
      divParam.setAttribute('class', 'card params text-center col-11')

      console.log(this.responseText)
      let subjects = this.responseText.slice(0, -1).split(' ');

      let select = document.createElement('select')
      select.setAttribute('class', 'subject-select form-select card-header')
      select.setAttribute('name', `subject${numFilters}`)
      select.setAttribute('id', `subject${numFilters}`)

      for(let sub of subjects){
        var option = document.createElement("option");
        option.setAttribute("value", sub);
        option.setAttribute("class", 'subject-option');
        option.innerHTML = sub;
        select.appendChild(option);
      }

      let divCardBody = document.createElement('div')
      divCardBody.setAttribute('class', 'card-body')

      let label = document.createElement('label')
      label.setAttribute('for', `modules-filter-div${numFilters}`)

      let divModulesSelect = document.createElement('div')
      divModulesSelect.setAttribute('class', `modules-filter-div${numFilters}`)
      divModulesSelect.setAttribute('id', `modules-filter-div${numFilters}`)

      divCardBody.appendChild(label)
      divCardBody.appendChild(divModulesSelect)

      divParam.appendChild(select)
      divParam.appendChild(divCardBody)
      filterDiv.appendChild(divParam)
    }
  };
  xhttp.send();
})


let subjectsSelect = document.querySelectorAll(".subject-select");

startPage();
export function startPage(){
  subjectsSelect.forEach((subjectSelect) => {
    // subjectSelect.removeEventListener("change", moduleFiltering);
    subjectSelect.addEventListener("change", (event) => {
      filterBySubject(event.target.value, subjectSelect.name.split('subject')[1])
    })
  })
}

export function filterBySubject(selectedSubject, aditionalStringName) {
  // Pegar matéria selecionado e procurar todos os módulos relacionados a essa matéria
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
  xhttp.onload = function () {
    if (xhttp.status >= 200 && xhttp.status < 400) {
      let modules = JSON.parse(this.responseText);
      // Com os módulos, chama o método setModules para colocá-los em outro select
      createSelect(modules, aditionalStringName);
    }
  };
  xhttp.send();
}

export function createSelect(modules, aditionalStringName) {
  let modulesDiv = document.querySelector(`.modules-filter-div${aditionalStringName}`);
  console.log(modulesDiv.previousElementSibling)
  let selectAttribute = "exam_modules";
  let optionAttribute = "exam_module"

  let select = document.createElement("select");
  select.setAttribute("name", selectAttribute+aditionalStringName);
  select.setAttribute("class", 'form-select '+ selectAttribute+aditionalStringName);

  let default_option = document.createElement("option");
  default_option.setAttribute("value", 'all');
  default_option.setAttribute("class", optionAttribute);
  default_option.innerHTML = "TODOS"

  select.appendChild(default_option);

  for(let currentModule of modules) {
    let option = document.createElement("option");
    option.setAttribute("value", currentModule.id);
    option.setAttribute("class", optionAttribute);
    option.innerHTML = currentModule.name;
    select.appendChild(option);
  }
  modulesDiv.replaceChild()
  modulesDiv.appendChild(select);
}



