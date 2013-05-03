<?php
namespace SimpleAcl;

interface ResourceInterface{
	/**
	 * 一个关联数据，充当ACL
	 * interface 内不能包含变量，只能注释掉
	 */
	// public static $acl = array();
	
	/**
	 * 根据访问者获得角色
	 * @param UserTrait $user
	 */
	public function getRoles($user);
}
