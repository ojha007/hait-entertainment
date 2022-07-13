<?php

namespace App\Providers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('backend.*', function ($view) {
            $view->with(['routePrefix' => 'internal.', 'masterRoute' => 'internal.master.']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FormRequest::macro('FormRequestForApi', function ($request) {
//            dd('ff');
            if ($request->wantsJson()) {
                return new JsonResponse(
                    ['message' => 'The given data was invalid.',
                        'errors' => $request->errors(),
                        'status' => 422
                    ], 422);
            }
            return [];
        });
    }
}
