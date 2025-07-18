<!DOCTYPE html>
<html>
<head>
    <title>Quiz Geografico</title>
</head>
<body>

    <h2>Domanda {{ $quiz['count'] }} di 3</h2>
    <h3>{{ $quiz['question'] }}</h3>

    <form method="POST" action="{{ route('quiz.check') }}">
        @csrf
        @foreach ($quiz['options'] as $option)
            <div>
                <label>
                    <input type="radio" name="answer" value="{{ $option }}" required>
                    {{ $option }}
                </label>
            </div>
        @endforeach

        <button type="submit">Invia</button>
        <a href="{{ url('/') }}">Home</a>
    </form>

</body>
</html>
