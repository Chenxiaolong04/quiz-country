<!-- resources/views/quiz.blade.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Quiz Geografico</title>
</head>
<body>

    <h2>{{ $quiz['question'] }}</h2>

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
    </form>

</body>
</html>
