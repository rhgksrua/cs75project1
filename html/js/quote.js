var submit = document.getElementById('submit');

submit.addEventListener("click", validateQuantity, false);


function validateQuantity(e) {
    
    var q = document.getElementById('quantity').value;
    if (isNaN(q)) {
        e.preventDefault();
        alert("Invalid");
    } else if (q < 1) {
        e.preventDefault();
        alert("Must buy more than one shares");
    } 
}
