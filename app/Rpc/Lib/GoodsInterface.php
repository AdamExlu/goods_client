<?php declare(strict_types=1);

namespace App\Rpc\Lib;

/**
 * Class GoodsInterface
 *
 * @since 2.0
 */
interface GoodsInterface
{
    /**
     * @param int   $id
     *
     * @return array
     */
    public function getList(int $id): array;

}
