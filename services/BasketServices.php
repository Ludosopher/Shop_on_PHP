<?php

namespace App\services;

use App\entities\Good;
use App\repositories\GoodRepository;

class BasketServices
{
    public function add(Request $request, GoodRepository $goodRepository )
    {
        $id = $request->getId();
        if (empty($id)) {
            return false;
        }

        /** @var Good $good */
        $good = $goodRepository->getOne($id);
        if (empty($good)) {
            return false;
        }

        $goods = $request->getSession('goods');

        if (empty($goods[$id])) {
            $goods[$id] = [
                'good' => $good,
                'count' => 1
            ];
        } else {
            $goods[$id]['count']++;
        }

        $request->setSession('goods', $goods);

        return true;
    }

    public function delete(Request $request, GoodRepository $goodRepository )
    {
        $id = $request->getId();
        if (empty($id)) {
            return false;
        }

        $goods = $request->getSession('goods');
        if ($goods[$id]['count'] == 1) {
            unset($goods[$id]);
        } else {
            $goods[$id]['count']--;
        }

        $request->setSession('goods', $goods);

        return true;
    }
}
