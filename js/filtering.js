var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelector(".modules");
var lessonsDiv = document.querySelector(".lessons");
var selectedLessonsDiv = document.querySelector(".selected-lessons");

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
  xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true
  );
  xhttp.onload = function () {

    if (xhttp.status >= 200 && xhttp.status < 400) {
      let modules = JSON.parse(this.responseText);
      // Com os módulos, coloca-os em um select.
      // filterModule serve para saber se ao selecionar módulo no select aparecerá 
      // as aulas referente a ele. (utilizada pela classe de semana de estudos)
      
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

    // Adicionar função de listar aulas
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
    var checkbox = document.createElement("input");
    checkbox.setAttribute("type", "checkbox");
    checkbox.setAttribute("name", "week_lessons[]");
    checkbox.setAttribute("value", lessons[i].id);
    checkbox.setAttribute("id", lessons[i].title);
    var label = document.createElement("label");
    label.setAttribute("for", lessons[i].title);
    label.innerHTML = lessons[i].title;
    cardBody.appendChild(label);
    cardBody.appendChild(checkbox);
    card.appendChild(cardBody);
    lessonsDiv.append(card);

    checkbox.addEventListener("change", function() {
      if (this.checked) {
        showSelectedLesson(lessons[i]);
      }
    });
  }
}

function showSelectedLesson(lesson) {
  var selectedLessonCard = document.createElement("div");
  selectedLessonCard.setAttribute("class", "lesson-card");

  // Card video
  var selectedLessonVideo = document.createElement("iframe");
  selectedLessonVideo.setAttribute("src", lesson.url);
  selectedLessonVideo.setAttribute("width", "250");
  selectedLessonVideo.setAttribute("height", "200");

  // Card body
  var selectedLessonBody = document.createElement("div");
  var removeButton = document.createElement("button");
  var inputId = document.createElement("input");
  inputId.setAttribute("type", "hidden");
  inputId.setAttribute("name", "week_lessons[]");
  inputId.setAttribute("value", lesson.id);
  removeButton.innerHTML = "Remover";
  selectedLessonBody.appendChild(removeButton);
  selectedLessonBody.setAttribute("class", "card-body");
  removeButton.addEventListener("click", function() {
    selectedLessonCard.remove()
  });
  selectedLessonBody.appendChild(inputId);
  selectedLessonCard.appendChild(selectedLessonVideo);
  selectedLessonCard.appendChild(selectedLessonBody);
  
  selectedLessonsDiv.appendChild(selectedLessonCard);
}


