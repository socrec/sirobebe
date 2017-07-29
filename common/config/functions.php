<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 6/10/2017
 * Time: 6:12 PM
 */

/**
 * Debug function
 * d($var);
 */
function d() {
    echo '
<pre>';
    for ($i = 0; $i < func_num_args(); $i++) {
        yii\helpers\VarDumper::dump(func_get_arg($i), 10, true);
    }
    echo '</pre>
';
}

/**
 * Debug function with die() after
 * dd($var);
 */
function dd() {
    for ($i = 0; $i < func_num_args(); $i++) {
        d(func_get_arg($i));
    }
    die();
}