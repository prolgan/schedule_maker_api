<?php

namespace App\GraphQL\Types;

use App\Entity\WorkerRolePatterns;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class WorkerRolePatternsType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'WorkerRolePatterns',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::int(),
                    'shiftStart' => Type::string(),
                    'shiftEnd' => Type::string(),
                    'role' => [
                        'type' => $types->workerRole(),
                        'resolve' => fn(WorkerRolePatterns $p) => $p->getRole()
                    ],
                    'managerDaySettings' => [
                        'type' => $types->managerDaySettings(),
                        'resolve' => fn(WorkerRolePatterns $p) => $p->getManagerDaySettings()
                    ]
                ];
            }
        ]);
    }
}