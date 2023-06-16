var modulesDiv = document.querySelector(".modules");
var subjects = document.querySelectorAll(".subject");

subjects.forEach(subject => {
    subject.addEventListener("click", filterBySubject);
});

function filterBySubject(subjectButton) {
    var selectedSubject = subjectButton.currentTarget.innerHTML.trim()
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
    xhttp.onload = function () {
        if (xhttp.status >= 200 && xhttp.status < 400) {
            var modules = JSON.parse(this.responseText);

            createModuleTable(modules);
        }
    };
    xhttp.send();
}

function createModuleTable(modules){
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
        tdName.innerHTML = modules[i].name;
        tdDescription.innerHTML = modules[i].description
        tdAlter.innerHTML = "Alterar";
        tdDelete.innerHTML = "Deletar";

        tr.appendChild(tdName);
        tr.appendChild(tdDescription);
        tr.appendChild(tdAlter);
        tr.appendChild(tdDelete);
        thead.appendChild(tr);
    }
    table.appendChild(thead);
    modulesDiv.appendChild(table);

}