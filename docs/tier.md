# 新增 Tier

步骤
---------------------------------------------------------------------

### 复制模板目录
在项目根目录下：
```
$ cp -r tier-template/ nt
```
`nt` 表示 new tier, 此目录名可设置的简单些，方便后期写命名空间。

### 配置 alias
在 `common/config/bootstrap.php` 内增加如下内容：
```
Yii::setAlias('@nt', dirname(dirname(__DIR__)) . '/nt');
```

### 部署环境目录
分别在 `environments/dev` 和 `environments/prod` 目录下,复制相应的配置文件：

```
$ cp -r backend/ nt
```
然后在 `environments/index.php` 内增加相应内容，例如：
```
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            ...
            'nt/runtime',
            'nt/web/assets',
            'nt/models',
            'nt/views',
            'nt/controllers',
            ...
        ],
    ]
];
```

最后执行 `./init` 自动配置相应目录权限等。

### 配置 Apache
修改站点配置文件 (例如 `yat.conf`), 添加新 tier 的配置内容. 然后重启 Apache.

### 完成
通过以上步骤后，访问 `nt.yat.com` 即可访问新站点。
