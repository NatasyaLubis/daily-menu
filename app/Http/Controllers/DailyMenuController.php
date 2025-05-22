<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyMenu;

class DailyMenuController extends Controller
{
    public function create()
    {
        return view('daily-menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|array|min:1',
            'budget' => 'required|integer|min:1000',
        ]);

        $recommendations = $this->generateMenu($request->ingredients, $request->budget);

        return view('daily-menu.create', [
            'recommendations' => $recommendations,
            'budget' => $request->budget,
            'ingredients' => $request->ingredients,
        ]);
    }

    public function generateMenu(array $ingredients, int $budget)
    {
        $menuList = [
            ['name' => 'Nasi Goreng Telur', 'cost' => 8000, 'ingredients' => ['telur', 'nasi']],
            ['name' => 'Mie Rebus Sosis', 'cost' => 7000, 'ingredients' => ['mie', 'sosis']],
            ['name' => 'Telur Dadar', 'cost' => 5000, 'ingredients' => ['telur']],
            ['name' => 'Sayur Sawi Kuah', 'cost' => 6000, 'ingredients' => ['sawi']],
        ];

        $suggestions = [];
        foreach ($menuList as $menu) {
            if ($budget >= $menu['cost'] && empty(array_diff($menu['ingredients'], $ingredients))) {
                $suggestions[] = $menu;
            }
        }

        if (empty($suggestions)) {
            $suggestions[] = ['name' => 'Tidak ada menu cocok', 'cost' => 0];
        }

        return $suggestions;
    }
}
