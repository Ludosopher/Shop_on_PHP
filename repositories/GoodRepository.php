<?php
namespace App\repositories;

use App\entities\Good;

class GoodRepository extends Repository
{
   protected function getTableName()
    {
        return 'images';
    }

    protected function getEntityName()
    {
        return Good::class;
    }
}