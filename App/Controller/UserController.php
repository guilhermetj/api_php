<?php 

namespace App\Controller;

use App\Models\User;

class UserController
{
    public function get($id)
    {

           return User::select($id);

    }
    public function getAll()
    {
            return User::selectAll();

    }
    public function post()
    {
        $data = $_POST;
       return User::insert($data);
    }
    public function update($id, $data)
    {   
        return User::update($id, $data);
    }
    public function delete($id)
    {
        return User::delete($id);
    }

}