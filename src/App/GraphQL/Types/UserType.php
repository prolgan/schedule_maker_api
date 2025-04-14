<?php
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;



class UserType extends ObjectType
{


    public function __construct()
    {
        parent::__construct([
            'name' => 'User',
            'fields' => [
                'id' => [
                    'type' => Type::nonNull(Type::int())
                ],
                'userName' => [
                    'type' => Type::string(),
                ],
                'userSurname' => [
                    'type' => Type::string(),
                ],
                'email' => [
                    'type' => Type::string(),
                ],
            ]
        ]);
    }

}