<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) {
            for ($j=1; $j <= 5; $j++) {
                $tasks[] = [
                    'project_id'    => $i,
                    'description'   => 'Task #' . $j,
                    'deadline'      => date('Y-m-d'),
                    'priority'      => $j,
                ];
            }
        }

        DB::table('tasks')->insert($tasks);
    }
}
