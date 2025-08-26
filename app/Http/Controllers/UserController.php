<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Department;
use App\Notifications\UserLogin;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $permissionsUser = PermissionRole::getPermission('User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $data['permissionsAdd']  = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        $data['permissionsEdit'] = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        $data['permissionsDelete'] = PermissionRole::getPermission('Delete User', Auth::user()->role_id);

        $users = User::with(['user_roles', 'departments'])->get();
        $data['meta_title'] = 'Users';
        return view('users.index',compact('users'), $data);
    }

    public function create()
    {
        $permissionsUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $departments = Department::getRecord();
        $roles = UserRole::getRecord();
        $meta_title = 'Create New Users';

        return view('users.create', compact('departments', 'roles', 'meta_title'));
    }

    public function store(Request $request)
    {
        $permissionsUser = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'role_id' => 'required|string|max:15',
            // 'department' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        // $user->department = $request->department;
        $user->password =  Hash::make($request->password);
        $user->created_by =  Auth::user()->id;

        $user->save();

        $notification = array(
            'message' => 'User created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);

    }

    public function edit($id)
    {
        $permissionsUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }
        
       $user = User::findOrFail($id);
       $department = Department::getRecord();
       $roles = UserRole::getRecord();
       $meta_title = 'Edit Users';

       return view('users.edit', compact('user', 'department','roles', 'meta_title'));
    }

    public function update(Request $request, $id)
    {
        $permissionsUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'role_id' => 'required|string|max:15',
            'department' => 'string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        // $user->department = $request->department;
        if(!empty($request->password))
        {
            $user->password =  Hash::make($request->password);
        }
        $user->updated_by =  Auth::user()->id;
        $user->update();

        $notification = array(
            'message' => 'User Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function profile($id)
    {
        $permissionsUser = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }
        
       $user = User::findOrFail($id);
       $department = Department::getRecord();
       $roles = UserRole::getRecord();

       return view('users.profile', compact('user', 'department','roles'));
    }

    public function updateprofile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'fname' => 'nullable|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password =  Hash::make($request->password);
        $user->updated_by =  Auth::user()->id;

        $user->update();

        $notification = array(
            'message' => 'Profile Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }



    public function destroy($id)
    {
        $permissionsUser = PermissionRole::getPermission('Delete User', Auth::user()->role_id);
        if(empty($permissionsUser))
        {
            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $user = User::findOrFail($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('user.index')->with($notification);
    }
}
