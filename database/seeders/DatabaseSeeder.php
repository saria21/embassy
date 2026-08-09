<?php

namespace Database\Seeders;

use App\Models\related_buildings;
use App\Models\department;
use App\Models\staff;
use App\Models\visa_applications;
use App\Models\appointments;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the 3 specific Syrian-Japanese buildings explicitly
        $embassy = related_buildings::create(['name' => 'Embassy of Japan in Damascus']);
        $literature = related_buildings::create(['name' => 'Japanese Literature Department at Damascus University']);
        $academic = related_buildings::create(['name' => 'Japan Center for Academic Cooperation in Aleppo']);

        // 2. Create Departments with explicit real-world operational definitions
        $visaDept = department::create(['name' => 'Visa Section', 'building_id' => $embassy->id]);
        $consularDept = department::create(['name' => 'Consular Services', 'building_id' => $embassy->id]);
        
        // Aleppo Center tracks certificate-seeking language programs
        $eduDept = department::create(['name' => 'JLPT Language Certification Track', 'building_id' => $academic->id]);
        
        // Damascus University tracks full higher-education degree tracks
        $langDept = department::create(['name' => 'Japanese Literature Degree Program', 'building_id' => $literature->id]);

        // 3. Create Staff and assign them strictly to their correct sections
        $visaStaff = staff::factory()->count(4)->create(['department_id' => $visaDept->department_id, 'role' => 'Interviewer']);
        $consularStaff = staff::factory()->count(3)->create(['department_id' => $consularDept->department_id, 'role' => 'Consular Officer']);
        $academicStaff = staff::factory()->count(3)->create(['department_id' => $eduDept->department_id, 'role' => 'Admin']);

        // 4. Create Visa Applications (Always belongs to visa staff/embassy environment)
        visa_applications::factory()->count(15)->create();

        // 5. Create 20 Appointments (Forced to only use Embassy interviewers for Visa stuff)
        for ($i = 0; $i < 20; $i++) {
            $purpose = fake()->randomElement(["Visa Interview", "Passport Renewal", "Document Attestation", "Notary Services"]);
            
            // Real-world rule: If it's a Visa Interview, it MUST go to a Visa Section staff member
            if ($purpose === "Visa Interview") {
                $interviewer = $visaStaff->random();
            } else {
                $interviewer = $consularStaff->random();
            }

            appointments::factory()->create([
                'interviewer_staff_id' => $interviewer->staff_id,
                'purpose_of_visit' => $purpose
            ]);
        }

        // 6. Create 15 visitor check-in logs tied across all staff members
        $allStaff = staff::all();
        for ($i = 0; $i < 15; $i++) {
            \App\Models\visits_logs::factory()->create([
                'staff_id' => $allStaff->random()->staff_id
            ]);
        }
    }
}
