<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'app_name'              => config('app.name'),
            'registration_open'     => config('app.registration_open', true),
            'require_event_approval' => config('app.require_event_approval', true),
            'mail_from'             => config('mail.from.address'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name'               => ['required', 'string', 'max:100'],
            'registration_open'      => ['nullable', 'boolean'],
            'require_event_approval' => ['nullable', 'boolean'],
            'mail_from'              => ['required', 'email'],
        ]);

        $env = base_path('.env');
        $lines = file($env);

        $map = [
            'APP_NAME'               => '"' . $request->app_name . '"',
            'MAIL_FROM_ADDRESS'      => '"' . $request->mail_from . '"',
            'APP_REGISTRATION_OPEN'  => $request->boolean('registration_open') ? 'true' : 'false',
            'APP_REQUIRE_APPROVAL'   => $request->boolean('require_event_approval') ? 'true' : 'false',
        ];

        $updated = array_map(function ($line) use ($map) {
            foreach ($map as $key => $value) {
                if (str_starts_with($line, $key . '=')) {
                    return $key . '=' . $value . "\n";
                }
            }
            return $line;
        }, $lines);

        // Append keys not already present
        $existing = implode('', $updated);
        foreach ($map as $key => $value) {
            if (!str_contains($existing, $key . '=')) {
                $updated[] = $key . '=' . $value . "\n";
            }
        }

        file_put_contents($env, implode('', $updated));

        Artisan::call('config:clear');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved.');
    }
}
