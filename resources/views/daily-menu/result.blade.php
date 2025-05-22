<!DOCTYPE html>
<html>
<head>
    <title>Hasil Rekomendasi Menu</title>
</head>
<body>
    <h1>Rekomendasi Menu untuk Budget Rp {{ number_format($budget, 0, ',', '.') }}</h1>

    <ul>
        @foreach ($recommendations as $menu)
            <li>{{ $menu['name'] }} - Rp {{ number_format($menu['cost'], 0, ',', '.') }}</li>
        @endforeach
    </ul>

    <a href="/daily-menu">Coba Lagi</a>
</body>
</html>
