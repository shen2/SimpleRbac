SimpleAcl
=========

一个简单高效的Acl访控类
##类的的基本说明
*role角色：通过实现SimpleAcl\RoleInterface接口，通过getRoles()获取，存储在role数组里
*resources资源：通过实现SimpleAcl\ResourceInterface接口，定义了相应的角色跟操作关联数组
*privilege权限：各种删除、上传等操作，在资源里定义
##简单实例
>用户删除一张图片:$this->visitor->isAllowedTo('delete', $image),其中$this->visitor代表一个特定的用户通过getRoles()可以获取
到相应的roles，delete代表privilege，$image代表resources，通过指定资源查找相应的角色操作数组，判断是否可以访问
