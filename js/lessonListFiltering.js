import * as listFlt from "./listFiltering.js";

var subjects = document.querySelectorAll(".subject");

subjects.forEach(subject => {
    subject.removeEventListener("click", listFlt.subjectFiltering);
    subject.addEventListener("click", () => {
        listFlt.filterBySubject(subject, true)
    });
});

function test(){
    console.log('test');
}