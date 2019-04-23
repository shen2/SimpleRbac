<?php
declare(strict_types=1);

namespace SimpleRbac;

interface ResourceInterface{
	/**
	 * 根据访问者获得角色
	 * @param mixed $subject
     * @return array
	 */
	public function getRoles($subject);

	public function allow(string $role, string $permission);

	public function getRolePermissions(string $role) : array;
}
