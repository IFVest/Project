var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelector(".modules");
var lessonsDiv = document.querySelector(".lessons");

export var moduleFiltering = function() {
  filterBySubject(false);
}

subjects.forEach((subject) =>
  {
    subject.addEventListener("click", moduleFiltering)
  }
);

export function filterBySubject(filterModule) {
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
  modulesDiv.innerHTML = "";

  if (filterModule == false) {
    selectAttribute = "lesson_modules";
    optionAttribute = "lesson_module";
  } else if (filterModule == true) {
    selectAttribute = "week_modules";
    optionAttribute = "week_module";
  }

  var select = document.createElement("select");
  select.setAttribute("name", selectAttribute);
  select.setAttribute("class", selectAttribute);

  for (let i = 0; i < object.length; i++) {
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
  var week_moduleId = document.querySelector(".week_modules").value;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "LessonController.php?action=findLessonsByModuleId&moduleId=" + week_moduleId, true);
  xhttp.onload = function () {

    if (xhttp.status >= 200 && xhttp.status < 400) {
      let lessons = JSON.parse(this.responseText);
      // Mostra as aulas com checkboxes para serem escolhidas as aulas
      showLessons(lessons);
    }
  };
  xhttp.send();
}

function showLessons(lessons) {
  lessonsDiv.innerHTML = "";

  for(let i = 0; i < lessons.length; i++) {
    var card = document.createElement("div");
    card.innerHTML = lessons[i].title;
    lessonsDiv.appendChild(card);
    card.setAttribute("class", "lesson-card");
    card.setAttribute("style", "width: 18rem");
    
    // Video
    var lessonVideo = document.createElement("iframe");
    lessonVideo.setAttribute("src", lessons[i].url);
    lessonVideo.setAttribute("width", "250");
    lessonVideo.setAttribute("height", "200");

    card.appendChild(lessonVideo);

    // Corpo 
    var cardBody = document.createElement("div")
    cardBody.setAttribute("class", "card-body");
    var lessonTitle = document.createElement("h5")
    var title = document.createTextNode(lessons[i].title);
    lessonTitle.appendChild(title);
    
    cardBody.appendChild(lessonTitle);
    card.appendChild(cardBody);
    lessonsDiv.append(card);
  }
}

