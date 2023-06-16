var subjects = document.querySelectorAll(".subject");
var modulesDiv = document.querySelectorAll(".modules");

export var subjectFiltering = function(subjectButton) {
    filterBySubject(subjectButton.currentTarget, false);
};

subjects.forEach(subject => {
    subject.addEventListener("click", subjectFiltering);
});

export function filterBySubject(subjectButton, filterLesson) {
    var selectedSubject = subjectButton.innerHTML.trim()
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
    xhttp.onload = function () {
        if (xhttp.status >= 200 && xhttp.status < 400) {
            var modules = JSON.parse(this.responseText);
            
            if (filterLesson) {
                createModulesButtons(modules, selectedSubject);
            }
            else {
                createModuleTable(modules, selectedSubject);
            }
        }
    };
    xhttp.send();
}

function createModulesButtons(modules, subject) {
    modulesDiv.forEach(module => {
        module.innerHTML = "";
    });

    var subjectModulesDiv = document.querySelector("#" + subject);
    
    // modules.forEach(module => {
    //     let moduleButton = document.createElement("button");
    //     let module
    // })
}

export function createModuleTable(modules, subject){
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
    for(let i = 0; i < modules.length; i++) {
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
        thead.appendChild(tr);
    }
    table.appendChild(thead);
    subjectModulesDiv.appendChild(table);

}