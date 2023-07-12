<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::create([
            'name' => 'Membantu Masyarakat Kekurangan Air Bersih',
            'slug' => 'membantu-masyarakat-kekurangan-air-bersih',
            'status' => 'Active',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus natus autem enim magni repudiandae blanditiis libero eum sapiente eos? At animi similique dicta ea ut ducimus illo, dignissimos illum explicabo!' ,
            'target' => '1000000',
            'start_date' => '2023/06/01',
            'end_date' => '2023/06/30',

        ]);
    }
}
