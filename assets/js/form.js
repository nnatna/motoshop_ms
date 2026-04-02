function showimg() {
    var input = document.getElementById("profile") || 
                document.getElementById("image") || 
                document.getElementById("logo") || 
                (document.getElementById("previewImage") ? document.getElementById("previewImage").previousElementSibling : null);

    if (!input || !input.files || !input.files[0]) return;

    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function (event) {
        var img = document.getElementById("picture") || document.getElementById("previewImage");
        if (img) {
            img.src = event.target.result;
            img.classList.remove("d-none");
            var placeholder = document.getElementById("uploadPlaceholder");
            if (placeholder) placeholder.classList.add("d-none");
        }
    }
}
function calculateTotal() {
    const qtyInput = document.getElementById('qty');
    const modelSelect = document.getElementById('model_code');
    const totalField = document.getElementById('total_amount');
    const displayAmount = document.getElementById('display_amount');

    const selectedOption = modelSelect.options[modelSelect.selectedIndex];
    const price = selectedOption ? selectedOption.getAttribute('data-price') : 0;
    const qty = qtyInput.value;

    if (qty === "" || qty <= 0 || !price) {
        totalField.value = "0.00";
        displayAmount.innerText = "0.00";
        return;
    }
    const total = parseFloat(qty) * parseFloat(price);
    const formattedTotal = total.toFixed(2);

    totalField.value = formattedTotal;
    displayAmount.innerText = formattedTotal;
}