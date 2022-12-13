<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Models\Feature
};
use DB;
use Illuminate\Support\Str;

class FeatureController extends Controller
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
        $features = Feature::orderBy('id','desc')->paginate(10);

        if(isset($search)){
                 $features =  Feature::where('name', 'like', "%".$search."%")->paginate(10);

           }
  $links = $features->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.features.table", ['features' => $features])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view('back.features.index', compact ('features'));
    }

    /**
     * Show the form for creating a new sliderr.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('back.features.create');
    }

    /**
     * Store a newly created slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $record_exists = Feature::where('name',$request->name)->whereNull('deleted_at')->first();
        if(empty($record_exists))
        {

        $request->merge(['slug' => Str::slug($request->name)]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['user_id' => auth()->id()]);
        Feature::create($request->all());
        return redirect(route('features.index'))->with('category-ok', __('The feature has been successfully created'));
    }
    else
    {
        return redirect(route('features.index'))->with('category-danger', __('The feature already exist'));
    }
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $features = Feature::find($slug);

        return view('back.features.edit', compact ('features'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \App\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $record_exists = Feature::where('name',$request->name)->where('id','!=',$feature->id)->whereNull('deleted_at')->first();
        if(empty($record_exists))
        {

        $request->merge(['slug' => Str::slug($request->name)]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['user_id' => auth()->id()]);
        $feature->update($request->all());
          return redirect(route('features.index'))->with('category-ok', __('The feature has been successfully updated'));

    }
    else
    {
        return redirect(route('features.index'))->with('category-danger', __('The feature already exist. Cannot update'));
    }
    }

     /**
     * Update "active" field for slider.
     *
     * @param  \App\Models\Slider $slider
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Feature $feature, $status = false)
    {
        $feature->active = $status;
        $feature->save();

        return response ()->json ();
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete ();
        return response ()->json ();
    }

}
