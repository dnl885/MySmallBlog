<?php

namespace App\Http\Controllers\Admin\Users;

use App\Constants\PaginationConstants;
use App\Constants\RoleConstants;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersController extends Controller
{

    public function index():View{
        $user = Auth::user();

        $users = User::where('id','!=',$user->id)->where('email_verified_at','!=',null)->paginate(PaginationConstants::ITEMS_PER_PAGE);

        return view('admin.users.index',compact('users'));
    }

    public function grantRole(Request $request){
        $userId = $request->request->get('user_id');
        $action = $request->request->get('action');

        $user = User::find($userId);

        $role = Role::where('role_key',RoleConstants::ROLE_CONTENT_CREATOR)->first();

        $resp = [];

        if(!$user){
            $resp = ['success'=>false,'message'=>'User does not exist!'];
        }

        if(!$role){
            $resp = ['success'=>false,'message'=>'Role does not exist!'];
        }

        switch ($action){
            case 'grant':
                $role->users()->attach($user);
                $resp = ['success'=>true,'message'=>'Content creator role successfully granted!'];
                break;
            case 'revoke':
                $resp = ['success'=>true,'message'=>'Content creator role successfully revoked!'];
                $role->users()->detach($user);
                break;
        }

        return response()->json($resp);
    }
}
