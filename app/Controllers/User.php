<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {   
        
        $data = [
            
            'config' => config('Auth'),
            'title' => 'My Profile',
            
        ];
        
        
        return view('user/index', $data);
    }

}
