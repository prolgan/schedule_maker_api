<?php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;
class WorkerType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {   

        parent::__construct([
            'name' => 'Worker',
            'fields' => function () use ($types) {
                return [
                    'id' => Type::nonNull(Type::int()),
                    'worker' => $types->user(),
                    'team' => $types->team(),
                    'role' => $types->workerRole(),
                ];
            }
        ]);
    }
}

