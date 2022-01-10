<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function admin_panel(User $user){
        if($user->id_role==DB::table('roles')->select('id')->where('name','administrator')->get()->first()->id)
            return true;
        else
            return false;
    }

}
