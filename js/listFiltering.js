var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelectorAll(".modules");
var baseUrl = document.getElementById("base_url").getAttribute("value")

export var subjectFiltering = function (subjectButton) {
    filterBySubject(subjectButton.currentTarget, false);
};

subjects.forEach(subject => {
    subject.addEventListener("click", subjectFiltering);
});

export function filterBySubject(subjectButton, filterLesson) {

    var isExpanded = subjectButton.getAttribute("aria-expanded");

    if (isExpanded === "true") {
        isExpanded = true;
    }
    else if (isExpanded === "false") {
        isExpanded = false;
    }

    var selectedSubject = subjectButton.innerHTML.trim();

    // precisa converter string para boolean
    if (!isExpanded) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
        xhttp.onload = function () {
            if (xhttp.status >= 200 && xhttp.status < 400) {
                var modules = JSON.parse(this.responseText);
                if (modules.length != 0) {
                    // filterLesson serve para, ao invés de mostrar uma tabela contendo todos
                    // os módulos, mostra-os em botões que ao serem clicados mostram uma tabela
                    // de aulas referentes a ele
                    if (filterLesson) {
                        createModulesButtons(modules, selectedSubject);
                    }
                    else {
                        createModuleTable(modules, selectedSubject);
                    }

                    subjectButton.setAttribute("aria-expanded", true);
                } else {
                    alert("Matéria não possui módulos.");
                }

            }
        };
        xhttp.send();
    }
    else {
        var subjectModulesDiv = document.querySelector("#" + selectedSubject);
        subjectModulesDiv.innerHTML = '';
        subjectButton.setAttribute("aria-expanded", false);
    }
}

function createModulesButtons(modules, subject) {
    modulesDiv.forEach(module => {
        module.innerHTML = "";
    });

    var subjectModulesDiv = document.querySelector("#" + subject);

    // Criar módulos em botões com uma div referente às suas aulas logo abaixo do botão
    modules.forEach(module => {
        let moduleDiv = document.createElement("div");
        moduleDiv.classList.add("col-md-6");

        let moduloCard = document.createElement("div");
        let moduleLessonsDiv = document.createElement("div");

        moduloCard.setAttribute("value", module.id);
        moduloCard.setAttribute("id", module.name);

        moduloCard.classList.add("card");
        moduloCard.classList.add("module");
        moduloCard.classList.add("ps-3");
        moduloCard.classList.add("pt-3");
        moduloCard.classList.add("pb-3");
        moduloCard.classList.add("mb-4");
        // moduloCard.classList.add("me-4");

        moduloCard.setAttribute("aria-expanded", false);
        moduloCard.innerHTML = module.name;


        moduleLessonsDiv.setAttribute("class", "lessons");
        let moduleLessonsId = module.name + "-lessons";
        moduleLessonsDiv.setAttribute("id", moduleLessonsId.replace(/\s/g, '_'));
        moduleDiv.appendChild(moduloCard);
        moduleDiv.appendChild(moduleLessonsDiv);
        subjectModulesDiv.appendChild(moduleDiv);
        moduloCard.addEventListener("click", filterByModule);
    })
}

function filterByModule(moduleClick) {
    var moduleButton = moduleClick.currentTarget;
    var moduleId = moduleButton.getAttribute("value");
    var moduleName = moduleButton.getAttribute("id");
    var isExpanded = moduleButton.getAttribute("aria-expanded");

    if (isExpanded === "true") {
        isExpanded = true;
    }
    else if (isExpanded === "false") {
        isExpanded = false;
    }

    if (!isExpanded) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "LessonController.php?action=findLessonsByModuleId&moduleId=" + moduleId, true);
        xhttp.onload = function () {
            if (xhttp.status >= 200 && xhttp.status < 400) {
                var lessons = JSON.parse(this.responseText);
                if (lessons.length != 0) {
                    moduleButton.setAttribute("aria-expanded", true);
                    window.location.href = baseUrl + "/controller/LessonController.php?action=showModuleLessons&moduleId=" + moduleId
                } else {
                    alert("Módulo não possui aulas.");
                }
            }
        };
        xhttp.send();
    }
    else {
        var moduleLessonsDiv = document.querySelector("#" + moduleName.replace(/\s/g, '_') + "-lessons");
        moduleLessonsDiv.innerHTML = '';
        moduleButton.setAttribute("aria-expanded", false);
    }

}

