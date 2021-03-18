<?php


namespace App\Http\Controller;
use App\Rpc\Lib\GoodsInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * Class GoodsController
 * @package App\Http\Controller
 * @Controller (prefix="goods")
 */
class GoodsController
{
    /**
     * @Reference(pool="goods.pool")
     *
     * @var GoodsInterface
     */
    private $goodsService;

    /**
     * @RequestMapping(route="index", method="get")
     * @return string
     */
    public function index()
    {
        $result  = $this->goodsService->getList(12);
        return $result;
//        return "goods/index";
    }
}
