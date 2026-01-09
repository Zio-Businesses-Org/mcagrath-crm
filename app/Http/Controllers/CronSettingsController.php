<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CronSettings;
use App\Helper\Reply;
use Illuminate\Support\Facades\DB;

class CronSettingsController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Cron Settings';
        $this->activeSettingMenu = 'cron_settings';
        $this->middleware(function ($request, $next) {
            abort_403(user()->permission('manage_company_setting') !== 'all');

            return $next($request);
        });
    }

    public function index()
    {
        $this->cron = CronSettings::select('cron_settings.*')
                        ->selectSub(function ($q) {
                            $q->from('jobs')
                            ->selectRaw('COUNT(*)')
                            ->whereColumn('jobs.queue', 'cron_settings.queue');
                        }, 'jobs_count')
                        ->selectSub(function ($q) {
                            $q->from('failed_jobs')
                            ->selectRaw('COUNT(*)')
                            ->whereColumn('failed_jobs.queue', 'cron_settings.queue');
                        }, 'failed_jobs_count')
                        ->get();
        return view('cron-settings.index', $this->data);
    }

    public function create()
    {
        return view('cron-settings.ajax.create', $this->data);
    }

    public function store(Request $request)
    {
        $cron = new CronSettings;
        $cron->queue = $request->queue;
        $cron->queue_command = $request->queue_command;
        $cron->queue_description = $request->queue_description;
        $cron->created_by = user()->id;
        $cron->save();
        return Reply::success('messages.recordSaved');
    }

    public function edit($id)
    {
        $this->cron = CronSettings::findOrFail($id);
        return view('cron-settings.ajax.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $cron = CronSettings::findOrFail($id);
        $cron->queue = $request->queue;
        $cron->queue_command = $request->queue_command;
        $cron->queue_description = $request->queue_description;
        $cron->save();
        return Reply::success('messages.updateSuccess');
    }

    public function destroy($id)
    {
        CronSettings::destroy($id);
        return Reply::success(__('messages.deleteSuccess'));
    }
}
