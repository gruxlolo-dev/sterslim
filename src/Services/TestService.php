<?php

namespace App\Services;

class TestService
{
    public function all(): array
    {
        return [
            ['id' => 1, 'name' => 'Sample Test 1'],
            ['id' => 2, 'name' => 'Sample Test 2']
        ];
    }

    public function create(?array $data): array
    {
        // Add business logic here
        return array_merge(['id' => rand(3, 100)], $data ?? []);
    }
}
