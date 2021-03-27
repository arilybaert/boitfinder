require('./bootstrap');
require('alpinejs');


console.log('hey there ;)');

let formdiv = document.getElementById('o-form');
let applyBtn = document.getElementById('a-applyBtn');
let applyForm = document.getElementById('o-apply-form');

document.addEventListener('click', function(event) {
    var isClickInsideFormdiv = formdiv.contains(event.target);
    var isClickInsideApplyForm = applyForm.contains(event.target);
    if (!isClickInsideFormdiv && isClickInsideApplyForm){
        document.getElementById('o-apply-form').style.display = "none";
    }
});
applyBtn.addEventListener('click', function() {
    document.getElementById('o-apply-form').style.display = "block";
});

if (document.getElementsByClassName("m-event-details")) {
    const auto = document.getElementById("m-event-details");
    auto.addEventListener("mouseover", autoOver);
    auto.addEventListener("mouseout", autoOut);
}

function autoOver() {
    this.style.height = this.scrollHeight + "px";
}

function autoOut() {
    this.style.height = "116px";
}
