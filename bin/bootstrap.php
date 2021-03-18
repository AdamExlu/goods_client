<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require dirname(__DIR__) . '/vendor/autoload.php';

// $loader->addPsr4('Swoft\\Cache\\', 'vendor/swoft/cache/src/');

// php /var/www/swoft/bin/swoft rpc:start ext_init=-i:170.200.7.110?-t:tcp?-p:18307

//通过启动swoft传递的参数，获取consul检查的配置，或更多配置
$retCall = " ";
if ($extInitCalls = strstr($argv[$argc - 1], 'ext_init')) {
    $initCalls = (explode('=', $extInitCalls))[1];
    if ($calls = strstr($initCalls, '?')) {
        $calls = explode('?', $initCalls);
        foreach ($calls as $key => $call) {
            $retCall .= str_replace(":"," ", $call)." ";
        }
    } else {
        $retCall .= str_replace(":"," ", $initCalls)." ";
    }
}
//通过以上配置参数，执行脚本生成.env配置
exec('sh /var/www/swoft/init.sh '.$retCall, $out, $status);
