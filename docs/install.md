# Installation

## 1. 下载安装

```bash
composer create-project --prefer-dist --stability=dev drodata/yii2-app-template
```

Fork 的话，执行

```bash
git clone git@github.com:drodata/yii2-app-template.git
```

> :bell: 请确保电脑上已安装 Composer 和 `fxp/composer-asset-plugin` 插件。如未安装，参考 [下载、安装 Composer][download-composer].

## 2. 配置数据库

### 2.1 配置数据库敏感信息

在 `common/` 目录下，将文件 `common/yii2-sensitive.json.sample` 重命名为 `yii2-sensitive.json` 文件；打开文件，输入 MySQL 密码
   
```
{
    "password": "yourpassword"
}
```

设置 `yii2-sensitive.json` 权限，确保安全：

```bash
# replace <your> with your login name
# on Mac, sustitude www-data with _www
sudo chown <you>:www-data yii2-sensitive.json
sudo chmod 640 yii2-sensitive.json
```

### 2.1 建立数据库

新建一个 `yat` 的数据库，并配置好 Apache.

> 如果需要修改数据库名称，记得修改 `common/config/main-local.php` 中的对应字段。还有，如果使用 MySQL Workbench 开发，还需要修改默认的 `yat.mwb` 中的 schema name 字段，修改成新的数据库名称。


### 2.2 初始化数据库

在项目根目录下，依次运行如下命令：

```bash
# create basic tables such as `user`, `lookup`
./yii migrate

# build RBAC tables
./yii migrate --migrationPath=@yii/rbac/migrations
```

### 2.3 导入基础数据

1. 导入 RBAC 权限配置信息(如需变更，请更改后再执行命令)

   ```bash
   ./yii rbac/init
   
   # ./yii rbac/flush 可清空所有授权信息
   ```

2. 导入测试数据 `test-data.sql`

## 3. 配置 Apache 虚拟主机

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

> 注意：每新增一个 tier 时，需要修改上面两处配置：Apache 配置文件和 `/etc/hosts` 文件。

最后，重启 Apache 。

至此，程序安装完成，在浏览器内输入 http://i.yat.com, 即可进入系统后台登录界面。

## 4 Troubshooting

按照上面的设置后，浏览器中如果出现如下信息：

> The i.yat.com page isn’t working
> 
> i.yat.com didn’t send any data. ERR_EMPTY_RESPONSE

有一种原因是地本主机使用了代理翻墙，而没有将自定义的 `yat.com` 主机忽略掉。

:question:, 同样是使用 ShadowSocks 代理上网，Debian 下如果不手动添加 Ignore Hosts, 就会出现上面的问题；Mac 下则没有该问题。

[download-composer]: https://github.com/drodata/learning-notes/blob/master/meet/composer/download.md
