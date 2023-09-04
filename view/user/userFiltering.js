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
        var form = createUserForm(user);
    });
}

function createUserForm(user) {
    var form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', '<?= BASE_URL ?>/controller/UserController.php?action=edit&id=' + user.id)

    var rowDiv = document.createElement('div');
    rowDiv.setAttribute('class', 'row');

    var colDiv = document.createElement('div');
    colDiv.setAttribute('class', 'col-2 mb-4');

    var card = document.createElement('div');
    card.setAttribute('class', 'card');
    card.setAttribute('style', 'width: 28rem');

    var cardBody = document.createElement('div');
    cardBody.setAttribute('class', 'card-body');

    var userName = document.createElement('div');
    userName.setAttribute('class', 'name');
    userName.setAttribute('style', 'display:inline; padding-left:15px');

    var userRole = document.createElement('div');
    userRole.setAttribute('class', 'role');
    userRole.setAttribute('style', 'display: inline; padding-left: 15px')

    var userRoleSelect = document.createElement('select');
    userRoleSelect.setAttribute('name', 'user_role');

    var userActive = document.createElement('div');
    userActive.setAttribute('class', 'active');
    userActive.setAttribute('style', 'display: inline; padding-left: 15px');

    var userActiveSelect = document.createElement('select');
    userActiveSelect.setAttribute('name', 'user_active');

    var userActiveOption1 = document.createElement('option');
    userActiveOption1.setAttribute('value', '1');
    var userActiveOption2 = document.createElement('option');
    userActiveOption2.setAttribute('value', '0');

}