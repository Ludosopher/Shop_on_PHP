<?php
namespace App\repositories;

use App\entities\Feedback;

class FeedbackRepository extends Repository
{
   protected function getTableName()
    {
        return 'feedback';
    }

    protected function getEntityName()
    {
        return Feedback::class;
    }
}