var nameInput = document.querySelector("#user_name");
nameInput.addEventListener("input", (event) => {
    var username = event.target.value;

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "UserController.php?action=findByName&userName=" + username, true);
    xhttp.onload = function () {
        if (xhttp.status >= 200 && xhttp.status < 400) {
            let users = JSON.parse(this.responseText);
            showFilteredUsers(users);
        }
    };
    xhttp.send();
})

function showFilteredUsers(users) {
    var usersDiv = document.querySelector('.users');
    usersDiv.innerHTML = '';

    users.forEach(user => {
        var form = createUserTable(user);
        usersDiv.appendChild(form);
    });
}

function createUserTable(user) {

    // Divs para bootstrap
    var rowDiv = document.createElement('div');
    rowDiv.setAttribute('class', 'row');

    var colDiv = document.createElement('div');
    colDiv.setAttribute('class', 'col-2 mb-4');

    var card = document.createElement('div');
    card.setAttribute('class', 'card');
    card.setAttribute('style', 'width: 28rem');

    var cardBody = document.createElement('div');
    cardBody.setAttribute('class', 'card-body');

    // Imagem
    var img = document.createElement('i')
    img.setAttribute('style', 'display:inline; padding-left:15px')
    if (user.active == 0) {
        img.setAttribute('class', 'bi bi-person-fill-lock')
    }
    else {
        img.setAttribute('class', 'bi bi-person-fill')
    }

    // Nome do usuário
    var userName = document.createElement('div');
    userName.setAttribute('class', 'name');
    userName.setAttribute('style', 'display:inline; padding-left:15px');
    userName.appendChild(document.createTextNode(user.completeName))

    // Papel 
    var userRole = document.createElement('div');
    userRole.setAttribute('class', 'role');
    userRole.setAttribute('style', 'display: inline; padding-left: 15px')

    if (user.role == "Administrador") {
        userRole.appendChild(document.createTextNode("Administrador"))
    }
    else if (user.role == "Professor") {
        userRole.appendChild(document.createTextNode("Professor"))
    }
    else {
        userRole.appendChild(document.createTextNode("Aluno"))
    }

    // Ativo
    var userActive = document.createElement('div');
    userActive.setAttribute('class', 'active');
    userActive.setAttribute('style', 'display: inline; padding-left: 15px');

    if (user.active == 1) {
        userActive.innerHTML = "Ativo";
    }
    else if (user.active == 0) {
        userActive.innerHTML = "Inativo";
    }

    // Id do usuário (escondido)
    var userId = document.createElement("input");
    userId.setAttribute("name", "user_id");
    userId.setAttribute("value", user.id);
    userId.hidden = true;

    // Link pro botão
    var baseurl = document.getElementById("baseurl").getAttribute("value")
    var buttonLink = document.createElement('a');
    buttonLink.setAttribute('href', baseurl + "/controller/UserController.php?action=alter&id=" + user.id)

    // Botão de submit
    var submitButton = document.createElement("button");
    submitButton.setAttribute("class", "btn btn-primary w-25");
    submitButton.setAttribute("type", "submit")
    submitButton.setAttribute("style", "display:inline; padding-left: 15px");
    submitButton.innerHTML = "Alterar";

    rowDiv.appendChild(colDiv);
    colDiv.appendChild(card);
    card.appendChild(cardBody);
    cardBody.appendChild(img)
    cardBody.appendChild(userName);
    cardBody.appendChild(userId);
    cardBody.appendChild(userRole)
    cardBody.appendChild(userActive)
    cardBody.appendChild(buttonLink)
    buttonLink.appendChild(submitButton)

    return rowDiv;
}