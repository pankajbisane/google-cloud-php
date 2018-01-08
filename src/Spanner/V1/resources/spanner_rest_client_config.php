<?php

return [
    'interfaces' => [
        'google.spanner.v1.Spanner' => [
            'CreateSession' => [
                'method' => 'post',
                'uriTemplate' => '/v1/{database=projects/*/instances/*/databases/*}/sessions',
                'body' => '*',
                'placeholders' => [
                    'database' => [
                        'getters' => [
                            'getDatabase',
                        ],
                    ],
                ],
            ],
            'GetSession' => [
                'method' => 'get',
                'uriTemplate' => '/v1/{name=projects/*/instances/*/databases/*/sessions/*}',
                'placeholders' => [
                    'name' => [
                        'getters' => [
                            'getName',
                        ],
                    ],
                ],
            ],
            'ListSessions' => [
                'method' => 'get',
                'uriTemplate' => '/v1/{database=projects/*/instances/*/databases/*}/sessions',
                'placeholders' => [
                    'database' => [
                        'getters' => [
                            'getDatabase',
                        ],
                    ],
                ],
            ],
            'DeleteSession' => [
                'method' => 'delete',
                'uriTemplate' => '/v1/{name=projects/*/instances/*/databases/*/sessions/*}',
                'placeholders' => [
                    'name' => [
                        'getters' => [
                            'getName',
                        ],
                    ],
                ],
            ],
            'ExecuteSql' => [
                'method' => 'post',
                'uriTemplate' => '/v1/{session=projects/*/instances/*/databases/*/sessions/*}:executeSql',
                'body' => '*',
                'placeholders' => [
                    'session' => [
                        'getters' => [
                            'getSession',
                        ],
                    ],
                ],
            ],
            'Read' => [
                'method' => 'post',
                'uriTemplate' => '/v1/{session=projects/*/instances/*/databases/*/sessions/*}:read',
                'body' => '*',
                'placeholders' => [
                    'session' => [
                        'getters' => [
                            'getSession',
                        ],
                    ],
                ],
            ],
            'BeginTransaction' => [
                'method' => 'post',
                'uriTemplate' => '/v1/{session=projects/*/instances/*/databases/*/sessions/*}:beginTransaction',
                'body' => '*',
                'placeholders' => [
                    'session' => [
                        'getters' => [
                            'getSession',
                        ],
                    ],
                ],
            ],
            'Commit' => [
                'method' => 'post',
                'uriTemplate' => '/v1/{session=projects/*/instances/*/databases/*/sessions/*}:commit',
                'body' => '*',
                'placeholders' => [
                    'session' => [
                        'getters' => [
                            'getSession',
                        ],
                    ],
                ],
            ],
            'Rollback' => [
                'method' => 'post',
                'uriTemplate' => '/v1/{session=projects/*/instances/*/databases/*/sessions/*}:rollback',
                'body' => '*',
                'placeholders' => [
                    'session' => [
                        'getters' => [
                            'getSession',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
