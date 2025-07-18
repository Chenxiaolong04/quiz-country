
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Quiz Bandiera del Mondo</title>
</head>
<body>
    <h1>Indovina la nazione dalla bandiera</h1>

    <div>
        <img class="flag-img" src="{{ $flag }}" alt="Bandiera" width="256" height="192">
    </div>

    <form method="POST" action="{{ route('flag.check') }}">
        @csrf
        <div class="options">
            @foreach ($options as $option)
                <div class="option-row">
                    <input type="radio" id="option_{{ $loop->index }}" name="answer" value="{{ $option['name']['common'] }}" required>
                    <label for="option_{{ $loop->index }}">{{ $option['name']['common'] }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit">Invia risposta</button>
    </form>

    @if(session('message'))
        <div class="feedback">{{ session('message') }}</div>
    @endif
</body>
</html>
