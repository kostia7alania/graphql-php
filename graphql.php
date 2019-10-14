<?php
require_once './vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Schema;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

try {
    // Получение запроса
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    $query = $input['query'];

    // Содание типа данных "Запрос"
    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'hello' => [
                'type' => Type::string(),
                'description' => 'Возвращает приветствие',
                'resolve' => function () { return 'Привет, GraphQL!'; }
            ],
            'bye' => [
                'type' => Type::string(),
                'description' => 'Возвращает приветствие',
                'resolve' => function () { return 'bye, GraphQL!'; }
            ],
            'sex' => [
                'type' => Type::string(),
                'description' => 'Возвращает приветствие',
                'resolve' => function () { return 'bye, GraphQL!'; }
            ],
            'fuck' => [
                'type' => Type::string(),
                'description' => 'Возвращает приветствие',
                'resolve' => function () { return [1,2,3]; }
            ],
            'danila' => [
                'type' => Type::string(),
                'description' => 'Возвращает приветствие',
                'resolve' => function () { return 'sex'; }
            ]
        ]
    ]);

    // Создание схемы
    $schema = new Schema([
        'query' => $queryType
    ]);

    // Выполнение запроса
    $result = GraphQL::execute($schema, $query);
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}

// Вывод результата
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);