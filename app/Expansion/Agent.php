<?php
namespace App\Expansion;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Consul;
use Swoft\Consul\Response;
use Swoft\Consul\Agent as base;
/**
 * @Bean()
 */
class Agent extends base
{
    /**
     * @Inject()
     *
     * @var Consul
     */
    private $consul;

    /**
     * @return Response
     * @throws ClientException
     * @throws ServerException
     */
    public function getService($serverName): Response
    {
        return $this->consul->get('/v1/health/service/'.$serverName);
    }
}
