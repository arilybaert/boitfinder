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

    // Button on the LEFT shows previous picture
    document.getElementById("a-left").addEventListener('click', () => {
        images[index].style.display = "none";
        if(index === 0){
            index= imagesCount - 1;
        } else {
            index = index-1;
        }
        images[index].style.display = "block";
    });

    // Button on the RIGHT shows next picture
    document.getElementById("a-right").addEventListener('click', () => {
        images[index].style.display = "none";
        if(index+1 === imagesCount){
            index = 0;
        } else {
            index = index+1;
        }
        images[index].style.display = "block";
    })

    // switch between photo or video mode

}

const photoVideoSwitch = () => {
    // get picture container
    const pictureContainer = document.getElementById("m-photo");
    // get video container
    const videoContainer = document.getElementById("o-gallery-video");
    // hide video container
    videoContainer.style.display = "none";
    // @TODO refactor switch button
    // get switchBtn
    const switchBtn = document.getElementById("a-photo-video-btn");
    switchBtn.addEventListener('click', () => {
        pictureContainer.style.display = "none";
        videoContainer.style.display = "block";
        document.getElementById("a-photo-video-btn_photo").style.display = "block";
        document.getElementById("a-photo-video-btn").style.display = "none";
    });
    // get switchBtn video
    const switchBtn_photo = document.getElementById("a-photo-video-btn_photo");
    switchBtn_photo.style.display = "none";
    switchBtn_photo.addEventListener('click', () => {
        pictureContainer.style.display = "block";
        videoContainer.style.display = "none";
        document.getElementById("a-photo-video-btn_photo").style.display = "none";
        document.getElementById("a-photo-video-btn").style.display = "block";
    });

}
if(document.getElementById("a-left")){
    photoGallery();
}

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
    galleryContainer.style.display = 'flex';

    openGallery.addEventListener("click", () => {
        galleryContainer.style.display = 'flex';
    });
}
if(document.getElementById('a-gallery-open')) {
    togglePhotoGallery();
    photoVideoSwitch();
}


/****************************** BANDMEMBERS *****************************/
// if(document.querySelectorAll('.a-input-function')) {
//     const inputFunction = document.querySelectorAll('.a-input-function');
//     const inputName = document.querySelectorAll('.a-input-name');
//     const btn = document.querySelectorAll('.a-js-button');
//     const editBtn = document.querySelectorAll('.a-edit-button');
//     const saveBtn = document.querySelectorAll('.a-save-button');
//     btn.forEach((button, index) => {
//         editBtn[index].style.display = 'block';
//         saveBtn[index].style.display = 'none';
//         // inputFunction[index].readonly = true;
//         // inputName[index].readonly = true;
//         button.addEventListener('click', () => {
//             inputFunction[index].disabled = !inputFunction[index].disabled;
//             inputName[index].disabled = !inputName[index].disabled;
//             editBtn[index].style.display = editBtn[index].style.display === 'block' ? 'none' : 'block';
//             saveBtn[index].style.display = saveBtn[index].style.display === 'block' ? 'none' : 'block';
//         })
//     })
// }



// custom select
var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("o-custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
