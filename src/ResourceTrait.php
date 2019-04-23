<?php
declare(strict_types=1);

namespace SimpleRbac;

trait ResourceTrait{
    /**
     * 充当ACL的关联数组
     * 
     */
    //protected static $_permissionAssignments;

    public function allow(string $role, string $permission){
        return self::$_permissionAssignments[$role][$permission] ?? null;
    }

    public function getRolePermissions(string $role) : array{
        return self::$_permissionAssignments[$role];
    }
}
