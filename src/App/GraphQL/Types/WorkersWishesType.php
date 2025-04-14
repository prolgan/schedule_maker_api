<?php

namespace App\GraphQL\Types;

use App\Entity\WorkersWishes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class WorkersWishesType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'WorkersWishes',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::int(),
                    'shiftStart' => Type::string(),
                    'shiftEnd' => Type::string(),
                    'maxHours' => Type::float(),
                    'available' => Type::boolean(),
                    'worker' => [
                        'type' => $types->worker(),
                        'resolve' => fn(WorkersWishes $w) => $w->getWorker()
                    ],
                    'day' => [
                        'type' => $types->daysInSchedule(),
                        'resolve' => fn(WorkersWishes $w) => $w->getDay()
                    ]
                ];
            }
        ]);
    }
}