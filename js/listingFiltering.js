var modulesDiv = document.querySelector(".modules");
var subjects = document.querySelectorAll(".subject");

subjects.forEach(subject => {
    subject.addEventListener("click", filterBySubject);
});

function filterBySubject(subjectButton) {
    var selectedSubject = subjectButton.currentTarget.innerHTML

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "ModuleController.php?action=findModulesBySubject&subject=" + selectedSubject, true);
    xhttp.onload = function () {
        if (xhttp.status >= 200 && xhttp.status < 400) {
            console.log(JSON.parse(this.responseText));
        }
    };
    xhttp.send();
}

function test() {
    console.log("oi");
}