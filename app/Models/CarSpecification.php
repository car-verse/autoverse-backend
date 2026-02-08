<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSpecification extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'mpg_city' => 'decimal:2',
        'mpg_highway' => 'decimal:2',
        'mpg_combined' => 'decimal:2',
        'acceleration_0_60_mph' => 'decimal:2',
        'quarter_mile_sec' => 'decimal:2',
        'length_inches' => 'decimal:2',
        'width_inches' => 'decimal:2',
        'height_inches' => 'decimal:2',
        'wheelbase_inches' => 'decimal:2',
        'cargo_space_cu_ft' => 'decimal:2',
        'brake_diameter_front_inches' => 'decimal:2',
        'brake_diameter_rear_inches' => 'decimal:2',
        'engine_displacement_cc' => 'integer',
        'horsepower' => 'integer',
        'torque_lb_ft' => 'integer',
        'battery_capacity_kwh' => 'integer',
        'electric_range_miles' => 'integer',
        'curb_weight_lbs' => 'integer',
        'gross_weight_lbs' => 'integer',
        'towing_capacity_lbs' => 'integer',
        'payload_capacity_lbs' => 'integer',
        'seating_capacity' => 'integer',
    ];

    public function trimLevel(): BelongsTo
    {
        return $this->belongsTo(TrimLevel::class);
    }

    public function aspirationType(): BelongsTo
    {
        return $this->belongsTo(AspirationType::class);
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    public function transmissionType(): BelongsTo
    {
        return $this->belongsTo(TransmissionType::class);
    }

    public function driveType(): BelongsTo
    {
        return $this->belongsTo(DriveType::class);
    }

    public function basicWarranty(): BelongsTo
    {
        return $this->belongsTo(WarrantyTerm::class, 'basic_warranty_id');
    }

    public function powertrainWarranty(): BelongsTo
    {
        return $this->belongsTo(WarrantyTerm::class, 'powertrain_warranty_id');
    }

    public function corrosionWarranty(): BelongsTo
    {
        return $this->belongsTo(WarrantyTerm::class, 'corrosion_warranty_id');
    }

    public function roadsideWarranty(): BelongsTo
    {
        return $this->belongsTo(WarrantyTerm::class, 'roadside_warranty_id');
    }
}
