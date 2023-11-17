document.querySelector('iframe').addEventListener('play', (event)=>{
    var eventClass = event.target.class.split(' ')
    let dir = eventClass[0]
    let moduleId = eventClass[1]
    let moduleName = eventClass[2]
    window.location = `${dir}/controller/LessonController.php?action=showModuleLessons&moduleId=${moduleId}&moduleName=${moduleName}`;
})