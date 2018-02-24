# Installation

## 1. 下载安装

```bash
composer create-project --prefer-dist --stability=dev drodata/yii2-app-template
```

Fork 的话，执行（clone 完毕后需手动 `composer install`）

```bash
git clone git@github.com:drodata/yii2-app-template.git
```

> :bell: 请确保电脑上已安装 Composer 和 `fxp/composer-asset-plugin` 插件。如未安装，参考 [下载、安装 Composer][download-composer].

## 2. 配置数据库

### 2.1 配置数据库敏感信息

在 `common/` 目录下，复制 `yii2-sensitive.json.sample` 为 `yii2-sensitive.json` 文件；编辑新复制的文件 `yii2-sensitive.json`，输入 MySQL 密码
   
```
{
    "password": "yourpassword",
    "dbname": "your-db-name"
}
```

设置 `yii2-sensitive.json` 权限，确保安全：

```bash
# replace <you> with your login name
# on Mac, sustitude www-data with _www
sudo chown <you>:www-data yii2-sensitive.json
sudo chmod 640 yii2-sensitive.json
```

### 2.1 建立数据库

新建数据库，数据库名称与上面 `yii2-sensitive.json` 中配置的值一致。

### 2.2 初始化数据库

在项目根目录下，依次运行如下命令：

```bash
# 初始化项目，选择开发环境
./init

# build RBAC tables
./yii migrate --migrationPath=@yii/rbac/migrations

# 初始化 RBAC 数据. ./yii rbac/flush 可清空所有授权信息
./yii rbac/init

# 初始化基础表格 (user, lookup, taxonomy 等)
./yii migrate --migrationPath=@drodata/migrations

# 撤销
# ./yii migrate/redo --migrationPath=@drodata/migrations
```

## 3. 配置 Apache 虚拟主机

1. 将 [yat.conf](/_asset/yat.conf) 文件内容复制到 `/etc/apache2/sites-available` 目录内，根据自己项目的实际路径做相应配置。
2. `sudo a2ensite yat.conf` 启用新的配置；
3. 编辑 `/etc/hosts`, 追加如下内容：

   ```bash
   127.0.0.1	           yat.com
   127.0.0.1	         i.yat.com
   127.0.0.1	    static.yat.com
   ```

4. `sudo systemctl reload apache2` 重启 Apache.

至此，程序安装完成，在浏览器内输入 http://i.yat.com, 即可进入系统后台登录界面。默认的用户名和密码分别为 `admin` 和 `123456`.

## 4 Troubshooting

按照上面的设置后，浏览器中如果出现如下信息：

> The i.yat.com page isn’t working
> 
> i.yat.com didn’t send any data. ERR_EMPTY_RESPONSE

有一种原因是地本主机使用了代理翻墙，而没有将自定义的 `yat.com` 主机忽略掉。

:question:, 同样是使用 ShadowSocks 代理上网，Debian 下如果不手动添加 Ignore Hosts, 就会出现上面的问题；Mac 下则没有该问题。

### Access denied

使用已有的账号和密码登录是提示：

> SQLSTATE[28000] [1045] Access denied for user 'root'@'localhost' (using password: NO)

原因：`common/yii2-sensitive.json` 权限设置不当造成。在下面的例子中，权限被设置成只有用户 git 有读写权限。

```bash
-rw------- 1 git git   31 Sep 24 08:47 yii2-sensitive.json
```

这种设置导致 Apache 没有读取它的权限，进而导致 `common/config/main-loca.php` 中 `$sensitive->password` 的值为 null:

```php
'components' => [
    'db' => [
        'password' => $sensitive->password,
    ],
],
```

这就是提示中 "using password: **NO**" 的原因，'NO' 表示不使用密码。如果提供错误的密码，这里会提示"using password: **YES**". 因此，设置权限时务必确认 Apache 具有读权限。

[download-composer]: https://github.com/drodata/learning-notes/blob/master/meet/composer/download.md
