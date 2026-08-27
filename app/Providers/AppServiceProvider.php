<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') !== 'local') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        Vite::prefetch(concurrency: 3);

        try {
            $mailHost = \App\Models\Setting::where('key', 'mail_host')->first()?->value;
            $mailPort = \App\Models\Setting::where('key', 'mail_port')->first()?->value;
            $mailEncryption = \App\Models\Setting::where('key', 'mail_encryption')->first()?->value;
            $mailUsername = \App\Models\Setting::where('key', 'mail_username')->first()?->value;
            $mailPassword = \App\Models\Setting::where('key', 'mail_password')->first()?->value;

            if (!empty($mailUsername) && !empty($mailPassword)) {
                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => $mailHost ?: 'smtp.gmail.com',
                    'mail.mailers.smtp.port' => $mailPort ?: 587,
                    'mail.mailers.smtp.encryption' => $mailEncryption ?: 'tls',
                    'mail.mailers.smtp.username' => $mailUsername,
                    'mail.mailers.smtp.password' => $mailPassword,
                    'mail.from.address' => $mailUsername,
                    'mail.from.name' => \App\Models\Setting::where('key', 'company_name')->first()?->value ?: config('app.name'),
                ]);
            } else {
                // Prevent crash if SMTP is not configured in DB
                config(['mail.default' => 'log']);
            }
        } catch (\Exception $e) {
            // Ignore during initial setup or migrations
        }
    }
}
