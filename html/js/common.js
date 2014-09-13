/*
var focus_element = document.getElementById('quantity');
if (focus_element !== null) {
    focus_element.focus();
} else {
    var focus_element = document.getElementById('focus');
    focus_element.focus();
}
*/

var inputs = document.getElementsByClassName('input');
for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].value == '') {
        inputs[i].focus();
        break;
    }
}
