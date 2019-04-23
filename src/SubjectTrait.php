<?php
declare(strict_types=1);

namespace SimpleRbac;

trait SubjectTrait{
	/**
	 * @param string $permission
	 * @param ResourceInterface $resource
	 * @return bool
	 */
	public function isAllowedTo(string $permission, ResourceInterface $resource) : bool{
		$roles = $resource->getRoles($this);
		
		foreach ($roles as $role){
			$permission = $resource->allow($role, $permission);

			if ($permission !== null)
				return $permission;
		}

		return false;
	}
	
	/**
	 * @param ResourceInterface $resource
	 * @return array
	 */
	public function getPermissions(ResourceInterface $resource) : array{
		$roles  = $resource->getRoles($this);

		$permissions = [];
		foreach ($roles as $role){
			$permissions[] += $resource->getRolePermissions($role);
		}
		return $permissions;
	}
}
