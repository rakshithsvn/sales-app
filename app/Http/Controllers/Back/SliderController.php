<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\SliderRequest,
    Models\Slider
};
use DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the sliders.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $search = ($request['search'])?$request['search']:null;
        $sliders = Slider::orderBy('id','desc')->paginate(10);

        if(isset($search)){
                 $sliders =  Slider::where('title', 'like', "%".$search."%")->orWhere('excerpt','like',"%".$search."%")->paginate(10);

           }
        $links = $sliders->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.slider.table", ['sliders' => $sliders])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.slider.index', compact ('sliders'));
    }

    /**
     * Show the form for creating a new sliderr.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hierarchy = Slider::select(DB::raw('MAX(CAST(hierarchy AS UNSIGNED )) +1 as hierarchy'))->first();
        if(is_null($hierarchy->hierarchy)){
            $hierarchy = 1;
        }else{
            $hierarchy = $hierarchy->hierarchy;
        }
        return view('back.slider.create',compact('hierarchy'));
    }

    /**
     * Store a newly created slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['user_id' => auth()->id()]);
        Slider::create($request->all());
        return redirect(route('sliders.index'))->with('category-ok', __('The slider has been successfully created'));
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $sliders = Slider::find($slug);
        return view('back.slider.edit', compact ('sliders'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $request->merge(['active' => $request->has('active')]);
        $slider->update($request->all());

        return redirect(route('sliders.index'))->with('category-ok', __('The slider has been successfully updated'));
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Slider $slider, $status = false)
    {
        $slider->active = $status;
        $slider->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete ();
        return response ()->json ();
    }

}
