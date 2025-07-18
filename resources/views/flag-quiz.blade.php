{{-- resources/views/flag-quiz.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Flag Quiz</title>
</head>
<body>
    <h1>Indovina la nazione dalla bandiera</h1>

    <img src="{{ $flag }}" alt="Bandiera" width="200">

    <form method="POST" action="{{ route('flag.check') }}">
        @csrf
        @foreach ($options as $option)
            <div>
                <input type="radio" id="option_{{ $loop->index }}" name="answer" value="{{ $option['name']['common'] }}" required>
                <label for="option_{{ $loop->index }}">{{ $option['name']['common'] }}</label>
            </div>
        @endforeach
        <button type="submit">Invia risposta</button>
    </form>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

</body>
</html>
