subjects.forEach((subject) =>
  subject.addEventListener("click", filterBySubject)
);

lesson_modules = document.querySelectorAll(".lesson_module")
lesson_modules.forEach(lesson_module => {
    lesson_module.addEventListener("click", filterByModule)
});

function filterByModule() {
    lesson_modules.forEach(lesson_module => {
        lesson_module.selected ? console.log("aaa") : console.log("bbb")
    })
}