<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;

class ScheduleType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'Schedule',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::nonNull(Type::int()),
                    'scheduleName' => Type::string(),
                    'dayStart' => Type::string(),
                    'dayEnd' => Type::string(),
                    'team' => $types->team(),
                ];
            }
        ]);
    }
}
