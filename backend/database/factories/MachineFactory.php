<?php

namespace Database\Factories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Sprayer brands and models
        $sprayerBrands = [
            "Hayleys" => [
                "Hayspray 16L",
                "Agricultural Electric Knapsack Sprayer 16L – 2 in 1",
                "Hayspray 20L"
            ],
            "Hunter" => [
                "Hunter Knapsack Sprayer Steel 16L",
                "Hunter Knapsack Sprayer Plastic 16L",
                "Hunter Knapsack Sprayer 20L"
            ],
            "Sintek" => [
                "Power Sprayer 16L (SS-PS16-AG)",
                "Power Sprayer 20L",
                "Battery Operated Sprayer"
            ],
            "Hi-Q-Tools" => [
                "KNAPSACK Power Sprayer 16L",
                "KNAPSACK Power Sprayer 20L",
                "KNAPSACK Battery Operated Sprayer"
            ],
            "Gardena" => [
                "Backpack Sprayer 12L",
                "Backpack Sprayer 15L",
                "Backpack Sprayer 20L"
            ],
            "Jacto" => ["20L", "16L", "25L"],
            "Solo" => ["475", "456", "473"],
            "Stihl" => ["SR 430", "SR 200", "SR 450"],
            "Maruyama" => ["MS-4000", "MS-3500", "MS-5000"],
            "Honda" => ["Honda HP-400", "Honda HP-200", "Honda HP-500"],
            "Masand Agritech" => [
                "Knapsack Sprayer 16L",
                "Battery Operated Knapsack Sprayer",
                "Knapsack Sprayer 20L"
            ],
            "KisanKraft" => ["KK-KPS-204B", "KK-KPS-204A", "KK-KPS-205"],
            "Balwaan" => [
                "35 CC Knapsack Sprayer",
                "25 CC Knapsack Sprayer",
                "20 CC Knapsack Sprayer"
            ],
            "Foggers India" => [
                "India Mars T-02-000060 Sprayer",
                "India Mars T-02-000080 Sprayer",
                "India Mars T-02-000100 Sprayer"
            ],
            "KOSHIN" => [
                "HS-401E Hand Pressure Manual Sprayer",
                "HS-402E Hand Pressure Manual Sprayer",
                "HS-403E Hand Pressure Manual Sprayer"
            ]
        ];

        $brand = array_rand($sprayerBrands);
        $model = $this->faker->randomElement($sprayerBrands[$brand]);

        return [
            'name' => "{$brand} {$model} " . $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'brand' => $brand,
            'model' => $model,
            'purchase_date' => $this->faker->date(),
            'purchase_price' => $this->faker->randomFloat(2, 100, 5000),

        ];
    }
}
