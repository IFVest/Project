var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelector(".modules");

subjects.forEach((subject) =>
  subject.addEventListener("click", filterBySubject)
);
export function test(test){ console.log(test)}
export function filterBySubject(name) {
  console.log(name)
  // Pegar matéria selecionado e procurar todos os módulos relacionados a essa matéria
  subjects.forEach((subject) =>
    subject.selected ? (selectedSubject = subject.value) : ""
  );
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "LessonController.php?action=findModulesBySubject&subject=" + selectedSubject, true
  );
  xhttp.onload = function () {
    if (xhttp.status >= 200 && xhttp.status < 400) {
      modules = JSON.parse(this.responseText);
      // Com os módulos, chama o método setModules para colocá-los em outro select
      
      setModules(modules);
    }
  };
  xhttp.send();
}

export function setModules(subjectModules) {
  modulesDiv.innerHTML = "";
  var select = document.createElement("select");
  select.setAttribute("name", "lesson_modules");

  for (i = 0; i < subjectModules.length; i++) {
    var option = document.createElement("option");
    option.setAttribute("value", subjectModules[i].id);
    option.setAttribute("class", "lesson_module")
    option.innerHTML = subjectModules[i].name;

    select.appendChild(option);
  }

  modulesDiv.appendChild(select);
}

