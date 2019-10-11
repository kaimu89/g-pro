<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            "name" => ["マネージャー", "コーチ", "アナライザー", "通訳", "広報", "ライター", "プログラマー"],
        ];

        for ($i = 0; $i < count($datas["name"]); $i++) {
            DB::table("staff")->insert([
                "name" => $datas["name"][$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
