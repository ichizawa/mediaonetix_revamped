<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;

class ControlPanelController extends Controller
{
    public function index()
    {
        return view('admin.control-panel', [
            'mntnce_mode' => SystemSettings::where('type', 'maintenance_mode')->first(),
            'ticket_sales' => SystemSettings::where('type', 'ticket_sales')->first(),
            'user_registration' => SystemSettings::where('type', 'user_registration')->first(),
            'email_notifications' => SystemSettings::where('type', 'email_notifications')->first(),
            'coming_soon_mode' => SystemSettings::where('type', 'coming_soon_mode')->first()
        ]);
    }
    public function control(Request $request)
    {
        switch ($request->quick_action) {
            case 'restart':
                Artisan::call('queue:restart');

                return back()->with('success', 'Services restarted successfully.');

            case 'clear-cache':
                Artisan::call('cache:clear');
                return back()->with('success', 'Cache cleared successfully.');

            case 'system-logs':
                return back()->with('success', 'System logs viewed.');

            case 'export-reports':
                return back()->with('success', 'Reports exported successfully.');

            case 'backup':
                try {
                    // Queue the Spatie backup command (requires spatie/laravel-backup to be installed)
                    // We queue it so the UI doesn't hang while the database dumps
                    Artisan::queue('backup:run', ['--only-db' => true]);

                    return back()->with('success', 'Database backup has been queued and is processing in the background.');
                } catch (\Exception $e) {
                    Log::error('Backup Quick Action failed: ' . $e->getMessage());
                    return back()->with('error', 'Failed to start database backup. Check system logs.');
                }
            default:
                return back()->withErrors('Invalid action.');
        }
    }
    public function quickAction(Request $request)
    {
        try {
            switch ($request->type) {
                case 'maintenance':
                    SystemSettings::where('type', 'maintenance_mode')->update([
                        'value' => $request->maintenance_mode == 'true' ? 1 : 0
                    ]);

                    return response()->json([
                        'success' => true,
                        'data' => null,
                        'message' => 'Maintenance mode updated successfully.'
                    ], 200);
                case 'ticket_sales':
                    SystemSettings::where('type', 'ticket_sales')->update([
                        'value' => $request->ticket_sales == 'true' ? 1 : 0
                    ]);

                    return response()->json([
                        'success' => true,
                        'data' => null,
                        'message' => 'Ticket sales updated successfully.'
                    ], 200);
                case 'user_registration':
                    SystemSettings::where('type', 'user_registration')->update([
                        'value' => $request->user_registration == 'true' ? 1 : 0
                    ]);

                    return response()->json([
                        'success' => true,
                        'data' => null,
                        'message' => 'User registration updated successfully.'
                    ], 200);
                case 'email_notifications':
                    SystemSettings::where('type', 'email_notifications')->update([
                        'value' => $request->email_notifications == 'true' ? 1 : 0
                    ]);

                    return response()->json([
                        'success' => true,
                        'data' => null,
                        'message' => 'Email notifications updated successfully.'
                    ], 200);

                case 'coming_soon':
                    SystemSettings::where('type', 'coming_soon_mode')->update([
                        'value' => $request->coming_soon == 'true' ? 1 : 0
                    ]);

                    return response()->json([
                        'success' => true,
                        'data' => null,
                        'message' => 'Coming soon mode updated successfully.'
                    ], 200);
                default:
                    return response()->json([
                        'success' => false,
                        'data' => null,
                        'message' => 'Invalid Type'
                    ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function update_coming_soon(Request $request)
    {
        try {
            $request->validate([
                'html' => ['required', 'string'],
            ]);

            $path = resource_path('views/shareable/coming-soon.blade.php');

            File::put($path, $request->input('html'));

            return response()->json(['message' => 'Saved successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update_maintenance(Request $request)
    {
        try {
            $request->validate([
                'html' => ['required', 'string'],
            ]);

            $path = resource_path('views/shareable/maintenance.blade.php');

            File::put($path, $request->input('html'));

            return response()->json(['message' => 'Saved successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
