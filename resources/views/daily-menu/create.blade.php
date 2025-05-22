<!DOCTYPE html>
<html>
<head>
    <title>Daily Menu Generator</title>
</head>
<body>
    <h1>Cari Menu Harian</h1>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form input --}}
    <form method="POST" action="{{ url('/daily-menu') }}">
        @csrf

        <label>Bahan yang tersedia:</label><br>
        <input type="checkbox" name="ingredients[]" value="telur"
            {{ is_array(old('ingredients')) && in_array('telur', old('ingredients')) ? 'checked' : '' }}> Telur<br>
        <input type="checkbox" name="ingredients[]" value="nasi"
            {{ is_array(old('ingredients')) && in_array('nasi', old('ingredients')) ? 'checked' : '' }}> Nasi<br>
        <input type="checkbox" name="ingredients[]" value="mie"
            {{ is_array(old('ingredients')) && in_array('mie', old('ingredients')) ? 'checked' : '' }}> Mie<br>
        <input type="checkbox" name="ingredients[]" value="sosis"
            {{ is_array(old('ingredients')) && in_array('sosis', old('ingredients')) ? 'checked' : '' }}> Sosis<br>
        <input type="checkbox" name="ingredients[]" value="sawi"
            {{ is_array(old('ingredients')) && in_array('sawi', old('ingredients')) ? 'checked' : '' }}> Sawi<br>

        <br>
        <label>Budget (Rp):</label><br>
        <input type="number" name="budget" min="1000" value="{{ old('budget') }}"><br><br>

        <button type="submit">Cari Menu</button>
    </form>

    {{-- Tampilkan hasil jika ada --}}
    @if(isset($recommendations))
        <h2>Hasil Rekomendasi Menu:</h2>
        <ul>
            @foreach ($recommendations as $menu)
                <li>{{ $menu['name'] }} - Rp{{ number_format($menu['cost']) }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
