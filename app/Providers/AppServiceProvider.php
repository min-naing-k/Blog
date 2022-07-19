<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailChimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    app()->bind(Newsletter::class, function () {
      $client = (new ApiClient())->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us20',
      ]);
      return new MailChimpNewsletter($client);
    });

    // app()->bind(User::class, fn() => new User('Min Naing Kyaw', 22, 'Mandalay'));
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // No need to write fillable and guarded
    // Model::unguard();

    // can use this gate (Gate::allow('admin'), request()->user()->can('admin'), auth()->user()->can('admin'), $this->authorize('admin'))
    // can also use instead of createing new middleware (Route::middleware('can:admin')->group(...))
    Gate::define('admin', function (User $user) {
      return $user->username === 'minnaingkyaw';
    });

    // for using custom directive (@admin <h1>hello mnk</h1> @endadmin)
    Blade::if('admin', function () {
      return request()->user()?->can('admin');
    });
  }
}
