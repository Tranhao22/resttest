@extends('layout')
@section('content')

    <div class="card-body">
        <div class="row mt-2 div-step1">
            <div class="mb-3">
                <label for="" class="form-label">Please select a Meal</label>
                <select class="form-select" id="mealSelect" name="mealSelect" required>
                    <option value="" selected>---</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                </select>
                <div class="meal-error-feedback" style="color:red;"></div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Please Enter Number of people</label>
                <input type="number" class="form-control" id="numberOfPeople" max="10"  min="1" value="1" required>
                <div class="numberOfPeople-error-feedback" style="color:red;"></div>
            </div>
        </div>

        <div class="row mt-2 div-step2" style="display:none;">
            <div class="mb-3">
                <label for="" class="form-label">Please select a Restaurant</label>
                <select class="form-select" name="restaurantSelect" id="restaurantSelect" required>
                    <option value="" selected>---</option>
                </select>
                <div class="restaurant-error-feedback" style="color:red;"></div>
            </div>
        </div>

        <div class="row mt-2 div-step3" style="display:none;">
            <div class="dish">
                <div class="row g-3 dish-lable">
                    <div class="col-md-6">
                        <label for="" class="form-label">Please Select A Dish</label>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Please Enter No. of Serving</label>
                    </div>
                </div>
                <div class="dish-parent">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <select class="form-select" name="dishSelect[]" id="dishSelect" required>
                                <option value="" selected>---</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="noOfSevice[]" id="noOfSevice" min=1 value="1" required>
                        </div>
                    </div>
                </div>
                <div class="dish-child"></div>
            </div>
            <div class="dish-error-feedback" style="color:red;"></div>
            
            <div class="row" style="display: flex;justify-content: center;">
                <img src="{{ asset('plus.png') }}" alt="plus" style="width:60px;height:40px;" onclick="addDish();">
            </div>
        </div>

        <div class="row mt-2 div-step4" style="display:none;">
            
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6 text-start">
                    <button type="button" class="btn btn-danger pull-right shadow" id="btnPrev" style="display:none;" onclick="previous();">Previous</button>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary shadow" id="btnNext" onclick="next();">Next</button>
                    <a class="btn btn-primary shadow" href="{{ route('restaurant.submit') }}" id="btnSubmit" style="display:none;">Submit</a>
                </div>
            </div>
        </div>
    </div>
@include('js')

@endsection