SimpleRbac
=========

SimpleRbac是一个处理访控权限问题的php类，可以让web应用中的各种权限判断代码变得简单清晰。
```php
if (!$visitor->isAllowedTo('delete', $image))
	throw Exception('你没有删除图片的权限');
```

## Visitor (访问者)
故名思议，就是当前的访客信息，你可以编写自己的访客类，只要use SimpleRbac\SubjectTrait，就可以获得isAllowedTo()方法。
```php
class Visitor{
	use SimpleRbac\SubjectTrait;
	// your code...
}
```

## Role (角色)
SimpleRbac中的角色，是指当前访问者相对于某个资源而言的角色，角色有可能有一个，也可能有多个，也可能没有。比如，我自己发布的文章，我既是author，又是system-administrator。而对于一个未登录的访客而言，他对于这篇文章没有任何角色。

## Resource (资源)
资源可以是一篇文章，一张图片，通常可以和Model联系在一起。只要定义自己的$_permissionAssignments访问表数组，同时定义getRoles()方法，可以实现SimpleRbac\ResourceInterface接口。例如：
```php
class Image implements \SimpleRbac\ResourceInterface{
	use \SimpleRbac\ResourceTrait;
	// 定义访控表
	public static $_permissionAssignments = [
		'author'	=> ['delete' => true, 'edit' => true, 'update' => true, 'close' => true,],
		'administrator'	=> ['delete' => true, 'edit' => true, 'update' => true, 'replace' => true,],
	];
	
	// 获取用户相对于当前对象的角色
	public function getRoles($subject){
		$roles = [];
		if ($this['author_id'] == $subject['user_id']){
			$roles[] = 'author';
		}
		
		if ($subject['role'] == 'admin'){
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
