<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  use HasFactory;

  protected $table = 'permissions';
  protected $guarded = [
    'id',
  ];
  static public function getRecord()
  {
    $getPermission = Permission::groupBy('groupBy')->get();
    $result = array();
    foreach($getPermission as $value)
    {
      $getPermissionGroup = Permission::getPermissionGroup($value->groupBy);
      $data = array();
      $data['id'] = $value->id;
      $data['name'] = $value->name;
      $group = array();
      foreach($getPermissionGroup as $GroupValue)
      {
          $GroupData = array();
          $GroupData['id'] = $GroupValue->id;
          $GroupData['name'] = $GroupValue->name;
          $group[] = $GroupData;
      }
      $data['group'] = $group;
      $result[] = $data;
    }

    return $result;
  }

  static public function getPermissionGroup($groupBy)
  {
    return  Permission::where('groupBy', '=', $groupBy)->get();
  }

  static public function getSingle($id)
  {
    return self::find($id);
  }
}
