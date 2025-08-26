<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequset;

class DepartmentController extends Controller
{
    public function index()
    {
        $permissionsDepartment = PermissionRole::getPermission('Department', Auth::user()->role_id);
        if(empty($permissionsDepartment))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }
        
        $data['permissionsAdd']  = PermissionRole::getPermission('Add Department', Auth::user()->role_id);
        $data['permissionsEdit'] = PermissionRole::getPermission('Edit Department', Auth::user()->role_id);
        $data['permissionsDelete'] = PermissionRole::getPermission('Delete Department', Auth::user()->role_id);

        $departments = Department::getRecord();
        return view('department.index', $data, compact('departments'));
    }

    public function create()
    {
        $permissionsDepartment = PermissionRole::getPermission('Add Department', Auth::user()->role_id);
        if(empty($permissionsDepartment))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        return view('department.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        $permissionsDepartment = PermissionRole::getPermission('Add Department', Auth::user()->role_id);
        if(empty($permissionsDepartment))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $department = $request->validated();

        Department::create([
           'name' => $department['department_name'],
           'description' => $department['department_description'],
           'department_code' => $department['department_code'],
           'status' => 1,
           'createdBy' => Auth::user()->id,
        ]);

        $notification = array(
            'message' => 'Department Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('department.index')->with($notification);
      
    }

    public function edit($id)
    {
        $permissionsDepartment = PermissionRole::getPermission('Edit Department', Auth::user()->role_id);

        if(empty($permissionsDepartment))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

       $department = Department::getSingle($id);
       return view('department.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        $permissionsDepartment = PermissionRole::getPermission('Edit Department', Auth::user()->role_id);

        if(empty($permissionsDepartment))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }

        $data = $request->validated();
        $department = Department::getSingle($id);

        $department->update([
            'name' => $data['department_name'],
           'description' => $data['department_description'],
           'department_code' => $data['department_code'],
           'UpdatedBy' => Auth::user()->id,
        ]);

        $notification = array(
            'message' => 'Department Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('department.index')->with($notification);

    }

    public function destroy($id)
    {
        $permissionsDepartment = PermissionRole::getPermission('Delete Role', Auth::user()->role_id);

        if(empty($permissionsDepartment))
        {

            $notification = array(
                'message' => "Unauthorized!!! Access Denied",
                'alert-type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($notification);
        }
        
        $department = Department::getSingle($id);
        $department->status = 0;

        $department->save();

        $notification = array(
            'message' => 'Department Deleted Successfully',
            'alert-type' => 'error'
        );
        
        return redirect()->route('department.index')->with($notification);
    }
}
