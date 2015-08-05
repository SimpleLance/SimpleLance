<?php

use Illuminate\Database\Eloquent\Model;

class InvoiceStatus extends Model
{
    protected $fillable = ['title'];

    public function getStatuses()
    {
        $allStatuses = InvoiceStatus::all();
        $statuses = [];

        foreach ($allStatuses as $thisStatus) {
            $statuses[$thisStatus->id] = $thisStatus->title;
        }

        return $statuses;
    }
}
