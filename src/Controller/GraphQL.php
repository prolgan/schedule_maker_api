<?php

namespace App\Controller;


use GraphQL\GraphQL as GraphQLBase;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use RuntimeException;
use Throwable;

class GraphQL
{
    static public function handle($entityManager)
    {
        try {
            $types = new \App\GraphQL\GraphQLTypes();

            $UserType = $types->user();
            $TeamType = $types->team();
            $WorkerRoleType = $types->workerRole();
            $WorkerType = $types->worker();
            $scheduleType = $types->schedule();

            $userController = new UserController($entityManager);
            $teamController = new TeamController($entityManager);
            $workerController = new WorkerController($entityManager);
            $scheduleController = new ScheduleController($entityManager);
            $workerRoleController = new WorkerRoleController($entityManager);
            $queryType = new ObjectType([
                'name' => 'Query',
                'fields' => [
                    'users' => [
                        'type' => Type::listOf($UserType),
                        'args' => [
                            'id' => Type::int(),
                        ],
                        'resolve' => [$userController, 'resolve'],
                    ],
                    'teams' => [
                        'type' => Type::listOf($TeamType),
                        'args' => [
                            'id' => Type::int(),
                            'managerId' => Type::int(),
                        ],
                        'resolve' => [$teamController, 'resolve'],
                    ],
                    'roles' => [
                        'type' => Type::listOf($WorkerRoleType),
                        'args' => [
                            'teamId' => Type::int(),
                        ],
                        'resolve' => [$workerRoleController, 'resolve'],
                    ],
                    'workers' => [
                        'type' => Type::listOf($WorkerType),
                        'args' => [
                            'teamId' => Type::int(),
                            'scheduleId' => Type::int(),
                        ],
                        'resolve' => [$workerController, 'resolve'],
                    ],
                    'schedules' => [
                        'type' => Type::listOf($scheduleType),
                        'args' => [
                            'teamId' => Type::int(),
                            'scheduleId' => Type::int(),
                        ],
                        'resolve' => [$scheduleController, 'resolve'],
                    ],
                ],
            ]);



            $mutationType = new ObjectType([
                'name' => 'Mutation',
                'fields' => [
                    'createTeam' => [
                        'type' => $TeamType,
                        'args' => [
                            'teamName' => ['type' => Type::nonNull(Type::string())],
                            'managerId' => ['type' => Type::nonNull(Type::int())],
                        ],
                        'resolve' => function ($root, array $args) use ($teamController) {
                            return $teamController->createTeam($root, $args);
                        },
                    ],
                    'addWorkerRole' => [
                        'type' => $WorkerRoleType,
                        'args' => [
                            'teamId' => ['type' => Type::nonNull(Type::int())],
                            'roleName' => ['type' => Type::nonNull(Type::string())],
                        ],
                        'resolve' => function ($root, array $args) use ($workerRoleController) {
                            return $workerRoleController->create($args);
                        },
                    ],
                    'addWorkerToTeam' => [
                        'type' => $WorkerType,
                        'args' => [
                            'email' => ['type' => Type::nonNull(Type::string())],
                            'teamId' => ['type' => Type::nonNull(Type::int())],
                            'roleId' => ['type' => Type::nonNull(Type::int())],
                        ],
                        'resolve' => function ($root, array $args) use ($workerController) {
                            return $workerController->addWorkerToTeam($args);
                        },
                    ],
                ],
            ]);


            $schema = new Schema(
                (new SchemaConfig())
                    ->setQuery($queryType)
                    ->setMutation($mutationType)
            );

            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new RuntimeException('Failed to get php://input');
            }

            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;

            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQLBase::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (Throwable $e) {
            error_log("GraphQL Error: " . $e->getMessage());
            $output = [
                'error' => [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ],
            ];
        }

        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($output);
    }
}