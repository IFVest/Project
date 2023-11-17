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
    viewButton.setAttribute("class", "btn btn-secondary")
    viewButton.addEventListener("click", function () {
        videoChange(lesson)
    })
    cardContent.appendChild(viewButton)
    
    if (!isStudent) {
        var alterLink = document.createElement('a')
        var alterButton = document.createElement("button")
        alterLink.setAttribute("href", "LessonController.php?action=edit&id=" + lesson.id)
        alterLink.innerHTML = "Alterar"
        alterLink.setAttribute("class", "btn btn-secondary")
        //alterLink.appendChild(alterButton)

        var deleteLink = document.createElement('a')
        //var deleteButton = document.createElement("button")
        deleteLink.innerHTML = "Deletar"
        deleteLink.setAttribute("class", "btn btn-secondary")
        deleteLink.setAttribute("href", "LessonController.php?action=delete&id=" + lesson.id)
        //deleteLink.appendChild(deleteButton)

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

    h2.innerHTML += "<br>"
    var video = document.createElement("iframe")
    video.setAttribute("width", "500px")
    video.setAttribute("height", "300px")
    video.setAttribute("src", lesson.url)

    h2.appendChild(video)
    selectedLessonId = lesson.id

    if (!isStudent) {
        var otherH2 = document.createElement("h2")

        var alterLink = document.createElement('a')
        
        //botao de baixo
        alterLink.setAttribute("href", "LessonController.php?action=edit&id=" + lesson.id)
        alterLink.innerHTML = "Alterar"
        alterLink.setAttribute("class", "btn btn-secondary")
        alterLink.style.marginRight = "8px"
        

        var deleteLink = document.createElement('a')
        deleteLink.setAttribute("class", "btn btn-secondary")
        deleteLink.innerHTML = "Deletar"
        deleteLink.setAttribute("href", "LessonController.php?action=delete&id=" + lesson.id)
        deleteLink.style.marginRight = "8px"

        h2.setAttribute("style", "display: inline-block")

        otherH2.appendChild(alterLink)
        otherH2.appendChild(deleteLink)

        if (lesson.pdfPath != null) {
            var linkDownload = document.createElement('a')
            linkDownload.setAttribute('href', lesson.pdfPath)
            linkDownload.setAttribute("target", "blank")

            var downloadIcon = document.createElement('i')
            downloadIcon.setAttribute('class', 'bi bi-download')

            linkDownload.appendChild(downloadIcon)
            otherH2.appendChild(linkDownload)
        }

        selectedVideo.innerHTML += "<br>"
        selectedVideo.appendChild(otherH2)
    }

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
            cardLesson.setAttribute('class', 'card_lesson card lesson mb-4')
            cardLesson.style.padding = "15px"
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