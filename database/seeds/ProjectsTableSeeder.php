<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) {
            $projects[] = [
                'user_id'   => 1,
                'name'      => 'Project #' . $i,
            ];
        }

        DB::table('projects')->insert($projects);
    }
}
