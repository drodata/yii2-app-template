# 下载 PDF

对一个 Web 应用来说，用户的一个常见需求是将诸如订单、发票、账单信息导出成 PDF 文档，既方便打印有显得正式。Google Chrome 在打印页面时原生支持将页面导出成 PDF, 这是一个捷径，但更通用的是在页面上放一个“下载 PDF" 的按钮，用户点击后自动下载到本地。

## 准备工作 wkhtmltopdf

wkhtmltopdf 是类似 Composer 的命令。在命令行键入一条简单的命令，就能将一个网页转换成 PDF 文档。借助此工具，实现的思路就有了：先制作一个网址，用于显示需要打印的内容，再通过 PHP 执行转换命令，将网页存储成 PDF 并存储在服务器，最后读取 PDF 文件至浏览器。

### 下载安装

> 从 0.12.5 (2018-06-10 发布)开始， Debian 上开始出现单独的 `.deb` 安装包，例如 `wkhtmltox_0.12.5-1.stretch_amd64.deb`,  需使用 `sudo dpkg -i xxx.deb` 安装，比 0.12.4 更简单.
>
> 注意此 .deb 包仅适用于 Debian 9.2 或更新版本。
> 另：使用此方法进行版本升级时无需手动删除 `bin/` 内的就文件，安装会进行自动替换。

从 https://wkhtmltopdf.org/downloads.html 下载安装所需版本。

Mac 上安装更简单：下载 `wkhtmltox-0.12.4_osx-cocoa-x86-64.pkg` 文件后双击安装后，就能直接使用 wkhtmltopdf 和 wkhtmltoimage 两个命令，这里的”双击安装“等同于上面在 Debian 上执行的命令，最终的结果都是将两个命令脚本放在 `/usr/local/bin` 目录内。

简单测试一下，在命令行输入:

```bash
wkhtmltopdf http://google.com google.pdf
```

就能将 Google 首页存储到本地的 google.pdf 内，是不是很简单？

### Troubleshooting & FAQ

- Mac 上导出的 PDF 字体过小。在不加任何参数情况下，输出的 PDF 在 Mac 上看特别小，增加 `--zoom 4` 参数后字体变大，但该参数导致 Debian server 上输出的 PDF 字体又过大，Server 上使用默认设置的字体就刚好。
- 字体模糊。增加参数 `--dpi 100`
- 中文显示乱码。症状：相同的代码，本地导出正常，Debian server 中文乱码。原因：Server 缺少中文字体，在服务器上安装中文字体（如文泉驿）；
- 使用 `exec()` 执行没有提示且没有生成 PDF 文件。
  在命令末尾加上神奇的 `2>&1` 后可以显示错误提示，例如：`wkhtmltopdf http::/a.com b.pdf 2>&1`, 出现提示信息：sh:wkhtmltopdf command not found. 这表示系统找不到命令路径。解决：使用绝对路径执行。
- 如何分页
  设置类名 `.page-break { page-break-after: always; }` 并在需要分页处放置一个 `<div class="page-break"></div>` 即可。
- **目标网址不能出现`?`等特殊字符**
  
  类似 `a.com?a=b&c=d` 格式的网址无法导出 PDF 文件。可借助 urlManager 将其转换成 `a.com/b/d` 解决；

- **通过网页调用时目标文件存放目录有限制**
  
  在 console 上使用此命令时，为了省事，经常将目标文件存储在 `/tmp/` 内。但是如果网页应用内调用时，不能存储在此目录内，因为网页调用时以 `www-data` 的身份执行此命令。已测试过无法正常存储（`/tmp/` 目录内找不到生成的文件）。解决方法是找一个确保 `www-data` 能正常读写的目录。以 Yii2 项目为例， `@backend/runtime/` 是个不错的选择。
  

## 服务端一个实际的例子——下载订单发货清单

假设用户需要打印订单的发货清单，我们需要两个 actions: view 和 download.

```php
// in OrderController.php
public function actionViewShippingList($id)
{
    // 此 action 目的是能通过 url 显示我们需要打印的内容,因此使用单独的 layout
    $this->layout = 'pdf';
    $model = $this->findModel($id);

    return $this->render('shipping-list', ['order' => $model]);
}

// 下载按钮指向的 action
public function actionDownloadShippingList($id)
{
    header('Content-Type: application/pdf');
    // 这个头文件很重要，用户点击下载后，表现为弹出保存文件的位置，而非直接显示在浏览器内
    header('Content-Disposition: attachment; filename="订单' . $id . '发货清单.pdf"');

    // 获取 url, 调用的是上面的 action
    $url = Yii::getAlias('@eimsweb') . Url::to(['view-shipping-list', 'id' => $id]);

    // 指定导出 PDF 存储路径。这里我们选用 www-data 用户能读写的 runtime 目录
    $pdf = Yii::getAlias('@backend') . "runtime/order-shipping-list-{$id}.pdf";

    // 这里务必使用绝对路径，确保命令能被识别
    $command = '/usr/local/bin/wkhtmltopdf';

    $cmd = "$command $url $pdf";
    // 执行命令，此行执行后，$pdf 将存储在本地
    passthru($cmd);
    
    echo file_get_contents($pdf);

    // 删除之前生成的文件
    unlink($pdf);
}
```

注意，由于 url 会被当做命令的一部分，因此必要时，使用 `escapeshellcmd()` 进行元字符转义，否则如果 url 中含有 `&` 等 shell 元字符，将导致命令执行异常；

### 已知的问题

1. url 暴露如何实现权限控制？
   
   由于上面的 `view-shipping-list` action 需要被 wkhtmltopdf 命令执行，因此它需要能被公开访问。如何避免用户通过此地址访问到所有订单的发货信息呢？解决办法是生成一个 hash 字符串，让 url 中的 query string 变成没有意义的字符串。可以用一个单独的通用存储此 hash 值，给每个值增加一个有效值，完美解公开链接权限问题；

1. RBAC 权限判断在指定 url 内失效的问题

   以前面的 view-shipping-list 为例，`order/view-shipping-list` action 是通过终端命令调用的，因此没有用户身份信息，也就无法正常使用 `Yii::$app->user->can()`. 最近就遇到了这个问题：发货清单上的单价是否显示取决于两点，客户 show_price 开关是否开启；用户的身份是否是销售。此时后者返回 false, 致使业务员在下载发货清单时，那些需要显示单价的客户的发货清单上也不显示单价。这个问题还是使用页面内直接打印的办法。

   另一个办法是将各种控制元素以 query string 的形式出现，例如：`order/view-shipping-list?hash=xxxx&show_price=0`;
