<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\UserUpdateRequest,
    Http\Requests\UserCreateRequest,
    Models\User,
    Repositories\UserRepository
};

class UserController extends Controller
{
    use Indexable;

    /**
     * Create a new UserController instance.
     *
     * @param  \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;

        $this->table = 'users';
    }

     /**
     * create "new" field for user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('back.users.create');
    }
    /**
     * create "new" field for user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $this->repository->create($request);
        
        return redirect()->route('users.index')->with('create-updated', __('The user has been successfully created'));
    }


    /**
     * Update "new" field for user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(User $user)
    {
        $user->ingoing->delete ();

        return response ()->json ();
    }

    /**
     * Update "valid" field for user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateValid(User $user)
    {
        $user->valid = true;
        $user->save();

        return response ()->json ();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('back.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->repository->update($request, $user);

        return redirect()->route('users.index')->with('create-updated', __('The user has been successfully updated'));
    }

    /**
     * Remove the user from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete ();

        return response ()->json ();
    }

    public function changePassword()
    {
        $user = auth()->user();

        return view('back.users.change-password',compact('user'));
    }

    public function saveChangePassword(Request $request)
    {

       // $password = bcrypt($request->oldPass);

       // dd($password);

       // dd($request->all());
       // 
        $user = User::find(auth()->user()->id);
        $data = $request->all();
          
        if (Hash::check($request->oldPass, $user->password))
        { 

            $user->password = bcrypt($request->newPass);
            $user->save();
            return redirect(route('users.index'))->with('post-ok', __('Password updated successfully.'));  
            
        }
         else
         {
            return redirect(route('users.changepassword'))->with('post-danger', __('Entered current password doesnot match with the database.'));  

         }

    }

}
