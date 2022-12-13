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

                <div class="col-md-12">

                @component('back.components.box')
                @slot('type')
                    primary
                @endslot
                @slot('boxTitle')
                   {{-- Hospital Statistics --}}
                @endslot

                <input id="counterId" name="id" type="hidden" value="{{@$roi_details->id}}">
                <div class="row">
                <div class="col-md-6">
                @include('back.partials.input', [
                    'input' => [
                        'name' => 'OTI',
                        'value' => isset($roi_details) ? $roi_details->OTI : '',
                        'input' => 'number',
                        'title' => __('One time Investment (AED)'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'recurring_payment',
                        'value' => isset($roi_details) ? $roi_details->recurring_payment : '',
                        'input' => 'number',
                        'title' => __('Recurring payment (AED)'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'fuel_saving',
                        'value' => isset($roi_details) ? $roi_details->fuel_saving : '',
                        'input' => 'number',
                        'title' => __('Fuel Savings (%)'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'maintenance_saving',
                        'value' => isset($roi_details) ? $roi_details->maintenance_saving : '',
                        'input' => 'number',
                        'title' => __('Maintenance Saving (%)'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'CO2E',
                        'value' => isset($roi_details) ? $roi_details->CO2E : '',
                        'input' => 'number',
                        'title' => __('CO2 Emissions (Kgs/Litre'),
                        'required' => true,
                    ]
                ])
            </div>
            <div class="col-md-6">

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'labour_saving',
                        'value' => isset($roi_details) ? $roi_details->labour_saving: '',
                        'input' => 'number',
                        'title' => __('Labour Saving (%)'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'fuel_cost',
                        'value' => isset($roi_details) ? $roi_details->fuel_cost : '',
                        'input' => 'number',
                        'title' => __('Cost of Fuel (AED)'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'AMM',
                        'value' => isset($roi_details) ? $roi_details->AMM: '',
                        'input' => 'number',
                        'title' => __('Annual Maintenance Multiplier'),
                        'required' => true,
                    ]
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'TWD',
                        'value' => isset($roi_details) ? $roi_details->TWD : '',
                        'input' => 'number',
                        'title' => __('Total Working Days / Month'),
                        'required' => true,
                    ]
                ])

                </div>
                </div>

            @endcomponent

            </div>

            <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
            </div>

            </div>

        @endsection
