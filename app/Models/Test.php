<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'test_type_id',
        'result',
        'notes',
        // Add other fillable attributes here
    ];

    // Define relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function testType()
    {
        return $this->belongsTo(TestType::class);
    }
}
