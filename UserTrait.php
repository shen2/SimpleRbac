<?php 
namespace SimpleAcl;

trait UserTrait{
	/**
	 * @param string $privilege
	 * @param ResourceInterface $resource
	 * @return bool
	 */
	public function isAllowedTo($privilege, $resource = null){
		$roles = $resource->getRoles($this);
		$className = get_class($resource);
		for ($i = count($roles) - 1; $i >= 0; $i--){
			if (!isset($className::$acl[$roles[$i]]))
				continue;
				
			$privilegesMap = $className::$acl[$roles[$i]];
			if (isset($privilegesMap[$privilege]))
				return $privilegesMap[$privilege];
		}
		return false;
	}
	
	/**
	 * @param ResourceInterface $resource
	 * return array
	 */
	public function getPrivileges($resource){
		$roles  = $resource->getRoles($this);
		$className = get_class($resource);
		$acl = $className::$acl;
		$privileges = array();
		foreach ($roles as $role)
			if (isset($acl[$role]))
			$privileges += $acl[$role];
		return $privileges;
	}
}
