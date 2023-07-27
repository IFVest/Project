import * as flt from "./filtering.js"

var subjects = document.querySelectorAll(".subject");

export function startPage(filterModule, isQuestion){
    subjects.forEach((subject) => {
      subject.removeEventListener("click", flt.moduleFiltering);
      subject.addEventListener("click", () => {
        flt.filterBySubject(filterModule, isQuestion);
      })
    })
}
