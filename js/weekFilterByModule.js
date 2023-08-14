import * as flt from "./filtering.js"

var subjects = document.querySelectorAll(".subject");

export function startPage(filteringType){
    subjects.forEach((subject) => {
      subject.removeEventListener("click", flt.moduleFiltering);
      subject.addEventListener("click", () => {
        flt.filterBySubject(filteringType);
      })
    })
}

startPage("week");
