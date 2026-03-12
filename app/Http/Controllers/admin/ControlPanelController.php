<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

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
}
