<?php
namespace SimpleAcl;

interface ResourceInterface{
	/**
	 * 充当ACL的关联数组
	 * interface 内不能包含变量，只能注释掉
	 */
	// public static $acl = array();
	
	/**
	 * 根据访问者获得角色
	 * @param UserTrait $user
	 */
	public function getRoles($user);
}
