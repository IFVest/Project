function onChangeEmail() {
    toggleButtonsDisabled();
    toggleEmailErrors();
   }
   
function onChangeSenha(){
  toggleButtonsDisabled();
  toggleSenhaErrors();
}

function isEmailValid() {
  const email = document.getElementById("email").value;
  if (!email) {
      return false;
  } 
  return validateEmail(email);
  
}

function toggleEmailErrors() {
  const email = document.getElementById('email').value;
  if(!email){
    document.getElementById('email-required-error').style.display = "block";
  } else {
    document.getElementById('email-required-error').style.display = "none";
  }

  if (validateEmail(email)){
    document.getElementById('email-invalid-error').style.display = "none";
  } else {
    document.getElementById('email-invalid-error').style.display = "block";
  }
}

function toggleSenhaErrors() {
  const senha = document.getElementById("senha").value;
  if (!senha) {
    document.getElementById("senha-required-error").style.display = "block";
  } else {
    document.getElementById("senha-required-error").style.display = "none";
  }
}

function toggleButtonsDisabled(){
  const emailValid = isEmailValid();
  document.getElementById("cadastro").disabled = !emailValid;

  const passwordValid = isPasswordValid();
  document.getElementById("login-button").disabled = !emailValid || !passwordValid;

}

function isPasswordValid() {
  const senha = document.getElementById("senha").value;
  if (!senha) {
      return false;
  }
  return true;
}

function validateEmail(email) {
  return /\S+@\S+\.\S+/.test(email);
}

// Habilita ver a senha
let btn = document.querySelector('.fa-eye')
btn.addEventListener('click', ()=>{
  let inputSenha = document.querySelector('#senha')
  
  if(inputSenha.getAttribute('type') == 'password'){
    inputSenha.setAttribute('type', 'text')
  } else {
    inputSenha.setAttribute('type', 'password')
  }
})
   
   // function entrar(){
   //   let email = document.querySelector('#email')
   //   let userEmail = document.querySelector('#userEmail')
     
   //   let senha = document.querySelector('#senha')
   //   let senhaLabel = document.querySelector('#senhaLabel')
     
     //  let msgError = document.querySelector('#msgError')
     //  let listaUser = []
     
     //  let userValid = {
     //    nome: null,
     //    user: null,
     //    senha: null
     //  }
     
   //   listaUser = JSON.parse(localStorage.getItem('listaUser'))
     
   //   listaUser?.forEach((item) => {
   //     if(email.value == item.userCad && senha.value == item.senhaCad){
          
   //       userValid = {
   //          nome: item.nomeCad,
   //          user: item.userCad,
   //          senha: item.senhaCad
   //        }
         
   //     }
   //   })
      
   //   if(email.value == userValid.user && senha.value == userValid.senha){
   //     window.location.href = '../../index.html'
       
   //     let mathRandom = Math.random().toString(16).substr(2)
   //     let token = mathRandom + mathRandom
       
   //     localStorage.setItem('token', token)
   //     localStorage.setItem('userLogado', JSON.stringify(userValid))
   //   } else {
   //     userEmail.setAttribute('style', 'color: red')
   //     email.setAttribute('style', 'border-color: red')
   //     senhaLabel.setAttribute('style', 'color: red')
   //     senha.setAttribute('style', 'border-color: red')
   //     msgError.setAttribute('style', 'display: block')
   //     msgError.innerHTML = 'Usuário ou senha incorretos'
   //     email.focus()
   //   }
     
   // }
   
   