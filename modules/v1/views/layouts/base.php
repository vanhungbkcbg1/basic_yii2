<?php
/* @var $this \yii\web\View */

/* @var $content string */
/* @var $abc string */
echo "base layout".PHP_EOL;
echo $content;
//using block in layout
if(isset($this->blocks["child"])){
    echo $this->blocks['child'];
}else{
    echo "default content";
}
