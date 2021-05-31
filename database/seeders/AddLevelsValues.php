<?php

namespace Database\Seeders;

use Domain\Levels\Models\Level;
use Illuminate\Database\Seeder;

class AddLevelsValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'name' => 'Débutant',
                'lader' => 'default',
            ],[
                'name' => 'Débutant intermédiaire',
                'lader' => 'default',
            ],[
                'name' => 'Intermédiaire',
                'lader' => 'default',
            ],[
                'name' => 'Intermédiaire expert',
                'lader' => 'default',
            ],[
                'name' => 'Expert',
                'lader' => 'default',
            ]
        ];

        foreach($levels as $index => $level) {
            $current = Level::create($level);
        }
    }
}
