<?php

namespace App\GraphQL\Types;

use App\Entity\DaysInSchedule;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class DaysInScheduleType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'DaysInSchedule',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::int(),
                    'day' => Type::string(),
                    'status' => Type::int(),
                    'schedule' => [
                        'type' => $types->schedule(),
                        'resolve' => fn(DaysInSchedule $d) => $d->getSchedule()
                    ]
                ];
            }
        ]);
    }
}