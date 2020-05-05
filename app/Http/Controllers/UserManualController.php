<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users\UserManual;

class UserManualController extends Controller
{
    /**
     * Get single user manual
     * 
     * @return array
     */
    public function get($id){
        $userManual = UserManual::find($id);
        if(!$userManual){
            abort(404, 'Could not find user manual');
        }

        return $userManual;
    }

    /**
     * Get all manuals
     * 
     * @return array
     */
    public function getAllManuals(){
        return UserManual::get();
    }
}
