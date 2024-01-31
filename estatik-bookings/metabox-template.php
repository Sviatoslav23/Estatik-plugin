<label for="start_date">Start Date:</label>
<input type="text" id="start_date" name="start_date" class="datepicker" value="<?php echo esc_attr(date('d F Y g:i A', $start_date)); ?>" />

<br />

<label for="end_date">End Date:</label>
<input type="text" id="end_date" name="end_date" class="datepicker" value="<?php echo esc_attr(date('d F Y g:i A', $end_date)); ?>" />

<br />

<label for="address">Address:</label>
<input type="text" id="address" name="address" value="<?php echo esc_attr($address); ?>" />


<div id="google-map"></div>

<script>
    function initMap() {
        var geocoder = new google.maps.Geocoder();
        var address = '<?php echo esc_js($address); ?>';

        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var map = new google.maps.Map(document.getElementById('google-map'), {
                    zoom: 15,
                    center: results[0].geometry.location
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>
