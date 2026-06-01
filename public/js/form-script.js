const apiHost = 'http://127.0.0.1';
const apiPort = '8000';
const API_URL = apiHost+':'+apiPort+'/api/';

let typingTimer;
let key = 2;
let ClosetimerInterval;


const input = document.querySelector("#contact_number");
const iti = window.intlTelInput(input, {
    initialCountry: "us",
    separateDialCode: true,
    preferredCountries: ["ph", "us", "sg", "ae"],
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js" /*I just use this for telephone -JL*/
});


$(".action-label").on('click', function(){
	let field = $(this).data('trigger');
	const input = document.getElementById(field);
	 if (input.showPicker) {
        input.showPicker(); 
    } else {
        input.focus();
    }
});

$(".input-action").on('click', function(){
	let field = $(this).attr('id');
	const input = document.getElementById(field);
	 if (input.showPicker) {
        input.showPicker();
    } else {
        input.focus();
    }
});


function initSuggestions(key){
    let input = document.getElementById(`locations_${key}_address`);
	let box = document.getElementById("suggestions_"+key);
	let timer = null;

function updatePosition() {
    let rect = input.getBoundingClientRect();

        box.style.top = (rect.bottom + window.scrollY + 5) + "px";
        box.style.left = (rect.left + window.scrollX) + "px";
        box.style.width = rect.width + "px";
    }

    input.addEventListener("input", function () {
        clearTimeout(timer);

        let query = this.value;

        if (query.length < 3) {
            box.style.display = "none";
            return;
        }

        timer = setTimeout(async () => {

            updatePosition(); 

            let res = await fetch(
                `https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=6&q=${query}` /*I use this temporarily for testing for the map suggestions - JL*/
            );

            let data = await res.json();

            box.innerHTML = "";

            if (!data.length) {
                box.style.display = "none";
                return;
            }

            data.forEach(place => {

                let div = document.createElement("div");
                div.className = "suggestion-item";
                div.innerText = place.display_name;

                div.onclick = () => {
                    input.value = place.display_name;
                    document.getElementById("locations."+key+".lat").value = place.lat;
                    document.getElementById("locations."+key+".lng").value = place.lon;
                    box.style.display = "none";
                    initMap();
                };

                box.appendChild(div);
            });

            box.style.display = "block";
        }, 250);
    });

    setTimeout(function(){
        initMap();
    }, 300);

    window.addEventListener("scroll", () => {
        if (box.style.display === "block") updatePosition();
    });

    window.addEventListener("resize", () => {
        if (box.style.display === "block") updatePosition();
    });

    // close on outside click
    document.addEventListener("click", function (e) {
        if (e.target !== input) {
            box.style.display = "none";
        }
    });
}

function appendItemLocation(){
 let output = '';
     output += `<div class="mb-3" id="location_item_${key}">`;
     output += `<div class="theme-input-group">`;
     output += `<i class="fa-solid fa-location-dot input-icon"></i>`;
     output += `<input type="text" id="locations_${key}_address" name="locations[${key}][address]" class="form-control" required autocomplete="off">`;
     output += `<label>Stop #${(key-1)}</label>`;
     output += `<i class="fa-solid fa-times input-icon-remove text-danger" data-key="${key}"></i>`;
     output += `</div>`;
     output += `<input type="hidden" id="locations.${key}.lat" name="locations[${key}][lat]">`;
     output += `<input type="hidden" id="locations.${key}.lng" name="locations[${key}][lng]">`;
     output += `<div id="suggestions_${key}"></div>`;
     output += `</div>`;
     $("#multiple-location-point").append(output);
    
     initSuggestions(key);
     initiateKeyRemoval();
     key++;
}

function successMessage(msg){
    Swal.fire({
      title: msg,
      html: "Page Reload in <b></b> ms.",
      timer: 3000,
      timerProgressBar: true,

      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: false,
      showCancelButton: false,

      didOpen: () => {
        Swal.showLoading();

        const timer = Swal.getPopup().querySelector("b");

        ClosetimerInterval = setInterval(() => {
          timer.textContent = Swal.getTimerLeft();
        }, 100);
      },

      willClose: () => {
        clearInterval(ClosetimerInterval);
      }

    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        location.reload();
      }
    });
}


function initiateKeyRemoval(){
	$(".input-icon-remove").on('click', function(){
		let k = $(this).data('key');

        Swal.fire({
          title: "Do you want to delete this stop?",
          showDenyButton: false,
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes",
        }).then((result) => {
         if (result.isConfirmed) {
            $("#location_item_"+k).remove();
            initMap();
         }else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");

         }
        });
	});
}

$(".add-stop-button").on('click', function(){
    appendItemLocation();
});


$(document).ready(function(){
    initSuggestions(1);
    initSuggestions(0);
});



function show_spinner(status){
    let out = '';
    out += '<div class="spinner-grow text-primary mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';
    out += '<div class="spinner-grow text-secondary mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';
    out += '<div class="spinner-grow text-success mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';
    out += '<div class="spinner-grow text-danger mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';
    out += '<div class="spinner-grow text-warning mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';
    out += '<div class="spinner-grow text-info mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';
    out += '<div class="spinner-grow text-dark mx-1" role="status">';
    out += '<span class="visually-hidden">Loading...</span>';
    out += '</div>';

    if (status == 'show') {
        $("#spinner_loading").html(out);
    }else{
        $("#spinner_loading").html('');
    }
   
}


 $("#submit_form_booking").on('submit', function(e){
        e.preventDefault();
        let form = $(this).attr('id');
        let data = $(this).serialize();
        data += '&phone_contact=' + encodeURIComponent(iti.getNumber());
        $.ajax({
            type:"POST",
            url:API_URL + 'create-booking',
            data:data,
            dataType:'json',
            beforeSend:function(){
            },
            success:function(response){
              console.log(response);
             if (response.status == true) {
                successMessage(response.message);
             }else if (response.status == false && response.validation == true) {
                validation(form, response.errors);
             }else if (response.status == false && response.need_requirements == true) {
                $(".contact_information").removeClass('d-none');
                $("#first_name").focus();
             }else{
              console.log(response);
             }
            },
            error: function(error){
              console.log(error);
            }
          });
    });

    $("#contact_number").on('input', function(e){   
        e.preventDefault();

        show_spinner('show');
        clearTimeout(typingTimer);

        $(".contact_information").addClass('d-none');
        $("#contact_information_message").text('');
        $(".contact_information_text").addClass('d-none');
        $(".contact_information_text").removeClass('text-success');
        $(".contact_information").addClass('d-none');

        typingTimer = setTimeout(function() {
            $.ajax({
                type:"POST",
                url:API_URL + 'fetch-customer',
                data:{phone : iti.getNumber()},
                dataType:'json',
                beforeSend:function(){
                    $(".contact_information").addClass('d-none');
                    $("#contact_information_message").text('');
                },
                success:function(response){
                    show_spinner('hide');
                    if (response.status == false) {
                        $("#client_id").val('');
                        $(".contact_information_text").removeClass('d-none');
                        $("#contact_information_message").text(response.message)
                        $(".contact_information_text").removeClass('text-success');;
                        $(".contact_information").removeClass('d-none');
                        $("#contact_information_message").text(response.message);
                     }else{
                        $(".contact_information_text").removeClass('d-none');
                        $(".contact_information_text").addClass('text-success');
                        $(".contact_information").addClass('d-none');
                        $("#contact_information_message").text(response.message);
                        $("#client_id").val(response.id);
                     }
                },
                error: function(error){
                  console.log(error);
                }
              });
        }, 2000); 
    });