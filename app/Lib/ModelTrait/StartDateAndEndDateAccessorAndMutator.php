<?php
declare (strict_types = 1);
namespace App\Lib\ModelTrait;

use Carbon\Carbon;

trait StartDateAndEndDateAccessorAndMutator
{
    public function setStartDateAttribute($value): void
    {
        $this->attributes['start_date'] = null;
        if (!empty($value)) {
            $this->attributes['start_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getStartDateAttribute($value): ?Carbon
    {
        if (!empty($value)) {
            $returned = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
            return $returned;
        }
    }

    public function setEndDateAttribute($value): void
    {
        $this->attributes['end_date'] = null;
        if (!empty($value)) {
            $this->attributes['end_effective_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getEndDateAttribute($value): ?Carbon
    {
        if (!empty($value)) {
            $returned = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
            return $returned;
        }
    }
}
