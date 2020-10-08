<?php

use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contas')->insert([
            'conta' => '54321',
            'saldo' => '2000.00',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
