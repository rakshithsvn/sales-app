<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\{
    Http\Controllers\Controller,
    Http\Requests\EventUserUpdateRequest,
    Http\Requests\EventUserCreateRequest,
    Models\EventUser,
    Models\LinkUser,
    Repositories\EventUserRepository
};

class EventUserController extends Controller
{
    use Indexable;

    /**
     * Create a new EventUserController instance.
     *
     * @param  \App\Repositories\EventUserRepository $repository
     */
    public function __construct(EventUserRepository $repository)
    {

        $this->repository = $repository;

        $this->table = 'event_users';
    }

    public function index(Request $request)
    {
        $search = ($request['search']) ? $request['search'] : null;
        $event_users = EventUser::orderBy('id', 'desc')->paginate(10);

        if (isset($search)) {
            $event_users =  EventUser::where('name', 'like', "%" . $search . "%")->paginate(10);
        }
        $links = $event_users->appends($request->all())->links('back.pagination');
        // Ajax response
        if ($request->ajax()) {

            return response()->json([
                'table' => view("back.event-users.table", ['event_users' => $event_users])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }

        return view('back.event-users.index', compact('event_users'));
    }

    /**
     * create "new" field for user.
     *
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.event-users.create');
    }
    /**
     * create "new" field for user.
     *
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $exist = EventUser::where('email', @$request->email)->first();
        if($exist) {
             return $this->create400Error([
                'message' => 'Already registered. Please login.',
                'status' => false
            ]);
        }
        $result = $this->repository->create($request);
        $linkResult = LinkUser::create(['event_user_id' => $result->id, 'event_id' => 1]);

      $res = ['message' => 'Registration done Successfully',
            'data'=> [  'token'=>'34d@#$RTGR#$yWERT%$##EFR#@WDFR#WSD#WSD#WSD#SDREDGT',
    'user_details'=>[
      'isAccountActive'=>true,
      'user_id'=>$result->id,
      'user_name'=>$result->name,
      'user_email'=>$result->email,
      'mob_number'=>$result->mobile_number,
      'street_address'=>$result->address,
      'state'=>$result->state,
      'district'=>$result->district,
      'pin'=>$result->pin_code,
      'lab_name'=>$result->lab_name
    
      ]]];

        //  return response()->json([$res], 200);

        return redirect()->route('event-users.index')->with('post-ok', __('The user has been successfully created'));
    }

     private function create400Error($array)
    {
        return response(array_merge($array, [
            'status_code' => 400
        ]), 400);
    }

    /**
     * Update "new" field for user.
     *
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(EventUser $event_user)
    {
        $event_user->ingoing->delete();

        return response()->json();
    }

    /**
     * Update "valid" field for user.
     *
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function updateValid(EventUser $event_user)
    {
        $user->is_verified = true;
        $user->save();

        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function edit(EventUser $event_user)
    {
        return view('back.event-users.edit', compact('event_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function update(EventUserUpdateRequest $request, EventUser $event_user)
    {
        // dd($request);
        $this->repository->update($request, $event_user);

        return redirect()->route('event-users.index')->with('post-ok', __('The user has been successfully updated'));
    }

    /**
     * Remove the user from storage.
     *
     * @param  \App\Models\EventUser $event_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventUser $event_user)
    {
        $event_user->delete();

        return response()->json();
    }

    public function changePassword(EventUser $event_user)
    {
        return view('back.event-users.change-password', compact('event_user'));
    }

    public function saveChangePassword(Request $request)
    {

        // $password = bcrypt($request->oldPass);
        // dd($request->all());
        $event_user = EventUser::find(auth()->user()->id);
        $data = $request->all();

        // if (Hash::check($request->oldPass, $event_user->password))
        // { 
        $event_user->password = bcrypt($request->newPass);
        $event_user->save();
        return redirect(route('event-users.index'))->with('post-ok', __('Password updated successfully.'));
        // }
        //  else
        //  {
        //     return redirect(route('event-users.changepassword', [$event_user]))->with('post-danger', __('Entered current password doesnot match with the database.'));  
        //  }
    }
}
