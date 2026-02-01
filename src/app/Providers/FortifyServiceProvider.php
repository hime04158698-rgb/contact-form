<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;

// 使わないならコメントアウトでOK
// use App\Actions\Fortify\ResetUserPassword;
// use App\Actions\Fortify\UpdateUserPassword;
// use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 登録処理（POST /register）の実体
        Fortify::createUsersUsing(CreateNewUser::class);

        // 「Fortify標準の登録画面」ではなく、自分のBladeを表示
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // 「Fortify標準のログイン画面」ではなく、自分のBladeを表示
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ログイン試行回数制限（ブルートフォース対策）
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
