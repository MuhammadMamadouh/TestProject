@extends('layout.master')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$title}}</h5>
                </div>
                <div class="card-body">
                    <div class="row product-adding">
                        <div class="col-xl-7">
                            <form class="needs-validation add-product-form" action="{{$actionLink}}" method="POST">
                                @csrf @if(isset($item)) @method('put') @endif

                                <div class="form" id="form">
                                    @foreach($writables as $attr => $key)

                                    @php($type = $key['type'])
                                    @php($required = $key['required'])
                                    @php($text = $key['text'])
                                    <div class="form-group mb-3  row">
                                        @if (in_array($type, App\Helpers\Helper::generalInputs()))
                                        <x-label :text=$text :attr="$attr" :isRequired="$required"></x-label>

                                        @isset($item)
                                        <x-general-input :attr="$attr" :type="$type" :isRequired="$required"
                                            :item="$item">
                                        </x-general-input>
                                        @else
                                        <x-general-input :attr="$attr" :type="$type" :isRequired="$required">
                                        </x-general-input>
                                        @endisset
                                        @elseif($type === 'selection')
                                        <x-label :attr="$attr" :text="$text" :isRequired="$required">
                                        </x-label>
                                        @isset($item)
                                        <x-selection :attr="$attr" :key="$key" :isRquired=$required :item="$item">
                                        </x-selection>
                                        @else
                                        <x-selection :attr="$attr" :key="$key" :isRquired=$required></x-selection>
                                        @endisset
                                        @endif
                                    </div>
                                    @endforeach

                                    <a class="btn btn-danger" id="addMore">Add</a>

                                    <div class="group" id="item">
                                        <div class="form-group mb-3 row">
                                            <x-label text="Item Name" attr="item_name" isRequired="true"></x-label>
                                            <div class="col-md-3 ">
                                                <x-general-input attr="item_name[]" type="text" isRequired="true">
                                                </x-general-input>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <x-label text="Quantity" attr="qty" isRequired="true"></x-label>
                                            <div class="col-md-3">
                                                <x-general-input attr="qty[]" type="text" isRequired="true">
                                                </x-general-input>
                                            </div>
                                            <x-label text="Width" attr="width" isRequired="true"></x-label>
                                            <div class="col-md-3 ">
                                                <x-general-input attr="width[]" type="text" isRequired="true">
                                                </x-general-input>
                                            </div>
                                            <x-label text="Height" attr="height" isRequired="true"></x-label>
                                            <div class="col-md-3">
                                                <x-general-input attr="height[]" type="text" isRequired="true">
                                                </x-general-input>
                                            </div>
                                            <x-label text="Depth" attr="depth" isRequired="true"></x-label>
                                            <div class="col-md-3 ">
                                                <x-general-input attr="depth[]" type="text" isRequired="true">
                                                </x-general-input>
                                            </div>
                                        </div>
                                        <a class="btn btn-danger removeDiv">remove</a>
                                    </div>
                                </div>

                                <div class="offset-xl-3 offset-sm-4">

                                    <button type="submit" class="btn btn-primary">
                                    Submit
                                    </button>
                                    <a href="{{url('/')}}" type="button" class="btn btn-light">Discard</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/duplicate.js')}}"></script>
<script>
    $('#addMore').click(function(){
       let div = $('#item').clone();
  div.find('input').val('');
       div.appendTo('#form');
    });
    $('body').on('click', '.removeDiv', function (e) {
        $(this).parent('div').remove();
    });
    $('#truck_type').change(function(e){
        truck_id = this.value;
        return getTrucks(truck_id);
    })
    function getTrucks(truck_id){
    var url = '{{ route('getTrucks', [':id']) }}';
    url = url.replace(':id', truck_id);
    var trucks = $('#truck_id');

    $.ajax({
        dataType: 'json',
        url: url,
        success: function (resp) {
            trucks.empty();
            $.each(resp, function (i, data) {
            trucks.append($('<option>', {
                value: data['id'],
                text: data['license'],
                }));
            });
        }
    })
    }
</script>
@endsection
