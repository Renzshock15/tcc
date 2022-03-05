function readPassword() {
    var inputPass = document.getElementById("student-password");
    var inputPassShow = document.getElementById("hide1");
    var inputPassHide = document.getElementById("hide2");

    if (inputPass.type === 'password') {
        inputPass.type = 'text';
        inputPassShow.style.display = "block";
        inputPassHide.style.display = "none";
    } else {
        inputPass.type = 'password';
        inputPassShow.style.display = "none";
        inputPassHide.style.display = "block";
    }
}