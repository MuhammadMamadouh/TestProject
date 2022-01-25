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

                                <div class="form">
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

                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-light">Discard</button>
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

@endsection
