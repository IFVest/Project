var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelector(".modules");

subjects.forEach((subject) =>
  subject.addEventListener("click", filterBySubject)
);

export function filterBySubject(filterModule = false) {
  // Pegar matéria selecionado e procurar todos os módulos relacionados a essa matéria
  let selectedSubject = "";
  subjects.forEach((subject) =>
    {
      if(subject.selected) {
        selectedSubject = subject.value;
      }
    }

  );

  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "LessonController.php?action=findModulesBySubject&subject=" + selectedSubject, true
  );
  xhttp.onload = function () {

    if (xhttp.status >= 200 && xhttp.status < 400) {
      let modules = JSON.parse(this.responseText);
      // Com os módulos, chama o método setModules para colocá-los em outro select
      
      createSelect(modules, filterModule);
    }
  };
  xhttp.send();
}

export function createSelect(object, filterModule) {
  var selectAttribute = "";
  var optionAttribute = "";
  if (filterModule == false) {

    modulesDiv.innerHTML = "";
    selectAttribute = "lesson_modules";
    optionAttribute = "lesson_module";
  } else if (filterModule == true) {
    selectAttribute = "week_modules";
    optionAttribute = "week_module";
  }

  var select = document.createElement("select");
  select.setAttribute("name", selectAttribute);
  select.setAttribute("class", selectAttribute);

  for (var i = 0; i < object.length; i++) {
    var option = document.createElement("option");

    if (filterModule) {
      option.addEventListener("click", filterByModule);
    }

    option.setAttribute("value", object[i].id);
    option.setAttribute("class", optionAttribute);
    option.innerHTML = object[i].name;

    select.appendChild(option);
  }

  modulesDiv.appendChild(select);
}

function filterByModule(){
  var lesson_moduleId = document.querySelector(".lesson_modules").value;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "LessonController.php?action=findLessonsByModuleId&moduleId=" + lesson_moduleId, true);
  xhttp.onload = function () {

    if (xhttp.status >= 200 && xhttp.status < 400) {
      console.log('parq')
      // let modules = JSON.parse(this.responseText);
      // // Com os módulos, chama o método setModules para colocá-los em outro select
      
      // setModules(modules, test);
    }
  };
  xhttp.send();
}

