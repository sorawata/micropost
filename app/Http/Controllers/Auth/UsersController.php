<?php
namespace App\Http\Controllers;

use Illminate\Http\Request;

use App\User;

class UsersController extends Controller{
    public function index(){
        $users=User::orderBy('id','desc')->paginate(10);
        return view('users.index',['user'=>$users,]);
    }
    
    public function show(){
        $user=User::findOrFail($id);
        
        return view('users.show',['user'=>$user]);
    }
}
?>