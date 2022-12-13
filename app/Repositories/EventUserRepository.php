<?php

namespace App\Repositories;

use App\Models\EventUser;

class EventUserRepository
{
    /**
     * Get users collection paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {

        return EventUser::with('ingoing')
            // ->orderBy ($parameters['order'], $parameters['direction'])
            // ->when (($parameters['role'] !== 'all'), function ($query) use ($parameters) {
            //     $query->whereRole ($parameters['role']);
            // })->when ($parameters['valid'], function ($query) {
            //     $query->whereValid (true);
            // })->when ($parameters['confirmed'], function ($query) {
            //     $query->whereConfirmed (true);
            // })->when ($parameters['new'], function ($query) {
            //     $query->has ('ingoing');
            // })
            ->paginate($nbrPages);
    }

    /**
     * Update a user.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  \App\Models\User $user
     * @return void
     */
    public function update($request, $user)
    {
        $inputs = $request->all();

        if (isset($inputs['is_verified'])) {
            $inputs['is_verified'] = true;
        }

        if (isset($inputs['valid'])) {
            $inputs['valid'] = true;
        }
        
        $user->update($inputs);

        if (!$request->has('new') && $user->ingoing) {
            $user->ingoing->delete();
        }
    }

    public static function create($request)
    {
        $inputs = $request->all();
        if (isset($inputs['is_verified'])) {
            $inputs['is_verified'] = true;
        }

        if (isset($inputs['valid'])) {
            $inputs['valid'] = true;
        }
        $inputs['password'] = bcrypt($inputs['password']);
        $result = EventUser::create($inputs);
        return $result;
    }
}
