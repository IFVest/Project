let radioOptions = document.querySelectorAll('input')

radioOptions.forEach(element => {
    element.addEventListener('change', changeUserAnswer)
} )

function changeUserAnswer(event){
    let alternativeId = event.target.value
    let userAnswerId = event.target.name

    console.log(alternativeId)
    console.log(userAnswerId)
    let params = 'alternativeId='+ alternativeId + '&userAnswerId=' + userAnswerId
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
        }
    }
    
    xhttp.open("POST", `UserAnswerController.php?action=changeChosenAnswer`, true );
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xhttp.send(params)
}