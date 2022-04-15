function Afficher() {
    var input = document.getElementById("motdepasse");
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}