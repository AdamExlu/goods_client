<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Common;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Exception\ClientException;
use Swoft\Consul\Exception\ServerException;
use Swoft\Rpc\Client\Client;
use Swoft\Rpc\Client\Contract\ProviderInterface;
use Swoft\Config\Annotation\Mapping\Config;
use App\Expansion\Agent;

/**
 * Class RpcProvider
 *
 * @since 2.0
 *
 * @Bean()
 */
class RpcProvider implements ProviderInterface
{
    /**
     * @Inject()
     *
     * @var Agent
     */
    private $agent;

    /**
     * @Config("consul.consul_server_name")
     */
    private $serverName;

    /**
     * @param Client $client
     *
     * @return array
     * @throws ClientException
     * @throws ServerException
     * @example
     * [
     *     'host:port',
     *     'host:port',
     *     'host:port',
     * ]
     */
    public function getList(Client $client): array
    {
//        // Get health service from consul
        // 获取consul中的服务
        $services = $this->agent->getService($this->serverName);

        // json解析
        $serviceList = json_decode($services->getBody(), true);

        //提取服务地址
        $address = [];
        foreach ($serviceList as $k => $v) {
            //判断当前的服务是否是活跃的,并且是当前想要去查询服务
            foreach ($v['Checks'] as $c) {
                if ($c['ServiceName'] == $this->serverName && $c['Status'] == "passing") {
                    $address[] = $v['Service']['Address'] . ":" . $v['Service']['Port'];
                }
            }
        }

        return $address;
    }
}
