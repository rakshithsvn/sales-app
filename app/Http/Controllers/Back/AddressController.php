<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\ParentMenu;
use App\Models\Post;

class AddressController extends Controller
{
   use Indexable;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request['search'])?$request['search']:null;
        $address_details = Address::paginate(10);
        if(isset($search))
        {
            $address_details =  Address::where('address', 'like', "%".$search."%")->paginate(10);
        }
        $links = $address_details->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.address.table", ['address_details' => $address_details])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }
        return view('back.address.index', compact ('address_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $branch_list = array(''=>'--- Select Branch ---','MAIN'=>'MAIN', 'BRANCH'=>'BRANCH', 'DEPARTMENT'=>'DEPARTMENT' );    

        // $parent_menu_id = ParentMenu::select('slug','id')->where('slug', 'facilities')->first();
        
        // $post_list = Post::where('parent_menu_id','=',@$parent_menu_id->id)->orderBy('id', 'asc')->whereNotNull('sub_menu_id')->get(); 

        return view('back.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->id()]);
        if(Address::create($request->all()))
        {
            return redirect(route('address.index'))->with('category-ok', __('The Address has been successfully created'));
        }
        else
        {
            return redirect(route('address.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address, $id = null)
    {
        $address_details = $address;

        // $branch_list = array(''=>'--- Select Branch ---','MAIN'=>'MAIN', 'BRANCH'=>'BRANCH', 'DEPARTMENT'=>'DEPARTMENT' );   

        // $parent_menu_id = ParentMenu::select('slug','id')->where('slug', 'facilities')->first();
        
        // $post_list = Post::where('parent_menu_id','=',@$parent_menu_id->id)->orderBy('id', 'asc')->whereNotNull('sub_menu_id')->get();     
        
        return view('back.address.edit', compact ('address_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        Address::find($id)->update($request->all());

        return redirect(route('address.index'))->with('category-ok', __('The Address has been successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address, $id = null)
    {
        $address->delete ();
        return response ()->json (); 
        
        // return redirect(route('address.index'))->with('category-ok', __('The Address has been successfully deleted'));
    }
}
