<?php

namespace App\GraphQL\Types;

use App\Entity\Shifts;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class ShiftsType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'Shifts',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::int(),
                    'shiftStart' => Type::string(),
                    'shiftEnd' => Type::string(),
                    'day' => [
                        'type' => $types->daysInSchedule(),
                        'resolve' => fn(Shifts $s) => $s->getDay()
                    ],
                    'role' => [
                        'type' => $types->workerRole(),
                        'resolve' => fn(Shifts $s) => $s->getRole()
                    ],
                    'worker' => [
                        'type' => $types->worker(),
                        'resolve' => fn(Shifts $s) => $s->getWorker()
                    ]
                ];
            }
        ]);
    }
}