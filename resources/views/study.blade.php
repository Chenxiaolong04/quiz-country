<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modalità Studio</title>
</head>
<body>
    <h1>Modalità Studio</h1>
<p><img src="{{ $flagUrl }}" alt="Bandiera di {{ $question }}" style="width: 160px;"></p>

    <p>{{ $question }}</p>
    <p><strong>Capitale:</strong> {{ $answer }}</p>

<div class="navigation">
    <form method="POST" action="{{ route('study.navigate') }}" style="display: inline;">
        @csrf
        <input type="hidden" name="action" value="back">
        <button type="submit" class="nav-button" {{ !$canGoBack ? 'disabled' : '' }}>
            Precedente
        </button>
    </form>

    @if($canGoForward)
        <form method="POST" action="{{ route('study.navigate') }}" style="display: inline;">
            @csrf
            <input type="hidden" name="action" value="next">
            <button type="submit" class="nav-button">
                Successivo
            </button>
        </form>
    @else
        <form method="GET" action="{{ route('study.index') }}" style="display: inline;">
            <button type="submit" class="nav-button">
                Nuova Nazione
            </button>
        </form>
    @endif
</div>

    <div style="margin-top: 20px;">
        <a href="{{ route('home') }}">Torna alla home</a>
    </div>
</body>
</html>
