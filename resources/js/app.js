const { forEach } = require('lodash');

require('./bootstrap');
require('alpinejs');

/*
// import autofill class
import { LocationAutoFill } from './Classes/LocationAutoFill';

// add key to constructor
const locationAutoFill = new LocationAutoFill(mapboxApiKey);
// call autofill method
locationAutoFill.autocompleteInputBox(document.getElementById("a-input-city"));

*/
console.log('Free bobby shmurda');

const mapboxApiKey = process.env.MIX_APP_ACCESS;


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


if(document.getElementById('a-location-plus-button')) {
    let distance;
    document.getElementById('a-location-plus-button').addEventListener('click', () => {
        document.getElementById('a-input-distance').value == '' ? distance = 0 : distance = parseFloat(document.getElementById('a-input-distance').value)
        document.getElementById('a-input-distance').value = distance += parseFloat(10);
    })
    document.getElementById('a-location-minus-button').addEventListener('click', () => {
        document.getElementById('a-input-distance').value == '' ? distance = 0 : distance = parseFloat(document.getElementById('a-input-distance').value)
        distance -= parseFloat(10);
        if (distance < 0) {
            document.getElementById('a-input-distance').value = 0
        } else {
            document.getElementById('a-input-distance').value = distance;
        }

    })
}
// AUTOFILL CITY ON FIND GIG FORM
const geocodingClient = mapboxSdk({accessToken: mapboxApiKey});

function autocompleteSuggestionMapBoxAPI(inputParams, callback) {
    geocodingClient.geocoding.forwardGeocode({
        query: inputParams,
        countries: ["BE"],
        types: ["place"],
        autocomplete: true,
        limit: 5,
    })
        .send()
        .then(response => {
            const match = response.body;
            callback(match);
        });
}


function autocompleteInputBox(inp) {
    let currentFocus;
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);

        // suggestion list MapBox api called with callback
        autocompleteSuggestionMapBoxAPI($('#a-input-city').val(), function (results) {
            console.log(results);
            results.features.forEach(function (key) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + key.place_name.substr(0, val.length) + "</strong>";
                b.innerHTML += key.place_name.substr(val.length);
                b.innerHTML += "<input type='hidden' data-lat='" + key.geometry.coordinates[1] + "' data-lng='" + key.geometry.coordinates[0] + "'  value='" + key.place_name + "'>";
                b.addEventListener("click", function (e) {
                    let lat = $(this).find('input').attr('data-lat');
                    let long = $(this).find('input').attr('data-lng');
                    inp.value = $(this).find('input').val();
                    $(document.getElementById("a-latitude").value =  lat);
                    $(document.getElementById("a-longitude").value =  long);
                    closeAllLists();
                });
                a.appendChild(b);
            });
        })
    });


    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        let x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        let x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

if(document.getElementById("a-input-city")){
    autocompleteInputBox(document.getElementById("a-input-city"));
}

/*
**************************************** Gallery modal
*/

const photoGallery = () => {

    // get all pictures
    const images = document.querySelectorAll(".a-gallery-picture");
    // count how many image there are
    const imagesCount = images.length;

    // show first image
    let index = 0;
    images[index].style.display = "block";

    // Button on the left shows previous picture
    document.getElementById("a-left").addEventListener('click', () => {
        images[index].style.display = "none";
        if(index === 0){
            index= imagesCount - 1;
        } else {
            index = index-1;
        }
        images[index].style.display = "block";
    });

    // Button on the right shows next picture
    document.getElementById("a-right").addEventListener('click', () => {
        images[index].style.display = "none";
        if(index+1 === imagesCount){
            index = 0;
        } else {
            index = index+1;
        }
        images[index].style.display = "block";
    })
}
photoGallery();


const togglePhotoGallery = () => {
    const openGallery = document.getElementById('a-gallery-open');
    const galleryContainer = document.getElementById('o-gallery');
    const galleryContent = document.getElementById('m-gallery');

    document.addEventListener('click', function(event) {
        const isClickInsideFormdiv = galleryContainer.contains(event.target);
        const isClickInsideApplyForm = galleryContent.contains(event.target);
        if (!isClickInsideApplyForm && isClickInsideFormdiv){
            galleryContainer.style.display = "none";
        }
    });
    galleryContainer.style.display = 'none';

    openGallery.addEventListener("click", () => {
        galleryContainer.style.display = 'flex';
    });
}
if(document.getElementById('a-gallery-open')) {
    togglePhotoGallery();
}
