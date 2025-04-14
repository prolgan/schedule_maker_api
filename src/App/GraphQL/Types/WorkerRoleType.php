<?php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;
class WorkerRoleType extends ObjectType
{
    public function __construct(GraphQLTypes $type)
    {
        parent::__construct([
            'name' => 'WorkerRole',
            'fields' => [
                'id' => Type::nonNull(Type::int()),
                'roleName' => Type::string(),
                'team' => $type->team(),
            ]
        ]);
    }
}
