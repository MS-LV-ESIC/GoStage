function tooglePasswordType() {
  var passwordInput = document.getElementById("password");

  var eyeIcon = document.getElementById("eyeIcon");

  var isPassword = passwordInput.type === "password";

  /*
        if (isPassword) {
            passwordInput.type = "text";
        }
        // Sinon, on le change en password pour cacher le mot de passe
        else {
            passwordInput.type = "password";
        }
    */
  passwordInput.type = isPassword ? "text" : "password";
  // Changer l'icône en fonction de l'état actuel de l'input
  eyeIcon.classList = isPassword ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
}
