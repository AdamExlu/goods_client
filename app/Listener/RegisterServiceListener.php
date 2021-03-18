<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Listener;

use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\KV;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Http\Server\HttpServer;
use Swoft\Server\SwooleEvent;

/**
 * Class RegisterServiceListener
 *
 * @since 2.0
 *
 * @Listener(event=SwooleEvent::START)
 */
class RegisterServiceListener implements EventHandlerInterface
{
    /**
     * @Inject()
     *
     * @var KV
     */
    private $kv;

    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
        /** @var HttpServer $httpServer */
        $httpServer = $event->getTarget();
        $this->kv->put('/upstream/goods_server/'.env('HOST_IP').':'.env('HOST_PORT'),'{"max_fails":2,"fail_timeout":10}');
    }
}
