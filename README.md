Drodata's Yii2 Project Template
===============================

## 安装步骤

### 1. 配置数据库敏感信息

在 `common/` 目录下新建一个名为 `yii2-sensitive.json` 文件，内容如下：
   
```
{
    "password": "input-you-mysql-pswd"
}
```

之后修改其权限为 `640`, 确保安全性。

### 2. 配置数据库

新建一个 `yii2_app_template` 的数据库，并配置好 Apache.

如果需要修改数据库名称，记得修改 `common/config/main-local.php` 中的对应字段。还有，如果使用 MySQL Workbench 开发，还需要修改默认的 `yat.mwb` 中的 schema name 字段，修改成新的数据库名称。

### 3. 导入 SQL 数据

- 在 Workbench 中导出表格为 `dump.sql`, 同时导入；
- 再依次导入 `rbac.sql` 和 `test-data.sql`.
