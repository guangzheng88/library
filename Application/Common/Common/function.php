<?php
/**
 * @param $sign
 * 获取标识值
 */
function getSignValue($sign){
    //$item = M('Sign','tpa_','DB_CONFIG1')->where(['sign'=>$sign])->getField('value');
    return empty($item)?'':$item;
}