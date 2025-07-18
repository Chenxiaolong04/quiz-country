<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function home()
    {
        // Reset session quiz
        session()->forget(['quiz_question', 'correct_answer', 'quiz_count', 'quiz_options', 'score']);
        return view('home');
    }

    public function quiz()
    {
        $quizCount = session('quiz_count', 1);

        if ($quizCount > 10) {
            return redirect()->route('quiz.end');
        }

        // Controlla se esiste già una domanda in sessione per questo quiz
        if (!session()->has('quiz_question') || !session()->has('correct_answer')) {
            // Genera una nuova domanda solo se non esiste già
            $country = Country::inRandomOrder()->first();
            $options = $this->getRandomOptions($country->capital);

            session([
                'correct_answer' => $country->capital,
                'quiz_question' => "Qual è la capitale di " . $country->name . "?",
                'quiz_count' => $quizCount,
                'quiz_options' => $options
            ]);
        }

        $quiz = [
            'question' => session('quiz_question'),
            'options' => session('quiz_options'),
            'count' => $quizCount
        ];

        return view('quiz', compact('quiz'));
    }

    private function getRandomOptions($correctCapital)
    {
        $fakeCapitals = Country::where('capital', '!=', $correctCapital)
            ->inRandomOrder()
            ->limit(3)
            ->pluck('capital')
            ->toArray();

        $options = array_merge($fakeCapitals, [$correctCapital]);
        shuffle($options);
        return $options;
    }

    public function checkAnswer(Request $request)
    {
        $userAnswer = $request->input('answer');
        $correctAnswer = session('correct_answer');
        $quizCount = session('quiz_count', 1);
        $score = session('score', 0);

        if ($userAnswer === $correctAnswer) {
            $score++;
            session(['score' => $score]);
        }

        session(['quiz_count' => $quizCount + 1]);
        
        // Pulisce la domanda corrente per generarne una nuova
        session()->forget(['correct_answer', 'quiz_question', 'quiz_options']);

        return redirect()->route('quiz.show');
    }


    public function end()
{
    $score = session('score', 0); // leggi prima

    // Aggiorna il punteggio dell'utente se è loggato
    if (session('user_nickname')) {
        $loginController = new \App\Http\Controllers\LoginController();
        $loginController->updateScore('quiz', $score);
    }

    // MOSTRA IL PUNTEGGIO PRIMA DI CANCELLAZIONE
    $view = view('quiz-end', compact('score'));

    // Pulizia finale dopo
    session()->forget(['correct_answer', 'quiz_question', 'quiz_count', 'score', 'quiz_options']);

    return $view;
}


}
