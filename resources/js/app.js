require('./bootstrap');
require('alpinejs');


console.log('B==D ');


// apply form on event page
if(document.getElementById('o-form')){
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
}


// event details + artist band members HOVER EXPAND
if (document.getElementById("m-event-details")) {
    const auto = document.getElementById("m-event-details");
    auto.addEventListener("mouseover", autoOver);
    auto.addEventListener("mouseout", autoOut);
}
// artist
if (document.getElementById("m-artist-details")) {
    const auto = document.getElementById("m-artist-details");
    auto.addEventListener("mouseover", autoOver);
    auto.addEventListener("mouseout", autoArtistOut);
}
function autoOver() {
    this.style.height = this.scrollHeight + "px";
}

function autoOut() {
    this.style.height = "116px";
}

function autoArtistOut() {
    this.style.height = "128px";
}

if (document.getElementsByClassName("a-player")) {
    const players = document.getElementsByTagName("audio");
    const buttons = document.querySelectorAll(".a-button");
    const play = document.querySelectorAll(".fa-play");
    const pause = document.querySelectorAll(".fa-pause");
    const img = document.querySelectorAll(".a-spinning-cover");

    const player = (i) => {
        buttons.forEach((button, index) => {

            // pause ALL other players EXCEPT the one clicked
            if(players[index] != players[i]){
                players[index].pause();
            }
            // reset style ALL play en pause buttons
            play[index].style.display = "block";
            pause[index].style.display = "none";
            img[index].classList.remove('a-rotate')

        })
        // Pause if users clicks on the song that is playing
        if(!players[i].paused){
            players[i].pause();
            // toggle clicked play and pause button
            play[i].style.display = "block";
            pause[i].style.display = "none"
            img[i].classList.remove('a-rotate')

        } else {
            players[i].play();
            // toggle clicked play and pause button
            play[i].style.display = "none";
            pause[i].style.display = "block"
            img[i].classList.add('a-rotate')
        }



    }


    buttons.forEach((button, index) => {
        button.addEventListener('click', () => player(index));
    });
}

