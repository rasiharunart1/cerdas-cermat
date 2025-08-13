<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create a sample competition
        $competition = Competition::create([
            'name' => 'Cerdas Cermat Demo',
            'code' => 'DEMO123',
            'status' => 'ready'
        ]);

        // Create sample questions
        $questions = [
            [
                'category' => 'Pengetahuan Umum',
                'text' => 'Siapa presiden pertama Indonesia?',
                'type' => 'mcq',
                'points' => 10,
                'options' => [
                    ['text' => 'Soekarno', 'is_correct' => true],
                    ['text' => 'Soeharto', 'is_correct' => false],
                    ['text' => 'B.J. Habibie', 'is_correct' => false],
                    ['text' => 'Megawati', 'is_correct' => false]
                ]
            ],
            [
                'category' => 'Geografi',
                'text' => 'Apa ibukota Australia?',
                'type' => 'mcq',
                'points' => 10,
                'options' => [
                    ['text' => 'Sydney', 'is_correct' => false],
                    ['text' => 'Melbourne', 'is_correct' => false],
                    ['text' => 'Canberra', 'is_correct' => true],
                    ['text' => 'Brisbane', 'is_correct' => false]
                ]
            ],
            [
                'category' => 'Matematika',
                'text' => 'Berapa hasil dari 15 x 8?',
                'type' => 'mcq',
                'points' => 10,
                'options' => [
                    ['text' => '120', 'is_correct' => true],
                    ['text' => '110', 'is_correct' => false],
                    ['text' => '130', 'is_correct' => false],
                    ['text' => '140', 'is_correct' => false]
                ]
            ],
            [
                'category' => 'Sejarah',
                'text' => 'Tahun berapa Indonesia merdeka?',
                'type' => 'short',
                'points' => 15
            ],
            [
                'category' => 'IPA',
                'text' => 'Apa rumus kimia air?',
                'type' => 'short',
                'points' => 10
            ]
        ];

        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'category' => $questionData['category'],
                'text' => $questionData['text'],
                'type' => $questionData['type'],
                'points' => $questionData['points'],
                'active' => true
            ]);

            // Add options for MCQ questions
            if (isset($questionData['options'])) {
                foreach ($questionData['options'] as $optionData) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'text' => $optionData['text'],
                        'is_correct' => $optionData['is_correct']
                    ]);
                }
            }

            // Attach question to competition with order
            $competition->questions()->attach($question->id, ['order' => $index + 1]);
        }

        // Create sample participants
        $participantNames = ['Alice', 'Bob', 'Charlie', 'Diana', 'Eve'];
        foreach ($participantNames as $name) {
            Participant::create([
                'competition_id' => $competition->id,
                'display_name' => $name,
                'score' => 0
            ]);
        }
    }
}
