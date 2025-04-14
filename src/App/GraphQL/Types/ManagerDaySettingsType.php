<?php

namespace App\GraphQL\Types;

use App\Entity\ManagerDaySettings;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class ManagerDaySettingsType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'ManagerDaySettings',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::int(),
                    'maxHours' => Type::float(),
                    'shiftMinTime' => Type::float(),
                    'shiftMaxTime' => Type::float(),
                    'shiftTimeStep' => Type::float(),
                    'day' => [
                        'type' => $types->daysInSchedule(),
                        'resolve' => fn(ManagerDaySettings $m) => $m->getDay()
                    ]
                ];
            }
        ]);
    }
}