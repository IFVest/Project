import * as flt from "./filtering.js"

var subjects = document.querySelectorAll(".subject");
// var modulesDiv = document.querySelector(".modules");
subjects.forEach((subject) =>
  subject.addEventListener("click", flt.filterBySubject(true))
);
