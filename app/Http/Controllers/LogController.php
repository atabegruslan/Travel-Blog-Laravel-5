<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CrudLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = CrudLog::orderBy('time', 'ASC')->paginate(false);

        foreach($logs as $log)
        {
            $this->tidyLog($log);
        }

        return view('log/index', ['logs' => $logs]);
    }

    private function tidyLog(&$log)
    {
        $state         = unserialize($log['params']); 
        $initialState  = [];
        $modifiedState = [];

        switch ($log['method']) 
        {
            case 'create':
                $modifiedState = $state;
                
                break;
            case 'update':
                $initialState  = $this->selectPreviousState($log);
                $modifiedState = $state;

                break;
            case 'delete':
                $initialState  = $state;

                break;
            default:
                
        }

        //$this->tidyAttributes($initialState);
        //$this->tidyAttributes($modifiedState);

        ksort($initialState);
        ksort($modifiedState);

        $log['initial_state']  = $initialState;
        $log['modified_state'] = $modifiedState;

        unset($log['params']);
    }

    private function tidyAttributes(&$attributes)
    {
        $unsetKeys = [
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',
            // 'created_by',
            // 'updated_by',
            // 'deleted_by',
            'img_url',
        ];

        foreach ($unsetKeys as $unsetKey) 
        {
            if (!empty($attributes[$unsetKey]))
            {
                unset($attributes[$unsetKey]);
            }
        }
    }

    private function selectPreviousState($log)
    {
        $thisAndPrevious = CrudLog::where('time', '<=', $log['time'])
            ->where('record_key_name', '=',  $log['record_key_name'])
            ->where('record_id', '=',  $log['record_id'])
            ->where('model', '=',  $log['model'])
            ->whereIn('method', ['create', 'update'])
            ->orderBy('id', 'DESC')
            ->take(2)
            ->get();

        $previousState = $thisAndPrevious[1]->getAttributes();

        return unserialize($previousState['params']);
    }

    public function restore(Request $request)
    {
        $logId    = $request->input('log_id');
        $logEntry = CrudLog::where('id', $logId)->first()->getAttributes();

        $this->tidyLog($logEntry);

        switch ($logEntry['method']) 
        {
            case 'create':
                $entry = $logEntry['model']::where($logEntry['record_key_name'], $logEntry['record_id'])->first();
                $entry->delete();

                break;
            case 'update':
                $entry   = $logEntry['model']::where($logEntry['record_key_name'], $logEntry['record_id'])->first();
                $updates = array();

                foreach ($logEntry['initial_state'] as $key => $value) 
                {
                    if ($key !== $logEntry['record_key_name'])
                    {
                        $updates[$key] = $value;
                    }
                }

                $entry->update($updates);

                break;
            case 'delete':
                $entry = new $logEntry['model'];

                foreach ($logEntry['initial_state'] as $key => $value) 
                {
                    if ($key !== $logEntry['record_key_name'])
                    {
                        $entry->$key = $value;
                    }
                }

                $entry->save();

                break;
            default:
                
        }

        return redirect('log');
    }
}