async function createLessonTable(lessons, videoUrl) {    
    console.log(window.location)
    var lessonsDiv = document.querySelector('.lessonsDiv')
    var lessonsCardsDiv = document.createElement('div')
    lessonsCardsDiv.setAttribute('class', 'lesson_cards')
    lessons.forEach(lesson => {
        let lessonDiv = document.createElement("div");
        lessonDiv.classList.add("col-md-6");

        let lessonCard = document.createElement("div");

        lessonCard.setAttribute("value", lesson.id);
        lessonCard.setAttribute("id", lesson.name);

        lessonCard.classList.add("card");
        lessonCard.classList.add("module");
        lessonCard.classList.add("ps-3");
        lessonCard.classList.add("pt-3");
        lessonCard.classList.add("pb-3");
        lessonCard.classList.add("mb-4");
        // moduloCard.classList.add("me-4");

        lessonCard.setAttribute("aria-expanded", false);
        lessonCard.innerHTML = lesson.name;

        lessonsCardsDiv.appendChild(lessonCard)
        console.log(lessonCard)
        // var lessonsDiv = document.querySelectorAll(".lessons");
        // lessonsDiv.forEach(lesson => {
        //     lesson.innerHTML = "";
        // })

    })
}

function showVideo(videoUrl) {
    var lessonVideoDiv = document.querySelector(".video");
    lessonVideoDiv.classList.add("youtube-video-container");
    lessonVideoDiv.innerHTML = "";
    var video = document.createElement("iframe");
    video.setAttribute("src", videoUrl);
    video.setAttribute("width", "500px");
    video.setAttribute("height", "500px");
    lessonVideoDiv.appendChild(video);

    var lessonModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
    });


    lessonModal.show();
}

export function createModuleTable(modules, subject) {
    modulesDiv.forEach(module => {
        module.innerHTML = "";
    });

    var subjectModulesDiv = document.querySelector("#" + subject);
    var table = document.createElement("table");
    table.setAttribute("name", "modulesTable");
    var thead = document.createElement("thead");
    var tbody = document.createElement("tbody");
    var thName = document.createElement("th");
    var thDescription = document.createElement("th");
    var thAlter = document.createElement("th");
    var thDelete = document.createElement("th");
    thName.innerHTML = "Name";
    thDescription.innerHTML = "Description";
    thAlter.innerHTML = "Alterar";
    thDelete.innerHTML = "Deletar";

    // T-head
    thead.appendChild(thName);
    thead.appendChild(thDescription);
    thead.appendChild(thAlter);
    thead.appendChild(thDelete);
    table.appendChild(thead);

    // T-body
    for (let i = 0; i < modules.length; i++) {
        let tr = document.createElement("tr");
        let tdName = document.createElement("td");
        let tdDescription = document.createElement("td");
        let tdAlter = document.createElement("td");
        let tdDelete = document.createElement("td");
        var linkAlter = document.createElement("a");
        var linkDelete = document.createElement("a");
        tdName.innerHTML = modules[i].name;
        tdDescription.innerHTML = modules[i].description;
        linkAlter.setAttribute("href", "ModuleController.php?action=edit&id=" + modules[i].id);
        linkAlter.innerHTML = "Alterar";
        linkDelete.setAttribute("href", "ModuleController.php?action=delete&id=" + modules[i].id);
        linkDelete.innerHTML = "Deletar";

        tdAlter.appendChild(linkAlter);
        tdDelete.appendChild(linkDelete);
        tr.appendChild(tdName);
        tr.appendChild(tdDescription);
        tr.appendChild(tdAlter);
        tr.appendChild(tdDelete);
        tbody.appendChild(tr);
    }
    table.appendChild(tbody);
    subjectModulesDiv.appendChild(table);

}