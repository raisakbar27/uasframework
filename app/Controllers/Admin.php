<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $db, $builder;


    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }


    public function index()
    {
        // $users = new \Myth\Auth\Models\UserModel();
        $data = [
            
            'config' => config('Auth'),
             'title' => 'User List',
            //  'users' => $users->findAll(),
            
        ];
        
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();
       
        
        return view('admin/index', $data);
    }


    public function detail($id = 0)
    {
        
        $data = [
            
            'config' => config('Auth'),
             'title' => 'User List',
           
            
        ];
        
        $this->builder->select('users.id as userid, username, fullname, user_img, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['users'] = $query->getRow();
       
        if(empty($data['user'])) {
            return redirect()->to('/admin');
        }
        return view('admin/detail', $data);
    }

}
