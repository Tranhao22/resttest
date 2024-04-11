<option value="" selected>---</option>
@foreach ($dataOptions as $item)
    <option value="{{ $item }}">{{ $item }}</option>
@endforeach