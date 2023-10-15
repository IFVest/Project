var cardLessons = document.querySelectorAll(".card")
var isStudent = document.getElementById("isStudent").getAttribute("value")

cardLessons.forEach(lesson => {
    lesson.addEventListener("click", test)
})

function test(e) {
    var lessonCard = e.target
    var lessonId = lessonCard.getAttribute("value")
    var isCollapsed = lessonCard.getAttribute("aria-expanded")

    if (isCollapsed == "true") {
        lessonCard.childNodes[1].innerHTML = ""
        lessonCard.setAttribute("aria-expanded", "false")
    }
    else {
        var xhttp = new XMLHttpRequest()
        xhttp.open("GET", "LessonController.php?action=getByLessonId&lessonId=" + lessonId)
        xhttp.onload = function () {
            if (xhttp.status >= 200 && xhttp.status < 400) {
                var lesson = JSON.parse(this.responseText)
                showButtons(lessonCard, lesson)
            }
        };
        xhttp.send();
    }
}

function showButtons(lessonCard, lesson) {
    lessonCard.setAttribute("aria-expanded", "true")
    var cardContent = lessonCard.childNodes[1]
    cardContent.innerHTML = ""
    
    var divisory = document.createElement("hr")
    cardContent.appendChild(divisory)
    
    var viewButton = document.createElement("button")
    viewButton.innerHTML = "Visualizar"
    cardContent.appendChild(viewButton)
    
    if (!isStudent) {
        var alterLink = document.createElement('a')
        var alterButton = document.createElement("button")
        alterLink.setAttribute("href", "LessonController.php?action=edit&id=" + lesson.id)
        alterButton.innerHTML = "Alterar"
        alterLink.appendChild(alterButton)

        var deleteLink = document.createElement('a')
        var deleteButton = document.createElement("button")
        deleteButton.innerHTML = "Deletar"
        deleteLink.setAttribute("href", "LessonController.php?action=delete&id=" + lesson.id)
        deleteLink.appendChild(deleteButton)

        cardContent.appendChild(alterLink)
        cardContent.appendChild(deleteLink)
    }
    
    
}