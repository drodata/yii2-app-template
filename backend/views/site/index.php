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
    justify-content: space-between;
    align-items: flex-start;
    align-content: flex-start;

    background-color: #ddd;
    width: 300px;
    height: 600px;
}
.card-wrapper {
    flex: 0 0 48%;

    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-start;
    align-items: flex-start;

    background-color: #fff;
    height: 160px;
    margin-bottom: 10px;
}
.card-img {
    width: 80%;
    padding: 0 10%;
    background-color: #3884ff;
    text-align: center;
    flex: 0 0 70%;
}
.card-title {
    width: 80%;
    color: #333;
    padding: 0 10%;
    font-size: 12pt;
    flex: 0 0 15%;
}
.card-desc {
    width: 80%;
    color: #777;
    padding: 0 10%;
    font-size: 10pt;
    flex: 0 0 5%;
}
.fb12 { flex: 0 0 50% }
.fb13 { flex: 0 0 33.3333% }
.fb14 { flex: 0 0 25% }
.dot-bottom {
    align-self: flex-end;
}
.dot-1 { flex-grow: 1; }
.dot-2 { flex-grow: 2; }
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
        <div class="card-img">Hello</div>
        <div class="card-title">A2 Milk Best</div>
        <div class="card-desc">$99.00</div>
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
        <div class="card-img fb14">3</div>
        <div class="card-img fb14">4</div>
        <div class="card-title">Jim Hello</div>
        <div class="card-desc">$ 900.00</div>
    <div class="item block11">Item</div>
    <div class="item block21">Item</div>
    <div class="item block12">Item</div>
    -->
</div>
