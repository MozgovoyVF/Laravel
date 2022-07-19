<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;

trait HasRoles
{
  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  public function isAdmin()
  {
    return (bool) $this->roles->contains('slug', 'admin');
  }

  public function hasRole(...$roles)
  {
    foreach ($roles as $role) {
      if ($this->roles->contains('slug', $role)) {
        return true;
      }
    }
    return false;
  }

  public function getAllRoles(array $roles)
  {
    return Role::whereIn('slug', $roles)->get();
  }

  public function giveRole(...$roles)
  {
    $roles = $this->getAllRoles($roles);

    if ($roles === null) {
      return $this;
    }

    $this->roles()->saveMany($roles);

    return $this;
  }

  public function deleteRoles(...$roles)
  {
    $roles = $this->getAllRoles($roles);
    $this->roles()->detach($roles);
    return $this;
  }

  public function refreshRoles(...$roles)
  {
    $this->roles()->detach();
    return $this->giveRole($roles);
  }
}
