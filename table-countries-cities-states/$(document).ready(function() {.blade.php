$(document).ready(function() {
    $('#country-dd').change(function(event) {
        var idCountry = this.value;
        $('#state-dd').html('');

        $.ajax({
        url: "/api/fetch-state",
        type: 'POST',
        dataType: 'json',
        data: {country_id: idCountry,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('#state-dd').html('<option value="">Select State</option>');
            $.each(response.states,function(index, val){
            $('#state-dd').append('<option value="'+val.id+'"> '+val.name+' </option>')
            });
            $('#city-dd').html('<option value="">Select City</option>');
        }
        })
    });