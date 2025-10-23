# 新增 Tier

步骤
---------------------------------------------------------------------

### 复制模板目录
在项目根目录下：
```
$ cp -r tier-template/ tier-xxx
```

### 配置 alias
在 `common/config/bootstrap.php` 内增加如下内容：
```
Yii::setAlias('@x', dirname(dirname(__DIR__)) . '/tier-xxx');
```

### 部署环境目录
分别在 `environments/dev` 和 `environments/prod` 目录下,复制相应的配置文件：

```
$ cp -r tier-template/ tier-xxx
```
然后分别在 `environments/index.php` 内 'Development' 和 'Production' 字段内增加相应内容:
```
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            ...
            'tier-xxx/rutier-xxxime',
            'tier-xxx/web/assets',
            'tier-xxx/models',
            'tier-xxx/views',
            'tier-xxx/cotier-xxxrollers',
        ],
        'setCookieValidationKey' => [
            ...
            'tier-xxx/config/main-local.php',
        ],
    ],
    'Production' => [
        'setWritable' => [
            ...
            'tier-xxx/runtime',
            'tier-xxx/web/assets',
        ],
        'setCookieValidationKey' => [
            ...
            'tier-xxx/config/main-local.php',
        ],
    ],
];
```

最后执行 `./init` 自动配置相应目录权限等。

### 配置 Apache
修改站点配置文件 (例如 `yat.conf`), 添加新 tier 的配置内容. 然后重启 Apache.

### 完成
通过以上步骤后，访问 `nt.yat.com` 即可访问新站点。
