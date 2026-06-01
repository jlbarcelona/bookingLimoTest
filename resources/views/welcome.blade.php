<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Oppertuinty - Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/css/intlTelInput.css">
</head>

<body>
   
    <form id="submit_form_booking" class="needs-validation" method="post" novalidate>
        <div class="container-fluid my-3">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12 mb-3">
                    <div class="card round-0">
                        <div class="card-body mx-0 mx-md-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center theme-icon-logo fw-bold h4 mb-4">
                                        <i class="fa-solid fa-dashboard"></i>ExampleIQ
                                    </div>
                                    <h5 class="text-center text-sm-start">Let's get you on your way!</h5>
                                    <div class="mt-3">
                                        <div class="btn-group col-12" role="group" aria-label="Solid button group">
                                          <button type="button" class="btn theme-btn-active"><i class="fa-solid fa-circle-arrow-right"></i> One-way</button>
                                          <button type="button" class="btn theme-btn"><i class="fa-solid fa-hourglass-start"></i> Hourly</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 my-2">
                                    <label class=" fw-bold">Pickup</label>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="px-2 pt-3 border">
                                        <div class="input-group mb-2">
                                          <span class="input-group-text action-label" data-trigger="pickup_date"><i class="fa-solid fa-calendar"></i></span>
                                          <input type="date" class="form-control input-action" id="pickup_date" name="pickup_date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="px-2 pt-3 border">
                                        <div class="input-group mb-2">
                                          <span class="input-group-text action-label" data-trigger="pickup_time"><i class="fa-solid fa-clock"></i></span>
                                          <input type="time" step="60" min="00:00" max="23:59" class="form-control input-action" id="pickup_time" name="pickup_time">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="btn-group" role="group" aria-label="Solid button group">
                                      <button type="button" class="btn theme-btn-active">Location</button>
                                      <button type="button" class="btn theme-btn">Airport</button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div id="multiple-location-point">
                                        <div class="mb-2" id="location_item_0">
                                             <div class="theme-input-group">
                                                <i class="fa-solid fa-location-dot input-icon"></i>
                                                <input type="text" id="locations_0_address" name="locations[0][address]" class="form-control" required autocomplete="off">
                                                <label>Location</label>
                                            </div>
                                            <input type="hidden" id="locations.0.lat" name="locations[0][lat]">
                                            <input type="hidden" id="locations.0.lng" name="locations[0][lng]">
                                            <div id="suggestions_0"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <button class="btn btn-link action-label-add fw-bold add-stop-button" type="button"><i class="fa-solid fa-plus"></i> Add a stop</button>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 my-2">
                                    <label class="h6 fw-bold">Drop off</label>
                                </div>
                                <div class="col-12">
                                    <div class="btn-group" role="group" aria-label="Solid button group">
                                      <button type="button" class="btn theme-btn-active">Location</button>
                                      <button type="button" class="btn theme-btn">Airport</button>
                                    </div>
                                </div>
                               <div class="col-lg-12 col-12">
                                   <div class="mb-3" id="location_item_1">
                                         <div class="theme-input-group">
                                            <i class="fa-solid fa-location-dot input-icon"></i>
                                            <input type="text" id="locations_1_address" name="locations[1][address]" class="form-control" required autocomplete="off">
                                            <label>Location</label>
                                        </div>
                                        <input type="hidden" id="locations.1.lat" name="locations[1][lat]">
                                        <input type="hidden" id="locations.1.lng" name="locations[1][lng]">
                                        <div id="suggestions_1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 mx-2">
                                    <label class="h5 fw-bold">Contact Information</label>
                                </div>
                               <div class="col-lg-12 col-12 ">
                                    <input type="tel" id="contact_number" name="contact_number" class="form-control col-12" required autocomplete="off">
                                </div>

                                <div id="spinner_loading" class="text-center mt-2"></div>

                                 <div class="col-lg-12 mt-4 contact_information_text d-none">
                                    <h5 class="fw-bold"><small id="contact_information_message">We don't have that phone number on file. Please provide additional contact information.</small></h5>
                                </div>
                            </div>


                            <div class="row mt-4 d-none contact_information">
                                <input type="hidden" name="client_id" id="client_id" value="1">
                               <div class="col-lg-6 col-12">
                                    <div class="theme-input-group">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input type="text" id="first_name" name="first_name" class="form-control" required autocomplete="off">
                                        <label>First name</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="theme-input-group">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input type="text" id="last_name" name="last_name" class="form-control" required autocomplete="off">
                                        <label>Last name</label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="theme-input-group">
                                        <i class="fa-solid fa-at input-icon"></i>
                                        <input type="email" id="email" name="email" class="form-control" required autocomplete="off">
                                        <label>Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <h5 class="fw-bold"><small>How many passengers are expected for the trip?</small></h5>
                                </div>
                               <div class="col-lg-6 col-6 col-12">
                                    <div class="theme-input-group">
                                        <i class="fa-solid fa-hashtag input-icon"></i>
                                        <input type="number" id="passengers" name="passengers" class="form-control" required autocomplete="off">
                                        <label>#Passengers</label>
                                    </div>
                                </div>
                            </div>

                             <div class="row mt-4 mb-2">
                                <div class="col-lg-12">
                                    <button class="btn theme-btn-submit col-12" type="submit">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  col-12">
                    <div id="map" style="height:1000px;"></div>
                </div>
            </div>
        </div>
    </form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkky1gsfW0C_LNEsgfHpfOYwNxAXt78i4&libraries=places"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/intlTelInput.min.js"></script>
<script src="{{ asset('js/form-script.js') }}"></script>
<script src="{{ asset('js/map.js') }}"></script>
<script src="{{ asset('js/validator.js') }}"></script>
</html>