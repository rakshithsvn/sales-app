@extends('back.layout')

@section('css')
<style>
  textarea { resize: vertical; }

  .switch {
    position: relative;
    display: inline-block;
    width: 90px;
    height: 34px;
  }

  .switch input {display:none;}

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ca2222;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2ab934;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(55px);
    -ms-transform: translateX(55px);
    transform: translateX(55px);
  }

  /*------ ADDED CSS ---------*/
  .on
  {
    display: none;
  }

  .on, .off
  {
    color: white;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
  }

  input:checked+ .slider .on
  {display: block;}

  input:checked + .slider .off
  {display: none;}

  /*--------- END --------*/

  /* Rounded sliders */
  .slider.round { border-radius: 34px }

  .slider.round:before { border-radius: 50% }

  .last_name { margin-top: 10px }
</style>
<link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
@endsection

@section('main')

@yield('form-open')
{{ csrf_field() }}

<div class="row">

  <div class="col-md-8">

     {{--  @include('back.partials.boxinput', [
        'box' => [
          'type' => 'box-primary',
          'title' => __('Name'),
        ],
        'input' => [
          'name' => 'name',
          'value' => isset($faculties) ? $faculties->name : '',
          'input' => 'text',
          'required' => true,
        ],
        ]) --}}

        @component('back.components.boxinputs')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        @lang('Name')
        @endslot
        <div class="col-md-12">
          <input type="text" name="name" value="{{ isset($faculties) ? $faculties->name : '' }}" class="form-control" placeholder="First Name" required="">
        </div>
        <!-- <div class="col-md-6">
          <input type="text" name="last_name" value="{{ isset($faculties) ? $faculties->last_name : '' }}" class="form-control last_name" placeholder="Last Name"><br/>
        </div> -->
        @endcomponent

        @component('back.components.box')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        Contact Information
        @endslot

        <div class="row">

          <div class="col-md-6">

            {{-- @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Designation'),
              ],
              'input' => [
                'name' => 'designation',
                'value' => isset($faculties) ? $faculties->designation : '',
                'input' => 'text',
                'required' => false,
              ],
              ]) --}}

            @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Mobile No'),
              ],
              'input' => [
                'name' => 'mobile',
                'value' => isset($faculties) ? $faculties->mobile : '',
                'input' => 'text',
                'required' => false,
              ],
              ])

            </div>
            <div class="col-md-6">

             {{-- @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Qualification'),
              ],
              'input' => [
                'name' => 'qualification',
                'value' => isset($faculties) ? $faculties->qualification : '',
                'input' => 'text',
                'required' => false,
              ],
              ]) --}}

             @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Email Id'),
              ],
              'input' => [
                'name' => 'email_id',
                'value' => isset($faculties) ? $faculties->email_id : '',
                'input' => 'text',
                'required' => false,
              ],
              ])

            </div>
            <div class="col-md-4">              
             @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Facebook'),
              ],
              'input' => [
                'name' => 'facebook',
                'value' => isset($faculties) ? $faculties->facebook : '',
                'input' => 'text',
                'required' => false,
              ],
              ])
            </div>
            <div class="col-md-4">              
             @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Twitter'),
              ],
              'input' => [
                'name' => 'twitter',
                'value' => isset($faculties) ? $faculties->twitter : '',
                'input' => 'text',
                'required' => false,
              ],
              ])
            </div>
            <div class="col-md-4">              
             @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Instagram'),
              ],
              'input' => [
                'name' => 'instagram',
                'value' => isset($faculties) ? $faculties->instagram : '',
                'input' => 'text',
                'required' => false,
              ],
              ])
            </div>
          </div>

          @endcomponent

          @include('back.partials.boxinput', [
            'box' => [
              'type' => 'box-primary',
              'title' => __('Short Description'),
            ],
            'input' => [
              'name' => 'excerpt',
              'value' => isset($faculties) ? $faculties->excerpt : '',
              'input' => 'textarea',
              'rows' => 3,
              'required' => false,
            ],
            ])

            <div>
             @include('back.partials.boxinput', [
              'box' => [
                'type' => 'box-primary',
                'title' => __('Long Description'),
              ],
              'input' => [
                'name' => 'body',
                'value' => isset($faculties) ? $faculties->body : '',
                'input' => 'textarea',
                'rows' => 1,
                'required' => true,
              ],
              ])

            </div>

            <div class="body1">
              @include('back.partials.boxinput', [
                'box' => [
                  'type' => 'box-success',
                  'title' => 'long_desc1',
                ],
                'input' => [
                  'name' => 'body1',
                  'value' => isset($faculties) ? $faculties->body1 : '',
                  'input' => 'textarea',
                  'rows' => 10,
                  'required' => false,
                ],
                ])
              </div>

            </div>

            <div class="col-md-4">

              {{-- @component('back.components.boxinputs')
              @slot('type')
              primary
              @endslot
              @slot('boxTitle')
              @lang('Faculty Type')
              @endslot

              <select id="type" name="type" class="form-control" required="">
               <option value="">--Select--</option>
               @foreach(@$type_list as $id => $type)
               <option value="{{$id}}" {{(@$faculties->type == $id) ? 'selected' : ''}}>{{$type}}</option>
               @endforeach
             </select><br/>
             @endcomponent --}}

             <input type="hidden" name="appointment" value="0">
             <div class="app">
              @component('back.components.boxinputs')
              @slot('type')
              primary
              @endslot
              @slot('boxTitle')
              @lang('Appointment')
              @endslot
              <div class="col-md-6">
                <input type="hidden" name="appointment" value="0">
                <label class="switch"><input type="checkbox" id="appointment" name="appointment" value="1">
                  <div class="slider round">
                    <span class="on">ON</span><span class="off">OFF</span>
                  </div>
                </label>
              </div>
              <div class="col-md-6">
               <input type="number" class="form-control" name="limit" value="{{ @$faculties->limit ? @$faculties->limit : 100 }}" placeholder="Max Limit">
             </div>  <br/>
             @endcomponent

             @component('back.components.boxinputs')
             @slot('type')
             primary
             @endslot
             @slot('boxTitle')
             @lang('Appointment Blocking')
             @endslot
             <div class="col-md-6">
              <label for="menus"> From Date</label>

              <div class="input-group input-append date" id="datePicker1">

                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="DD/MM/YYYY" value="{{ @$faculties->from_date ? @$faculties->from_date->format('d/m/Y') : '' }}" autocomplete="off">

                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
              </div>

            </div>

            <div class="col-md-6">
              <label for="menus"> To Date</label>

              <div class="input-group input-append date" id="datePicker2">

               <input type="text" name="to_date" id="to_date" class="form-control" placeholder="DD/MM/YYYY" value="{{ @$faculties->to_date ? @$faculties->to_date->format('d/m/Y') : '' }}" autocomplete="off">

               <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
             </div>

           </div>
           @if(@$faculties->from_date)
           <div class="col-md-12 text-center"><br/>
            <button class="btn btn-warning">@lang('Unblock')</button>
          </div>
          @endif
          @endcomponent
        </div>

        @component('back.components.box')
        @slot('type')
        info
        @endslot
        @slot('boxTitle')
        SEO
        @endslot
        @include('back.partials.input', [
          'input' => [
            'name' => 'meta_description',
            'value' => isset($faculties) ? $faculties->meta_description : '',
            'input' => 'text',
            'title' => __('META Description'),
            'input' => 'textarea',
            'rows' => 3,
            'required' => true,
          ]
          ])
        @include('back.partials.input', [
          'input' => [
            'name' => 'meta_keywords',
            'value' => isset($faculties) ? $faculties->meta_keywords : '',
            'input' => 'text',
            'title' => __('META Keywords'),
            'input' => 'textarea',
            'rows' => 3,
            'required' => true,
          ]
          ])
        @include('back.partials.input', [
          'input' => [
            'name' => 'seo_title',
            'value' => isset($faculties) ? $faculties->seo_title : '',
            'input' => 'text',
            'title' => __('SEO Title'),
            'required' => true,
          ],
          ])
          @endcomponent


          @component('back.components.box')
          @slot('type')
          primary
          @endslot
          @slot('boxTitle')
          @lang('Thumb Image')
          @endslot
          <img id="img" src="@isset($faculties) {{ $faculties->image }} @endisset" alt="" class="img-responsive img-fluid">
          @slot('footer')
          <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
            <div class="input-group">
              <div class="input-group-btn">
                <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
              </div>
              <!-- /btn-group -->
              <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($faculties) ? $faculties->image : '') }}">
            </div>
            {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
          </div>
          @endslot
          @endcomponent

        </div>

        <div class="col-md-8">


          @include('back.partials.boxinput', [
            'box' => [
              'type' => 'box-primary',
              'title' => __('Content In Tab Section'),
            ],
            'input' => [
              'name' => 'tab_section',
              'value' => isset($faculties) ? $faculties->tab_section : false,
              'input' => 'checkbox',
              'label' => __('Yes'),
            ],
            ])

            <div class="tabContent">

            <table class="table custom_table" id="custom_table" style="">
                  <thead></thead>
                    <tbody id="tbl1">
                       @if(empty($faculty_tabs))
                       <tr>
                        <td style="display:none;"><input type="hidden" name="content_id[]" value="0" class="tab_id"> </td>
                         <td>
                         <div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Event Date</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div>
                         <div class="box-body">
                           <div class="form-group">
                           <div class="input-group input-append date datePicker1" id="datePicker1">
                            <input type="text" name="event_date[0]" id="event_date[0]" class="form-control" placeholder="DD/MM/YYYY" value="{{ isset($faculty_tabs) ? $faculty_tabs[0]->event_date : '' }}" autocomplete="off">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            </div>
                          </div>
                        </div>

                           {{-- @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('Event Date'),
                           ],
                           'input' => [
                           'name' => 'event_date[0]',
                           'value' => isset($faculty_tabs) ? $faculty_tabs[0]->event_date: '',
                           'input' => 'text',
                           'required' => true,
                           ],
                          ]) --}}                          

                        </td>
                        <td>
                           @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('Event Title'),
                           ],
                           'input' => [
                           'name' => 'event_title[0]',
                           'value' => isset($faculty_tabs) ? $faculty_tabs[0]->event_title: '',
                           'input' => 'text',
                           'required' => true,
                           ],
                          ])
                        </td>
                        <td>
                           @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('Start Time'),
                           ],
                           'input' => [
                           'name' => 'start_time[0]',
                           'value' => isset($faculty_tabs) ? $faculty_tabs[0]->start_time: '',
                           'input' => 'text',
                           'required' => true,
                           ],
                          ])
                        </td>
                        <td>
                           @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('End Time'),
                           ],
                           'input' => [
                           'name' => 'end_time[0]',
                           'value' => isset($faculty_tabs) ? $faculty_tabs[0]->end_time: '',
                           'input' => 'text',
                           'required' => true,
                           ],
                          ])
                        </td>
                                                   
                        <td></td><td></td>

                   </tr>
                   @else
                   @foreach($faculty_tabs as $key=>$tabs)
                   <tr value="{{$tabs->id}}">
                    <td style="display:none;"><input type="hidden" name="content_id[]" value="{{$tabs->id}}" class="tab_id"> </td>
                     <td>

                     <div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Event Date</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div>
                     <div class="box-body">
                       <div class="form-group">
                           <div class="input-group input-append date datePicker1" id="datePicker1">
                            <input type="text" name="event_date[{{$tabs->id}}][{{$key}}]" id="event_date[{{$tabs->id}}][{{$key}}]" class="form-control" placeholder="DD/MM/YYYY" value="{{ isset($faculty_tabs) ? $tabs->event_date : '' }}" autocomplete="off">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            </div>
                          </div>
                        </div>

                        {{-- @include('back.partials.boxinput', [
                        'box' => [
                        'type' => 'box-primary',
                        'title' => __('Event Date'),
                        ],
                        'input' => [
                        'name' => 'event_date['.$tabs->id.']['.$key.']',
                        'value' => isset($faculty_tabs) ? $tabs->event_date: '',
                        'input' => 'text',
                        'required' => true,
                        ],
                        ]) --}}
                    </td>
                     <td>
                        @include('back.partials.boxinput', [
                        'box' => [
                        'type' => 'box-primary',
                        'title' => __('Event Title'),
                        ],
                        'input' => [
                        'name' => 'event_title['.$tabs->id.']['.$key.']',
                        'value' => isset($faculty_tabs) ? $tabs->event_title: '',
                        'input' => 'text',
                        'required' => true,
                        ],
                        ])
                        </td>
                    <td>
                        @include('back.partials.boxinput', [
                        'box' => [
                        'type' => 'box-primary',
                        'title' => __('Start Time'),
                        ],
                        'input' => [
                        'name' => 'start_time['.$tabs->id.']['.$key.']',
                        'value' => isset($faculty_tabs) ? $tabs->start_time: '',
                        'input' => 'text',
                        'required' => true,
                        ],
                        ])
                        </td>
                        <td>
                        @include('back.partials.boxinput', [
                        'box' => [
                        'type' => 'box-primary',
                        'title' => __('End Time'),
                        ],
                        'input' => [
                        'name' => 'end_time['.$tabs->id.']['.$key.']',
                        'value' => isset($faculty_tabs) ? $tabs->end_time: '',
                        'input' => 'text',
                        'required' => true,
                        ],
                        ])
                        </td>
                    <td>
                      <a class="btn btn-danger btn-xs btn-block tbl_rem" style="margin-bottom: 15px;" href="javascript:void(0)"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>

        </table>
        <a class="btn btn-success btn-xs" style="margin: 0 10px 10px;" id='tbl_add' href="javascript:void(0)"><i class="fa fa-plus"></i></a>
    </div>

              @include('back.partials.input', [
                'input' => [
                  'name' => 'active',
                  'value' => isset($faculties) ? $faculties->active : true,
                  'input' => 'checkbox',
                  'title' => __('Status'),
                  'label' => __('Active'),
                ],
                ])
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

                <a href="{{route('faculties.index')}}" class="btn btn-default">@lang('Cancel')</a>

              </div>
              <!-- /.row -->
            </form>

            @endsection

            @section('js')

            <script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
            <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
            <!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
            <script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
            <script>
             var faculty_tabs = '{{$faculty_tabs}}';
             var faculty_type = '{{ isset($faculties) ? $faculties->type : ''}}';

             var appointment = '{{ isset($faculties) ? $faculties->appointment : ''}}';

             if(appointment == 1)
             {
              $('#appointment').attr('checked','checked');
            }
    CKEDITOR.replace('body', {filebrowserBrowseUrl: '/elfinder/ckeditor'})

  //   @if(isset($tab_id))
  //   var tabKeyVal = {{$tab_id}};
  //   $.each(tabKeyVal, function( index, value ) {
  //    CKEDITOR.replace('tab_body['+value+']['+index+']', {filebrowserBrowseUrl: '/elfinder/ckeditor'})
  //  });
  //   @else
  //   CKEDITOR.replace('tab_body[0]', {filebrowserBrowseUrl: '/elfinder/ckeditor'})
  //   @endif
    // CKEDITOR.replace('body', {filebrowserBrowseUrl: '/elfinder/ckeditor'})
    // CKEDITOR.replace('body1', {filebrowserBrowseUrl: '/elfinder/ckeditor'})

    $('.popup_selector').click( function (event) {
      event.preventDefault()
      var updateID = $(this).attr('data-inputid')
      var elfinderUrl = '/elfinder/popup/'
      var triggerUrl = elfinderUrl + updateID
      $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '70%'
      })
    })


    function processSelectedFile(filePath, requestingField) {
      $('#' + requestingField).val('\\' + 'storage/' + filePath)
      $('#img').attr('src', '\\' + 'storage/' + filePath)
    }

    $('#slug').keyup(function () {
      $(this).val(v.slugify($(this).val()))
    })

    $('#slug').parent().parent().parent().hide();
    $('#hierarchy').prop('readonly', true);

    $('#title').keyup(function () {
      $('#slug').val(v.slugify($(this).val()))
    })

  </script>

  <script>

   $(document).ready(function() {
    var date = new Date();
    $('.datePicker1')
    .datepicker({
      format: 'dd/mm/yyyy',
      endDate:  new Date(),
    })
  });

   $(document).ready(function() {
    var date = new Date();
    $('#datePicker2')
    .datepicker({
      format: 'dd/mm/yyyy',
      startDate:  new Date(),
    })
  });
</script>

<script src="{{ asset('js/faculty.js') }}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

@endsection
