<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $games = [];
        $gameList = [
            'Mobile Legends' => 'MOBA 5v5 populer dengan hero-hero keren.',
            'PUBG Mobile' => 'Battle royale di mana 100 pemain bertarung untuk bertahan hidup.',
            'Genshin Impact' => 'Open world RPG dengan sistem elemen unik.',
            'Valorant' => 'FPS tactical dengan agent spesial dan skill unik.',
            'Free Fire' => 'Battle royale cepat dan ringan.',
            'Call of Duty Mobile' => 'Game tembak-tembakan dengan banyak mode klasik.'
        ];

        foreach ($gameList as $name => $desc) {
            $games[] = [
                'name' => $name,
                'description' => $desc,
                'topup_options' => json_encode([
                    ['option' => '100 Diamonds', 'price' => rand(10000, 30000)],
                    ['option' => '500 Diamonds', 'price' => rand(40000, 150000)],
                    ['option' => '1000 Diamonds', 'price' => rand(100000, 300000)],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        DB::table('games')->insert($games);
    }
}
