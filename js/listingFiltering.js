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

            createTable(object);
        }
    };
    xhttp.send();
}

function createTable(object){

}