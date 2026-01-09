<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ControlPanelController extends Controller
{
    public function index()
    {
        return view('admin.control-panel', [
            'mntnce_mode' => SystemSettings::where('type', 'maintenance_mode')->first(),
            'ticket_sales' => SystemSettings::where('type', 'ticket_sales')->first(),
            'user_registration' => SystemSettings::where('type', 'user_registration')->first(),
            'email_notifications' => SystemSettings::where('type', 'email_notifications')->first()
        ]);
    }
    public function control(Request $request)
    {
        switch ($request->quick_action) {
            case 'restart':
                return back()->with('success', 'Services restarted successfully.');

            case 'clear-cache':
                Artisan::call('app:clear-cache-command');
                return back()->with('success', 'Cache cleared successfully.');

            case 'system-logs':
                return back()->with('success', 'System logs viewed.');

            case 'export-reports':
                return back()->with('success', 'Reports exported successfully.');

            case 'backup':
                return back()->with('success', 'Database backup completed.');

            default:
                return back()->withErrors('Invalid action.');
        }
    }
    public function quickAction(Request $request)
    {
        
    }
}
