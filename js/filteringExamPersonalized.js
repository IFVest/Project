var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelector(".modules");
var lessonsDiv = document.querySelector(".lessons");
var selectedLessonsDiv = document.querySelector(".selected-lessons");


export function filterBySubject(aditionalStringName='') {
  // Pegar matéria selecionado e procurar todos os módulos relacionados a essa matéria
  let selectedSubject = "";
  subjects.forEach((subject) => {
      if(subject.selected) {
        selectedSubject = subject.value;
      }
    }
  );

  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
  xhttp.onload = function () {
    if (xhttp.status >= 200 && xhttp.status < 400) {
      let modules = JSON.parse(this.responseText);
      // Com os módulos, chama o método setModules para colocá-los em outro select
      createSelect(modules, filteringType, aditionalStringName);
    }
  };
  xhttp.send();
}

export function createSelect(modules, filteringType, aditionalStringName='') {
  let selectAttribute = "";
  let optionAttribute = "";
  modulesDiv.innerHTML = "";

  switch (filteringType) {
    case "lesson":
      selectAttribute = "lesson_modules";
      optionAttribute = "lesson_module";
      break;
    case "week":
      selectAttribute = "week_modules";
      optionAttribute = "week_module";
      break;
    case "exam_personalized":
      selectAttribute = "exam_modules";
      optionAttribute = "exam_module";
      break;
    default:
      return;
  }

  let select = document.createElement("select"+aditionalStringName);
  select.setAttribute("name", selectAttribute+aditionalStringName);
  select.setAttribute("class", selectAttribute+aditionalStringName);

  let default_option = document.createElement("option");
  default_option.setAttribute("value", 'all');
  default_option.setAttribute("class", optionAttribute+aditionalStringName);
  default_option.innerHTML = "TODOS"
  select.appendChild(default_option);
  for(let i = 0; i < modules.length; i++) {
    var option = document.createElement("option");

    if (filteringType == "week") {
      option.addEventListener("click", filterByWeekModule);
    }
    
    option.setAttribute("value", modules[i].id);
    option.setAttribute("class", optionAttribute+aditionalStringName);
    option.innerHTML = modules[i].name;
    select.appendChild(option);
  }
  modulesDiv.appendChild(select);
}

function filterByWeekModule(){
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