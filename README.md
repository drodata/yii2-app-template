Drodata's Yii2 Application Template
===============================

## 安装步骤

### 1. 配置数据库敏感信息

在 `common/` 目录下新建一个名为 `yii2-sensitive.json` 文件，内容如下：
   
```
{
    "password": "input-you-mysql-pswd"
}
```

之后修改其权限为 `640`, 确保安全性；同时修改 group owner, 确保 Apache 有读取权限。

### 2. 配置数据库

新建一个 `yii2_app_template` 的数据库，并配置好 Apache.

如果需要修改数据库名称，记得修改 `common/config/main-local.php` 中的对应字段。还有，如果使用 MySQL Workbench 开发，还需要修改默认的 `yat.mwb` 中的 schema name 字段，修改成新的数据库名称。

### 3. 导入 SQL 数据

- 在 Workbench 中导出表格为 `dump.sql`, 同时导入；
- 再依次导入 `rbac.sql` 和 `test-data.sql`.

### 4. 配置 Apache 虚拟主机

在 Apache 配置文件中新增如下内容：

```bash
<VirtualHost *:80>
    ServerName yat.com
    DocumentRoot "/Users/drodata/www/yii2-app-template/frontend/web"
    <Directory "/Users/drodata/www/yii2-app-template/frontend/web">
           # use mod_rewrite for pretty URL support
           RewriteEngine on
           # If a directory or a file exists, use the request directly
           RewriteCond %{REQUEST_FILENAME} !-f
           RewriteCond %{REQUEST_FILENAME} !-d
           # Otherwise forward the request to index.php
           RewriteRule . index.php

           # use index.php as index file
           DirectoryIndex index.php

           # ...other settings...
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName i.yat.com
    DocumentRoot "/Users/drodata/www/yii2-app-template/backend/web"
    <Directory "/Users/drodata/www/yii2-app-template/backend/web">
           # use mod_rewrite for pretty URL support
           RewriteEngine on
           # If a directory or a file exists, use the request directly
           RewriteCond %{REQUEST_FILENAME} !-f
           RewriteCond %{REQUEST_FILENAME} !-d
           # Otherwise forward the request to index.php
           RewriteRule . index.php

           # use index.php as index file
           DirectoryIndex index.php

           # ...other settings...
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName static.yat.com
    DocumentRoot "/Users/drodata/www/yii2-app-template/static"
    <Directory "/Users/drodata/www/yii2-app-template/static">
           # use mod_rewrite for pretty URL support
           RewriteEngine on
           # If a directory or a file exists, use the request directly
           RewriteCond %{REQUEST_FILENAME} !-f
           RewriteCond %{REQUEST_FILENAME} !-d
           # Otherwise forward the request to index.php
           RewriteRule . index.php

           # use index.php as index file
           DirectoryIndex index.php

           # ...other settings...
    </Directory>
</VirtualHost>
```

修改 `/etc/hosts`, 新增如下内容：

```bash
127.0.0.1	           yat.com
127.0.0.1	         i.yat.com
127.0.0.1	    static.yat.com
```

最后，重启 Apache 。
