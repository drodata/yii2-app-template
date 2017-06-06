<?php
use common\widgets\Panel;

$this->title = 'Login';
$this->params['title'] = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
body {background-color: #ddd;}
.container {
    background-color: #fff;
    display: flex;
    width: 300px;
    height: 300px;

    flex-flow: row wrap;
    justify-content: flex-start;
    align-items: flex-start;
    align-content: space-between;
}
.dot {
    background-color: #24b;
    color: #eee;
    text-align: center;
    width: 100px;
    height: 100px;
    border-radius: 80%;
}
.dot-1 {
    flex-grow: 1;
}
.dot-2 {
    flex-grow: 2;
}
.dot-bottom {
    align-self: flex-end;
}
.shrink-0 { flex-shrink: 0; }
.shrink-2 { flex-shrink: 2; }
.item {
    margin: 15px;
    background-color: #eee;
    color: #eee;
    text-align: center;
}
CSS;
$this->registerCss($css);
?>

<div class="container">
    <div class="dot">Dot</div>
    <div class="dot">Dot</div>
    <div class="dot">Dot</div>
    <div class="dot">Dot</div>
    <!--
    <div class="item block11">Item</div>
    <div class="item block21">Item</div>
    <div class="item block12">Item</div>
    -->
</div>
