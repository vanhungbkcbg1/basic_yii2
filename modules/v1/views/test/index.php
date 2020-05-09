<?php
/* @var $this \yii\web\View */

echo "hello module test action";
$this->beginBlock("child");
echo "child view";
$this->endBlock();