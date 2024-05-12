<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * Routes data provider
     *
     * @return array[]
     */
    public static function routes(): array
    {
        return [
            ['/drivers'],
            ['/trips'],
            ['/'],
            ['/export'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider routes
     */
    public function test_routes_available(string $route): void
    {
        $response = $this->get($route);
        $response->assertStatus(200);
    }
}
