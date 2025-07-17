<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Pagina Home
    public function home()
    {
        return view('home');
    }

    // Pagina Quiz

    public function quiz()
    {
        $country = Country::inRandomOrder()->first();
        $options = $this->getRandomOptions($country->capital);

        $quiz = [
            'question' => "Qual è la capitale di " . $country->name . "?",
            'options' => $options,
            'answer' => $country->capital
        ];

        // Salvo la risposta corretta in sessione
        session(['correct_answer' => $country->capital]);

        return view('quiz', compact('quiz', 'country'));
    }


    private function getRandomOptions($correctCapital)
    {
        // Prende 2 capitali casuali e diverse da quella giusta
        $fakeCapitals = Country::where('capital', '!=', $correctCapital)
            ->inRandomOrder()
            ->limit(2)
            ->pluck('capital')
            ->toArray();

        // Unisce quella giusta alle 2 sbagliate
        $options = array_merge($fakeCapitals, [$correctCapital]);

        // Mescola in ordine casuale
        shuffle($options);

        return $options;
    }

    public function checkAnswer(Request $request)
    {
        $answer = $request->input('answer');
        $correctAnswer = session('correct_answer');  // prendo la risposta salvata in sessione

        if ($answer === $correctAnswer) {
            return "Risposta corretta!";
        }
        return "Risposta sbagliata!";
    }

}
