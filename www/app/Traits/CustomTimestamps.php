<?php


namespace App\Traits;


trait CustomTimestamps
{
    public static function booted()
    {
        static::creating(function ($obj) {
            $obj->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $obj->created_by = \Auth::id();
        });

        static::updating(function ($obj) {
            $obj->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $obj->updated_by = \Auth::id();
        });

        static::deleting(function ($obj) {
            $obj->deleted_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $obj->deleted_by = \Auth::id();
        });
    }

}
