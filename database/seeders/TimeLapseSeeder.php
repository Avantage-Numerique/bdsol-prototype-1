<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Projects\Models\TimeLapse;

class TimeLapseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Ajouter le Observer Sluggable avant de seeder ça.
        $timelapses = [
            ['time_lapse' => 'Moins d\'un mois'],
            ['time_lapse' => 'De un a trois mois'],
            ['time_lapse' => 'De trois à six mois'],
            ['time_lapse' => 'De six mois à un an'],
            ['time_lapse' => 'De un an à deux ans'], 
            ['time_lapse' => 'De deux ans à trois ans'],
            ['time_lapse' => 'Plus de trois ans']
        ];

        foreach($timelapses as $index => $timelapse) {
            $current = TimeLapse::create($timelapse);
        }

    }
}
