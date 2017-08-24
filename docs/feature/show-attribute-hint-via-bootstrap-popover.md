# Bootstrap Popover 样式的表单属性提示信息

在使用表单搜集用户数据时，为了避免用户对某些数据产生疑惑，通常需要在表单元素附近放置一段提示性文字。`yii\bootstrap\ActiveForm` 默认将提示信息放在元素正下方，如下图：

![原始提示样式](/docs/_asset/attribute-hint-origin.png)

这种样式看上去不太美观，我想达到的是下面这样一种效果——在属性标签旁边放置一个问号字体图标，当鼠标移动到图标上时，显示出提示信息，效果如下图：

![Popover 提示样式](/docs/_asset/attribute-hint-popover.png)

## 实现过程

- 在 Bootstrapping stage (例如 `backend/config/main-local.php` 内）通过依赖注入，改变 `yii\bootstrap\ActionForm` 默认生成 fields 使用的类：

  ```php
  // in backend/config/bootstrap.php
  
  Yii::$container->set('yii\bootstrap\ActiveForm', [
      'fieldClass' => 'drodata\bootstrap\ActiveField',
  ]);
  ```

- 生成表单时使用 `yii\bootstrap\ActionForm` 而不是 `yii\widgets\ActionForm`;
- 在模型类中重写 `attributeHints()` 方法，键是模型属性名，值是提示信息，提示信息支持 Markdown 语法，例如：

```php
public function attributeHints()
{
    return [
        'username' => '支持简单的**MarkDown**, [link](https://a.com)',
    ];
}
```

详见[相关 commit][related-commit].

[related-commit]: https://github.com/drodata/yii2-app-template/commit/9ad9476b59d6e5987bae0cafe8d90f224145d346
