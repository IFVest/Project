let allFilters = document.querySelector('.allFilters')
let filterDiv = document.querySelector('.filters')
let inputType = document.querySelectorAll('.exam_type')
let newFilter = document.querySelector('.new-filter-button')
let numFilters = 1

let disponibleSubjects = getSubjects()

function getSubjects(){
  let subjects = []
  var xhttpPrimary = new XMLHttpRequest();
  xhttpPrimary.open("GET", "SubjectsController.php?action=findAll", false);
  xhttpPrimary.onload = function (){
    if (xhttpPrimary.status >= 200 && xhttpPrimary.status < 400) {
      subjects = this.responseText.slice(0, -1).split(' ');
    }
  };
  xhttpPrimary.send();

  return subjects
}


inputType.forEach(element =>{
  element.addEventListener('click', (event)=>{
    allFilters.style.display = (event.target.value == 'personalized')? 'flex' : 'none';
  })
})


newFilter.addEventListener('click', ()=>{
  numFilters++
  let divParam = document.createElement('div')
  divParam.setAttribute('class', 'card params text-center col-11')

  let select = document.createElement('select')
  select.setAttribute('class', 'subject-select form-select card-header')
  select.setAttribute('name', `subject${numFilters}`)
  select.setAttribute('id', `subject${numFilters}`)

  for(let sub of disponibleSubjects){
    if (disponibleSubjects.indexOf(sub) != -1){
      var option = document.createElement("option");
      option.setAttribute("value", sub);
      option.setAttribute("class", 'subject-option');
      option.innerHTML = sub;
      select.appendChild(option);
    }
  }
  select.addEventListener('change', (event) =>{filterBySubject(event.target.value, numFilters)})

  let divCardBody = document.createElement('div')
  divCardBody.setAttribute('class', 'card-body')

  let label = document.createElement('label')
  label.setAttribute('for', `modules-filter-div${numFilters}`)
  label.innerHTML = 'Módulo: '

  let divModulesSelect = document.createElement('div')
  divModulesSelect.setAttribute('class', `modules-filter-div${numFilters}`)
  divModulesSelect.setAttribute('id', `modules-filter-div${numFilters}`)

  let inputNumQuestions = document.createElement('input')
  inputNumQuestions.setAttribute('class', `col-10 num-questions${numFilters}`)
  inputNumQuestions.setAttribute('name', `num-questions${numFilters}`)
  inputNumQuestions.setAttribute('value', '9')

  divCardBody.appendChild(label)
  divCardBody.appendChild(divModulesSelect)
  divCardBody.appendChild(document.createElement('hr'))
  divCardBody.appendChild(inputNumQuestions)

  divParam.appendChild(select)
  divParam.appendChild(divCardBody)
  filterDiv.appendChild(divParam)
})


let subjectsSelect = document.querySelectorAll(".subject-select");
startPage();
export function startPage(){
  subjectsSelect.forEach((subjectSelect) => {
    subjectSelect.addEventListener("change", (event) => {
      filterBySubject(event.target.value, subjectSelect.name.split('subject')[1])
    })
  })
}

export function filterBySubject(selectedSubject, aditionalStringName) {
  // Pegar matéria selecionado e procurar todos os módulos relacionados a essa matéria
  handleDisponibleModules()
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
  xhttp.onload = function () {
    if (xhttp.status >= 200 && xhttp.status < 400) {
      let modules = JSON.parse(this.responseText);
      createModulesSelect(modules, aditionalStringName);
    }
  };
  xhttp.send();
}

export function createModulesSelect(modules, aditionalStringName) {
  let modulesDiv = document.querySelector(`.modules-filter-div${aditionalStringName}`);
  modulesDiv.innerHTML = ''
  
  let selectAttribute = "module-select form-select";
  let optionAttribute = "exam_module"

  let select = document.createElement("select");
  select.setAttribute("name", 'subject-select'+aditionalStringName);
  select.setAttribute("id", 'subject-select'+aditionalStringName);
  select.setAttribute("class", selectAttribute);

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

  modulesDiv.appendChild(select);
}

function handleDisponibleModules(){
  let freeSubjects = getSubjects()

  let allSelectsSubject = document.querySelectorAll('.subject-select')
  let selectedSubjects = [] 
  allSelectsSubject.forEach(element =>{
    selectedSubjects.push(element.value)
  })

  freeSubjects = freeSubjects.filter(element => selectedSubjects.indexOf(element) == -1)

  allSelectsSubject.forEach(element =>{
    let options = element.childNodes.map(child => {return child.value})
    freeSubjects.map(sub =>{
      if(options.indexOf(sub) == -1){
        // se a matéria não está nas opções
        let option = document.createElement('option')
        option.setAttribute("value", sub);
        option.setAttribute("class", 'subject-option');
        option.innerHTML = sub;
        element.appendChild(option);
      }else{
        
      }
    })

    
    // element.childNodes.forEach(option =>{
    //   if(freeSubjects.indexOf(option.value) == -1){
    //     element.removeChild(option)
    //   }else{

    //   }
    //   if(freeSubjects.indexOf(option.value) == -1 && element.value != option.value){
    //     element.removeChild(option)
    //   }
    // })

    // element.innerHTML = ''
    // freeSubjects.forEach(sub =>{
    //   let option = document.createElement('option')
    //   option.setAttribute("value", sub);
    //   option.setAttribute("class", 'subject-option');
    //   option.innerHTML = sub;
    //   element.appendChild(option);
    // })
    // let currentValue = document.createElement('option')
    // console.log(element.value)
    // currentValue.setAttribute("value", element.value);
    // currentValue.setAttribute("class", 'subject-option');
    // currentValue.setAttribute("selected", 'selected');
    // currentValue.innerHTML = element.value;
    // element.appendChild(currentValue);
  })

}



