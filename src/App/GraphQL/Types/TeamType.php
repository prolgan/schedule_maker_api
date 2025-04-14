<?php 
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\GraphQLTypes;


class TeamType extends ObjectType
{
    public function __construct(GraphQLTypes $types)
    {
        parent::__construct([
            'name' => 'Team',
            'fields' => [
                'id' => ['type' => Type::int()],
                'teamName' => ['type' => Type::string()],
                'manager' => [
                    'type' => $types->user(),
                ],
            ],
        ]);
    }
}
