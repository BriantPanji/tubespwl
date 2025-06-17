<?php

namespace App\Providers;

use App\Http\Middleware\IsAdmin;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        Route::aliasMiddleware('isAdmin', IsAdmin::class);

        Gate::define('admin', function (?User $user) {
            return $user && $user->is_admin;
        });

        Gate::define('edit-post', function (?User $user, Post $post) {
            return $user && ($user->is_admin || $post->user->is($user));
        });

        Gate::define('edit-comment', function (?User $user, Comment $comment) {
            return $user && ($user->is_admin || $comment->user->is($user));
        });

        Validator::extend('alpha_space', function ($attribute, $value) {

            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);

        }, "The :attribute must only contain letters and spaces");
        Validator::extend('hashtag', function ($attribute, $value) {

            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^(?!\d+$)([a-zA-Z](?:[a-zA-Z0-9_]*[a-zA-Z0-9])?)(?:,\s*([a-zA-Z](?:[a-zA-Z0-9_]*[a-zA-Z0-9])?))*[,]?$/', $value);

        }, "The :attribute must only contain letters, numbers after letter, underscores and space after comma");
    }
}
