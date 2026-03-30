function showimg() {
    var input = document.getElementById("profile");
    var fReader = new FileReader();
    if (input.files && input.files[0]) {
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function (event) {
            var img = document.getElementById("picture");
            img.src = event.target.result;
        }
    }
}