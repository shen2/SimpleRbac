<?php 
namespace SimpleAcl;

trait UserTrait{
	/**
	 * @param string $privilege
	 * @param ResourceInterface $resource
	 * @return bool
	 */
	public function isAllowedTo($privilege, $resource = null){
		if ($resource === null){
			$roles = array($this->getRole());
			$acl = &self::$_acl;
		}
		else{
			$roles = $resource->getRoles($this);
			$className = get_class($resource);
			$acl = &$className::$acl;
		}
		
		for ($i = count($roles) - 1; $i >= 0; $i--){
			if (!isset($acl[$roles[$i]]))
				continue;
				
			$privilegesMap = $acl[$roles[$i]];
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
