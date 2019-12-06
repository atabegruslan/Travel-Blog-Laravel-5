<?php

namespace App\Listeners;

use App\Events\CrudLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\CrudLog;

class CrudLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CrudLogEvent  $event
     * @return void
     */
    public function handle(CrudLogEvent $event)
    {
        $user = auth()->user();

        $entry = new CrudLog;
        $entry->user_id = $user->id;
        $entry->user_name = $user->name;
        $entry->model = $event->model;
        $entry->table_name = $event->table;
        $entry->method = $event->method;
        $entry->record_key_name = $event->recordKeyName;
        $entry->record_id = $event->recordId;
        $entry->params = serialize($event->parameters);
        $entry->save();
    }
}
