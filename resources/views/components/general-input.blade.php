
    <div class="col-xl-8 col-sm-7">
        <input type="{{$type}}" class="form-control" id="{{$attr}}" name="{{$attr}}" value="{{isset($item) ? $item->$attr : ''}}">
    @if ($errors->has($attr))
        <span class="text-danger">{{ $errors->first($attr) }}</span>
    @endif
    </div>
{{-- <div class="form-group">
    <input type="{{$type}}" class="form-control" id="{{$attr}}" name="{{$attr}}" value="{{isset($item) ? $item->$attr : ''}}">
    @if ($errors->has($attr))
        <span class="text-danger">{{ $errors->first($attr) }}</span>
    @endif
</div> --}}
