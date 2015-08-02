<?php
use SimpleLance\User;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class InvoiceStatus extends \Eloquent
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
