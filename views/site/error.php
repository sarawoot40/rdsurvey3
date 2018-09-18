<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<style>
    html {
  font-size: 10px;
}

.errorPageRap {
  text-align: center;
}
.errorPageRap .holoContainer {
  position: relative;
  width: 25.8rem;
  height: 40rem;
  margin: 0 0 0rem 0;
  margin-top: 80px;
  display: inline-block;
  vertical-align: middle;
}
.errorPageRap h1 {
  font-family: 'Roboto', Arial;
  text-align: left;
  font-size: 2.8rem;
  font-weight: 400;
  color: #506280;
  line-height: 5.4rem;
  display: inline-block;
  vertical-align: text-bottom;
  margin: 0;
  margin-left: 4rem;
  width: 50%;
  min-width: 43.6rem;
  max-width: 64rem;
}
.errorPageRap h1 span {
  display: inline-block;
  width: 3rem;
}
.errorPageRap h1 span img {
  width: 100%;
}
</style>
<div class="errorPageRap">
    <div class="holoContainer">
        <img src="../img/error.jpg">
    </div>
        <h1>
            It seems this player doesn't exist... <span><img src="../img/disappointed_relieved.png"></span>
            <br>
            You might try and search for them on <a href="../index.php">this page</a>
        </h1>
</div>