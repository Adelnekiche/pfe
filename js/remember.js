console.log("hello")
function login() {
    // Récupérer les informations de connexion de l'utilisateur (par exemple, nom d'utilisateur et mot de passe)
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Vérifier si l'utilisateur a coché la case "Remember Me"
    var rememberMe = document.getElementById("rememberMeCheckbox").checked;

    // Stocker les informations de connexion dans un cookie s'il a coché la case "Remember Me"
    if (rememberMe) {
        // Exemple de stockage d'informations dans un cookie pendant 30 jours
        var expirationDate = new Date();
        expirationDate.setDate(expirationDate.getDate() + 30);
        document.cookie = "username=" + username + "; expires=" + expirationDate.toUTCString();
        document.cookie = "password=" + password + "; expires=" + expirationDate.toUTCString();
    }

    // Effectuer l'authentification (c'est un exemple simplifié, dans un vrai projet, vous devriez utiliser des méthodes d'authentification sécurisées)
    // Ici, je vais juste afficher les informations de connexion dans la console
    console.log("Username:", username);
    console.log("Password:", password);
}
