
<script  type="text/javascript">
    $(document).ready(function(){

    });

    var currentStep = 1;
    function next(){
        switch (currentStep) {
            case 1:
                if (checkValidateStep1()) {
                    actionStep();
                    addMeal();
                }
                break;
            case 2:
                if (checkValidateStep2()) {
                    actionStep();
                    addRestaurant();
                }
                break;
            case 3:
                if (checkValidateStep3()) {
                    actionStep();
                    showReview();
                }
                break;
            default:
                break;
        }
    }
    function actionStep(){
        $('#btnPrev').show();
    }

    function previous(){
        $('.div-step'+currentStep).hide();
        $('#step'+currentStep).removeClass('text-danger');
        currentStep--;
        $('.div-step'+currentStep).show();
        $('#step'+currentStep).addClass('text-danger');
        if(currentStep !== 4){
            $('#btnNext').show();
            $('#btnSubmit').hide();
        }

        if(currentStep == 1){
            $('#btnPrev').hide();
        }

    }

    function checkValidateStep1() {
        $('.meal-error-feedback, .meal-error-feedback').empty();
        var mealData = $('#mealSelect').val();
        var numberOfPeople = $("#numberOfPeople").val();

        if (mealData === '') {
            $('.meal-error-feedback').text("Please select a valid.");
            return false;
        }

        if (numberOfPeople === 'undefined' || numberOfPeople === '' || numberOfPeople > 10 || numberOfPeople < 1) {
            $('.numberOfPeople-error-feedback').text("This field has a maximum of 10.");
            return false;
        }
        return true;
    }

    function checkValidateStep2() {
        $('.restaurant-error-feedback').empty();
        var restaurantSelect = $('#restaurantSelect').val();

        if (restaurantSelect === '') {
            $('.restaurant-error-feedback').text("Please select a valid.");
            return false;
        }
        return true;
    }

    function checkValidateStep3() {
        $('.dish-error-feedback').empty();
        var dishSelectData = $('select[name="dishSelect[]"]').map(function() {
            return $(this).val();
        }).get();

        var hasDuplicates = dishSelectData.some(function(item, index) {
            return dishSelectData.indexOf(item) !== index;
        });
        if (hasDuplicates) {
            $('.dish-error-feedback').text("Do not repeat the selected item. Cannot exceed 10 entries.");
            return false;
        }

        var noOfSeviceData = $('input[name="noOfSevice[]"]').map(function() {
            return $(this).val();
        }).get();

        var sum = noOfSeviceData.reduce(function(total, currentValue) {
            return total + currentValue;
        }, 0);
        var numberOfPeople = $('#numberOfPeople').val();

        if (sum < parseInt(numberOfPeople)) {
            $('.dish-error-feedback').text('Do not repeat the selected item. Cannot exceed 10 entries. Not less than the number of people');
            return false;
        }

        return true;
    }

    function addDish(){
        var length = $('.dish-child').children().length;
        if(length > 8) return false;
        $( ".dish-parent" ).children().clone().appendTo(".dish-child");
    }

    function addMeal(){
        var route = "{{ route('restaurant.ajax') }}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            type: 'POST',
            data: {
                step: 1,
                mealSelect: $('#mealSelect').val(),
                numberOfPeople: $('#numberOfPeople').val()
            },
            success: function (response) {
                $('#restaurantSelect').empty().html(response);
                $('.div-step'+currentStep).hide();
                $('#step'+currentStep).removeClass('text-danger');
                currentStep++;
                $('.div-step'+currentStep).show();
                $('#step'+currentStep).addClass('text-danger');

            },
            error: function () {
                console.log(error);
            }
        });
    }

    function addRestaurant(){
        var route = "{{ route('restaurant.ajax') }}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            type: 'POST',
            data: {
                step: 2,
                mealSelect: $('#mealSelect').val(),
                numberOfPeople: $('#numberOfPeople').val(),
                restaurantSelect: $('#restaurantSelect').val(),
            },
            success: function (response) {
                $('#dishSelect').empty().html(response);
                $('.div-step'+currentStep).hide();
                $('#step'+currentStep).removeClass('text-danger');
                currentStep++;
                $('.div-step'+currentStep).show();
                $('#step'+currentStep).addClass('text-danger');

            },
            error: function () {
                console.log(error);
            }
        });
    }
    
    function showReview(){
        var dishSelectData = $('select[name="dishSelect[]"]').map(function() {
            return $(this).val();
        }).get();
        var noOfSeviceData = $('input[name="noOfSevice[]"]').map(function() {
            return $(this).val();
        }).get();
        var dishData = dishSelectData.map(function(value, index) {
            return [value, noOfSeviceData[index]];
        });
        
        var route = "{{ route('restaurant.ajax') }}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            type: 'POST',
            data: {
                step: 3,
                mealSelect: $('#mealSelect').val(),
                numberOfPeople: $('#numberOfPeople').val(),
                restaurantSelect: $('#restaurantSelect').val(),
                dishData: dishData
            },
            success: function (response) {
                $('.div-step4').empty().html(response);
                $('.div-step'+currentStep).hide();
                $('#step'+currentStep).removeClass('text-danger');
                currentStep++;
                $('.div-step'+currentStep).show();
                $('#step'+currentStep).addClass('text-danger');
                $('#btnNext').hide();
                $('#btnSubmit').show();

            },
            error: function () {
                console.log(error);
            }
        });
    }

</script>