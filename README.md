SimpleAcl
=========

一个简单高效的Acl访控库

## 库的基本说明
* role角色：通过实现SimpleAcl\RoleInterface接口，通过getRoles()获取，存储在role数组里
* resources资源：通过实现SimpleAcl\ResourceInterface接口，定义了相应的角色跟操作关联数组$acl形如：array('editor'=>'post','admin'=>'delete')
* user用户：定义了一系列资源的相关操作方法，继承UserTrait
* privilege权限：各种删除、上传等操作，在资源里定义

## 简单实例
用户删除一张图片:$this->visitor->isAllowedTo('delete', $image)。
+ $image 代表图片资源
<br\>权限设置如下：
```php
$acl = array(
		//原作者
  'author'		=>	array('delete' => true, 'edit' => true, 'update' => true, 'close' => true, 'replace' => true,         'downloadoriginal' => true）,
	'global-user'	=>	array('view' => true, 'favorite' => true),
	'global-editor'	=>	array('edit' => true, 'delete' => true, 'update' => true, 'replace' => true, 'remove-from-site' => true, 'close' => true, 'downloadoriginal' => true, 'moderate' => true),
	'global-administrator'=>array(),
	);
```
+ $this->visitor代表用户
关键方法：
```php
public function getRoles($userid) {
    	static $team;  //这个是角色成员变量实例：array(5=>'admin', 10=>'editor')
      $role = isset($team[$userid])
	    	? $team[$this[userid]]
	    	: 'user';
    	return $role;
}
```
根据getRoles获取到相应的角色
+ 通过isAllowedTo方法，判断是否可以访问
```php
function isAllowedTo($privilege, $resource = null, $acl=null){
		if ($resource === null){
			$roles = getRoles();
			$acl = $_acl;
		}
		else{
			$roles = getRoles($resource);
			$acl = &$resource::$acl;
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
```
