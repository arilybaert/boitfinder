export class LocationAutoFill {
    constructor(mapboxApiKey) {
        this.geocodingClient = mapboxSdk({accessToken: mapboxApiKey});
    }

    autocompleteSuggestionMapBoxAPI(inputParams, callback) {
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

    autocompleteInputBox(inp) {
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
            this.autocompleteSuggestionMapBoxAPI($('#a-input-city').val(), function (results) {
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
}
