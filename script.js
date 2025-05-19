function connexion() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var errorMessage = document.getElementById("msgErr");
    if (email == "azerty" && password == "banana") {
        // window.location.href = "https://www.esic.fr";
        window.location.href = "home.html";
    } else {
        errorMessage.innerHTML = "Mot de passe ou email incorrect";
        errorMessage.style.color = "red";
    }

}
function tooglePasswordType() {
    // Récuperer l'élément html avec l'id password
    var passwordInput = document.getElementById("password");
    // Récupérer l'élément html avec l'id eyeIcon
    var eyeIcon = document.getElementById("eyeIcon");
    // Vérifier si le type de l'input est password ou text
    // Si c'est password, isPassword sera true, sinon false
    var isPassword = passwordInput.type === "password";

    // Changer le type de l'input fonction de l'état actuel de l'input (soit password soit text)
    // Si le type est password, on le change en text pour afficher le mot de passe
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