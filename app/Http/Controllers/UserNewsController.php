<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users\UserNews;

class UserNewsController extends Controller
{
    /**
     * Get single user manual
     * 
     * @return array
     */
    public function get($id){
        $userNews = UserNews::where('active', 1)->find($id);
        if(!$userNews){
            abort(404, 'Could not find user news');
        }

        return $userNews;
    }

    /**
     * Get all news
     * 
     * @return array
     */
    public function getAllNews(){
        return UserNews::where('active', 1)->get();
    }
}
