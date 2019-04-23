<?php
namespace SimpleAcl;

interface RoleInterface{
	/**
	 * 充当ACL的关联数组
	 * interface 内不能包含变量，只能注释掉
	 */
	// protected static $_acl = array();
	
	/**
	 * 获得全局角色
	 */
	public function getRole();
}
