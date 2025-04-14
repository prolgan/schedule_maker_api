<?php

namespace App\GraphQL\Types;

use App\Entity\ShiftSwapRequests;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class ShiftSwapRequestsType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'ShiftSwapRequests',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::int(),
                    'originalWorker' => [
                        'type' => $types->worker(),
                        'resolve' => fn(ShiftSwapRequests $r) => $r->getOriginalWorker()
                    ],
                    'newWorker' => [
                        'type' => $types->worker(),
                        'resolve' => fn(ShiftSwapRequests $r) => $r->getNewWorker()
                    ],
                    'shift' => [
                        'type' => $types->shifts(),
                        'resolve' => fn(ShiftSwapRequests $r) => $r->getShift()
                    ],
                    'status' => [
                        'type' => $types->shiftStatuses(),
                        'resolve' => fn(ShiftSwapRequests $r) => $r->getStatus()
                    ]
                ];
            }
        ]);
    }
}