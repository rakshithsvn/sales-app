@extends('back.layout')

@section('main')

    @yield('form-open')
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-12">
                @if (session('post-ok'))
                    @component('back.components.alert')
                        @slot('type')
                            success
                        @endslot
                        {!! session('post-ok') !!}
                    @endcomponent
                @endif

                 @if (session('post-danger'))
                    @component('back.components.alert')
                        @slot('type')
                            danger
                        @endslot
                        {!! session('post-danger') !!}
                    @endcomponent
                @endif

                {{-- <div class="col-md-6"> 
                @component('back.components.box')
                @slot('type')
                    primary
                @endslot
                @slot('boxTitle')
                   Dealers Statistics
                @endslot

                <input id="counterId" name="id" type="hidden" value="{{@$counter_details->id}}">
                <div class="col-md-6">
                @include('back.partials.input', [
                    'input' => [
                        'name' => 'strong_dealers',
                        'value' => isset($counter_details) ? $counter_details->strong_dealers : '',
                        'input' => 'text',
                        'title' => __('Strong Dealers'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'medium_dealers',
                        'value' => isset($counter_details) ? $counter_details->medium_dealers : '',
                        'input' => 'text',
                        'title' => __('Medium Dealers'),
                        'required' => true,
                    ]
                ])

                </div>
                <div class="col-md-6">
                @include('back.partials.input', [
                    'input' => [
                        'name' => 'light_dealers',
                        'value' => isset($counter_details) ? $counter_details->light_dealers : '',
                        'input' => 'text',
                        'title' => __('Light Dealers'),
                        'required' => true,
                    ]
                ])

                </div>

                @endcomponent  
                </div>  --}}

                <div class="col-md-6">
              
                @component('back.components.box')
                @slot('type')
                    primary
                @endslot
                @slot('boxTitle')
                   {{-- Hospital Statistics --}}
                @endslot

                <input id="counterId" name="id" type="hidden" value="{{@$counter_details->id}}">
                <div class="col-md-6">
                @include('back.partials.input', [
                    'input' => [
                        'name' => 'count1',
                        'value' => isset($counter_details) ? $counter_details->count1 : '',
                        'input' => 'number',
                        'title' => __('Industry Projects'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'count2',
                        'value' => isset($counter_details) ? $counter_details->count2 : '',
                        'input' => 'number',
                        'title' => __('Years in Industry'),
                        'required' => true,
                    ]
                ])
            </div>
            <div class="col-md-6"> 

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'count3',
                        'value' => isset($counter_details) ? $counter_details->count3 : '',
                        'input' => 'number',
                        'title' => __('Customer Satisfaction'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'count4',
                        'value' => isset($counter_details) ? $counter_details->count4 : '',
                        'input' => 'number',
                        'title' => __('Happy Customers'),
                        'required' => true,
                    ]
                ])

                </div>

            @endcomponent  

            </div>

            <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
            </div>

            </div>

        @endsection