<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('fk_department')->constrained('departments');
            $table->foreignId('fk_designation')->constrained('designations');
            $table->string('phone_number');
            $table->timestamps();
        });

        $d1=Designation::create([
            'name' => 'Marketing Manager'
        ]);
        $d2=Designation::create([
            'name' => 'Mobile App Developer'
        ]);
        $e1=Department::create([
            'name' => 'Sales and Marketing'
        ]);
        $e2=Department::create([
            'name' => 'Application Development'
        ]);

        $u1=User::create([
            'name' => 'John Doe',
            'fk_department' => $d1->id,
            'fk_designation' => $e1->id,
            'phone_number' => '1234567890',
        ]);

        $u2=User::create([
            'name' => 'Alex',
            'fk_department' => $d2->id,
            'fk_designation' => $e2->id,
            'phone_number' => '0987654321',
        ]);
        
        $u3=User::create([
            'name' => 'Gabriel Milito',
            'fk_department' => $d1->id,
            'fk_designation' => $e1->id,
            'phone_number' => '6789012345',
        ]);

        $u4=User::create([
            'name' => 'John Abraham',
            'fk_department' => $d2->id,
            'fk_designation' => $e2->id,
            'phone_number' => '5432109876',
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
