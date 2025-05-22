<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\DailyMenuController;

class DailyMenuTest extends TestCase
{
    public function test_generate_menu_returns_correct_recommendation()
    {
        $controller = new DailyMenuController();

        $ingredients = ['telur', 'mie', 'sosis'];
        $budget = 10000;

        $menus = $controller->generateMenu($ingredients, $budget);

        $this->assertNotEmpty($menus);
        $this->assertEquals('Mie Rebus Sosis', $menus[0]['name']);
    }
}
