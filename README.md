SimpleAcl
=========

一个简单高效的Acl访控库

## Introduction
通过SimpleAcl，可以让web应用中的各种权限判断问题变得简单清晰。
```php
if (!$visitor->isAllowedTo('delete', $image))
	throw Exception('你没有删除图片的权限');
```

## 访问者
故名思议，就是当前的访客信息，你可以编写自己的访客类，只要use SimpleAcl\UserTrait，就可以获得isAllowedTo()方法。
```php
class Visitor{
	use SimpleAcl\UserTrait;
	// your code...
}
```

## Role (角色)
SimpleAcl中的角色，是指当前访问者相对于某个资源而言的角色，角色有可能有一个，也可能有多个，也可能没有。比如，我自己发布的文章，我既是author，又是system-administrator。而对于一个未登录的访客而言，他对于这篇文章没有任何角色。

## Resource资源
资源可以是一篇文章，一张图片，通常可以和Model联系在一起。只要定义自己的$acl访问表数组，同时定义getRoles()方法，可以实现SimpleAcl\ResourceInterface接口。例如：
```php
class Image implements SimpleAcl\RoleInterface{
	// 定义访控表
	public static $acl = array(
		'author'	=> array('delete' => true, 'edit' => true, 'update' => true, 'close' => true,),
		'administrator'	=> array('delete' => true, 'edit' => true, 'update' => true, 'replace' => true,),
	);
	
	// 获取用户相对于当前对象的角色
	public function getRoles($user){
		$roles = array();
		if ($this['author_id] == $user['user_id']){
			$roles[] = 'author';
		}
		
		static $administrators = array(1, 1024);
		if (in_array($user['user_id'], $administrators)){
			$roles[] = 'administrator';
		}
		
		return $roles;
	}
}
```

## 大功告成
于是你就可以写出像自然语言一样优雅的代码了：
```php
if (!$visitor->isAllowedTo('delete', $image))
	throw Exception('你没有删除图片的权限');
```
