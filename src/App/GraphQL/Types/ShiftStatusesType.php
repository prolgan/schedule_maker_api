<?php

namespace App\GraphQL\Types;

use App\Entity\ShiftStatuses;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ShiftStatusesType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'ShiftStatuses',
            'fields' => [
                'id' => Type::int(),
                'statusName' => Type::string()
            ]
        ]);
    }
}