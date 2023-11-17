let radioOptions = document.querySelectorAll('input')

radioOptions.forEach(element => {
    element.addEventListener('change', changeUserAnswer)
} )

function changeUserAnswer(event){
    let alternativeId = event.target.value
    let userAnswerId = event.target.name

    let params = 'alternativeId='+ alternativeId + '&userAnswerId=' + userAnswerId + '&examId='
    var xhttp = new XMLHttpRequest();
    
    xhttp.open("POST", `UserAnswerController.php?action=changeChosenAnswer`, true );
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xhttp.send(params)
}