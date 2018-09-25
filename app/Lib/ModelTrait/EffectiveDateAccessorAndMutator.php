<?php
declare (strict_types = 1);
namespace App\Lib\ModelTrait;
use Carbon\Carbon;

trait EffectiveDateAccessorAndMutator
{
    public function setStartEffectiveDateAttribute($value): void
    {
        $this->attributes['start_effective_date'] = null;
        if(!empty($value)) {
            $this->attributes['start_effective_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getStartEffectiveDateAttribute($value): ?Carbon
    {
        if(!empty($value)) {
            $returned = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
            return $returned;
        }
    }

    public function setEndEffectiveDateAttribute($value): void
    {
        $this->attributes['end_effective_date'] = null;
        if(!empty($value)) {
            $this->attributes['end_effective_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
    }

    public function getEndEffectiveDateAttribute($value): ?Carbon
    {
        if(!empty($value)) {
            $returned = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
            return $returned;
        }
    }
}
