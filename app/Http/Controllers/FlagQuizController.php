<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlagQuizController extends Controller
{
    // Mostra il quiz

    public function quiz()
    {
        $quizCount = session('flag_quiz_count', 1);
        $score = session('flag_score', 0);

        if ($quizCount > 3) {
            return redirect()->route('flag.end');
        }

        // Ottieni tutti i paesi dall'API REST Countries
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,cca2');
        if (!$response->successful()) {
            abort(500, 'Errore nel recupero dei dati dei paesi');
        }
        $allCountries = $response->json();
        $filtered = array_filter($allCountries, function ($country) {
            return isset($country['name']['common'], $country['cca2']);
        });
        $countries = array_values($filtered);

        // Scegli il paese corretto
        $correct = $countries[array_rand($countries)];

        // Scegli 3 distrattori diversi dal corretto
        $distractors = [];
        while (count($distractors) < 3) {
            $random = $countries[array_rand($countries)];
            if (
                $random['name']['common'] !== $correct['name']['common'] &&
                !in_array($random['name']['common'], array_column($distractors, 'name', 'common'))
            ) {
                $distractors[] = $random;
            }
        }

        // Crea le opzioni e mescolale
        $options = array_merge([$correct], $distractors);
        shuffle($options);

        // Salva la risposta corretta e il conteggio in sessione
        session(['flag_correct' => $correct['name']['common'], 'flag_quiz_count' => $quizCount, 'flag_score' => $score]);

        // Prepara URL bandiera
        $code = strtolower($correct['cca2']);
        $flagUrl = "https://flagcdn.com/w160/{$code}.png";

        return view('flag-quiz', [
            'flag' => $flagUrl,
            'options' => $options,
            'count' => $quizCount,
            'score' => $score,
        ]);
    }

    // Verifica la risposta dell'utente

    public function checkAnswer(Request $request)
    {
        $answer = $request->input('answer');
        $correct = session('flag_correct');
        $quizCount = session('flag_quiz_count', 1);
        $score = session('flag_score', 0);

        if ($answer === $correct) {
            $score++;
            session(['flag_score' => $score]);
            $message = '✅ Risposta corretta!';
        } else {
            $message = '❌ Risposta sbagliata. Riprova!';
        }

        session(['flag_quiz_count' => $quizCount + 1]);

        if ($quizCount + 1 > 3) {
            return redirect()->route('flag.end');
        }

        return redirect()->route('flag.quiz')->with('message', $message);
    }

    public function end()
    {
        $score = session('flag_score', 0);
        // Pulizia finale opzionale
        session()->forget(['flag_correct', 'flag_quiz_count', 'flag_score']);
        return view('flag-end', compact('score'));
    }
}
