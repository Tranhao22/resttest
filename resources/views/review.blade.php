<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label">Meal</label>
    <div class="col-sm-10">
      {{ $dataOrder['mealSelect'] }}
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label">No of People</label>
    <div class="col-sm-10">
        {{ $dataOrder['numberOfPeople'] }}
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label">Restaurant</label>
    <div class="col-sm-10">
        {{ $dataOrder['restaurantSelect'] }}
    </div>
</div>
<div class="mb-3 row">
    <label for="txtPeople" class="col-sm-2 col-form-label">Dishes</label>
    <div class="col-sm-10">
        @foreach ($dataOrder['dishData'] as $item)
            <span>{{ $item[0] }} - {{ $item[1] }}</span><br>
        @endforeach
    </div>
</div>