<?php
use common\widgets\Panel;

$this->title = 'Login';
$this->params['title'] = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
body {background-color: black;}
.container {
    display: flex;
    flex-flow: row wrap;
    justify-content: flex-start;
    align-content: flex-start;

    background-color: #ddd;
    width: 300px;
    height: 600px;
}
.card-wrapper {
    flex: 0 0 100px;

    display: flex;
    flex-flow: column wrap;
    justify-content: flex-start;
    align-items: flex-start;

    background-color: #fff;
    width: 100px;
    height: 160px;
}
.card-wrapper:nth-child(odd) {
    background-color: lightblue;
}
.card-img {
    background-color: #3884ff;
    width: 90px;
    height: 30px;
    border-radius: 80%;
    flex: 0 0 90px;

    order: 3;
}
.card-img:nth-child(odd) {
    background-color: #d4237a;
}
.card-title {
    order: 0;
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
    <div class="card-wrapper">
        <div class="card-img"> </div>
        <div class="card-img"> </div>
        <div class="card-img"> </div>
        <div class="card-img"> </div>
        <div class="card-img"> </div>
        <div class="card-img"> </div>
        <div class="card-img"> </div>
        <div class="card-img"> </div>
    </div>
    <div class="card-wrapper">
    </div>
    <div class="card-wrapper">
    </div>
    <div class="card-wrapper">
    </div>
    <div class="card-wrapper">
    </div>
    <!--
        <div class="card-title">Jim Hello</div>
        <div class="card-desc">$ 900.00</div>
    <div class="item block11">Item</div>
    <div class="item block21">Item</div>
    <div class="item block12">Item</div>
    -->
</div>
