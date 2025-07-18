<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function home()
    {
        // Reset session quiz
        session()->forget(['quiz_question', 'correct_answer', 'quiz_count']);
        return view('home');
    }

    public function quiz()
    {
        $quizCount = session('quiz_count', 1);

        if ($quizCount > 3) {
            return redirect()->route('quiz.end');
        }

        $country = Country::inRandomOrder()->first();
        $options = $this->getRandomOptions($country->capital);

        session([
            'correct_answer' => $country->capital,
            'quiz_question' => "Qual è la capitale di " . $country->name . "?",
            'quiz_count' => $quizCount
        ]);

        $quiz = [
            'question' => session('quiz_question'),
            'options' => $options,
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

        return redirect()->route('quiz.show');
    }


    public function end()
    {
        $score = session('score', 0);
        
        // Pulizia finale opzionale
        session()->forget(['correct_answer', 'quiz_question', 'quiz_count', 'score']);

        return view('quiz-end', compact('score'));
    }

}
