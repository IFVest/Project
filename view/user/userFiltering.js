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

    // Nome do usuário
    var userName = document.createElement('div');
    userName.innerHTML = user.completeName
    userName.setAttribute('class', 'name');
    userName.setAttribute('style', 'display:inline; padding-left:15px');

    // Papel 
    var userRole = document.createElement('div');
    userRole.setAttribute('class', 'role');
    userRole.setAttribute('style', 'display: inline; padding-left: 15px')

    if (user.role == "Administrador") {
        userRole.innerHTML = "Administrador"
    }
    else if (user.role == "Professor") {
        userRole.innerHTML = "Professor"
    }
    else {
        userRole.innerHTML = "Aluno"
    }

    // Ativo
    var userActive = document.createElement('div');
    userActive.setAttribute('class', 'active');
    userActive.setAttribute('style', 'display: inline; padding-left: 15px');

    var userActiveSelect = document.createElement('select');
    userActiveSelect.setAttribute('name', 'user_active');

    var userActiveOption1 = document.createElement('option');
    userActiveOption1.setAttribute('value', '1');
    userActiveOption1.innerHTML = "Ativo";
    var userActiveOption2 = document.createElement('option');
    userActiveOption2.setAttribute('value', '0');
    userActiveOption2.innerHTML = "Inativo";

    if (user.active == 1) {
        userActiveOption1.selected = true;
    }
    else if (user.active == 0) {
        userActiveOption2.selected = true;
    }

    // Id do usuário (escondido)
    var userId = document.createElement("input");
    userId.setAttribute("name", "user_id");
    userId.setAttribute("value", user.id);
    userId.hidden = true;

    // Botão de submit
    var submitButton = document.createElement("button");
    submitButton.setAttribute("class", "btn btn-primary w-25");
    submitButton.setAttribute("type", "submit")
    submitButton.setAttribute("style", "display:inline; padding-left: 15px");
    submitButton.innerHTML = "Alterar";

    rowDiv.appendChild(colDiv);
    colDiv.appendChild(card);
    card.appendChild(cardBody);
    // Colocar imagem
    cardBody.appendChild(userName);
    cardBody.appendChild(userRoleSelect);
    userRoleSelect.appendChild(userRoleOption1);
    userRoleSelect.appendChild(userRoleOption2);
    userRoleSelect.appendChild(userRoleOption3);
    cardBody.appendChild(userActiveSelect);
    userActiveSelect.appendChild(userActiveOption1);
    userActiveSelect.appendChild(userActiveOption2);
    cardBody.appendChild(userId);
    cardBody.appendChild(submitButton);

    return rowDiv;
}