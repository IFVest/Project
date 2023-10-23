var cardLessons = document.querySelectorAll(".card")
var isStudent = document.getElementById("isStudent").getAttribute("value")
var selectedLessonId = document.getElementById("selected_video_id").getAttribute("value")
var moduleId = document.getElementById('lesson_module_id').getAttribute("value")

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
                console.log(this.responseText)
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
    viewButton.lesson = lesson
    viewButton.innerHTML = "Visualizar"
    viewButton.addEventListener("click", function () {
        videoChange(lesson)
    })
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

function videoChange(lesson) {
    var selectedVideo = document.querySelector('.selected_video')
    selectedVideo.innerHTML = ''

    var h2 = document.createElement("h2")
    h2.innerHTML = lesson.title 
    h2.setAttribute("class", "selected_video_title")
    selectedVideo.appendChild(h2)
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

        h2.setAttribute("style", "display: inline-block")

        selectedVideo.appendChild(alterLink)
        selectedVideo.appendChild(deleteLink)
    }
    selectedVideo.innerHTML += "<br>"

    var video = document.createElement("iframe")
    video.setAttribute("width", "500px")
    video.setAttribute("height", "300px")
    video.setAttribute("src", lesson.url)

    selectedVideo.appendChild(video)
    selectedLessonId = lesson.id
    recreateLessonCards(moduleId)
}

function recreateLessonCards(moduleId) {
    var xhttp = new XMLHttpRequest()
    xhttp.open("GET", "LessonController.php?action=findLessonsByModuleId&moduleId=" + moduleId)
    xhttp.onload = function () {
        if (xhttp.status >= 200 && xhttp.status < 400) {
            var lessons = JSON.parse(this.responseText)

            buildLessonCards(lessons)
        }
    };
    xhttp.send();
}

function buildLessonCards(lessons) {
    var lessonsDiv = document.querySelector('.lessonsDiv')
    lessonsDiv.innerHTML = ''

    var h5 = document.createElement('h5')
    h5.setAttribute('class', 'lessons_title')
    h5.innerHTML = "Aulas"
    lessonsDiv.appendChild(h5)

    lessons.forEach(lesson => {
        if (selectedLessonId != lesson.id) {
            var cardLesson = document.createElement('div')
            cardLesson.setAttribute('class', 'card lesson')
            cardLesson.setAttribute('aria-expanded', "false")
            cardLesson.setAttribute('value', lesson.id)

            cardLesson.innerHTML += lesson.title
            
            var cardContent = document.createElement('div')
            cardContent.setAttribute('class','card-content')

            cardLesson.appendChild(cardContent)

            cardLesson.addEventListener("click", function () {
                showButtons(cardLesson, lesson)
            })

            lessonsDiv.appendChild(cardLesson)
        }
    })
}