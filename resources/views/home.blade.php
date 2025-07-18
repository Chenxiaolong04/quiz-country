<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Geografia - Home</title>
</head>
<body>
    <h1>Benvenuto al Quiz Geografico!</h1>
    <a href="{{ url('/quiz') }}">Indovina la capitale</a>
    <a href="{{ url('/flag-quiz') }}">Indovina la bandiera</a>
    <a href="{{ url('/hang') }}">Gioco dell'impiccato</a>
    <a href="{{ url('/study') }}">Studia le capitali</a>
</body>
</html>
