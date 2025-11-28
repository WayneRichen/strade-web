<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // 先找看看這個人是不是已經存在系統（用 google_id 或 email）
        $existingUser = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        // 從 query string 或 session 取得邀請碼
        $inviteCode = request()->query('invite') ?? session('invite_code');

        $user = null;

        DB::transaction(function () use ($googleUser, $existingUser, $inviteCode, &$user) {
            // 第一次登入（系統內沒有這個人）
            if (!$existingUser) {

                $invitedById = null;

                // 如果有邀請碼，找出邀請人
                if ($inviteCode) {
                    $inviter = User::where('invite_code', $inviteCode)->first();

                    if ($inviter) {
                        $invitedById = $inviter->id;

                        // 累計邀請數（可選）
                        $inviter->increment('invite_count');
                    }
                }

                // 產生自己的邀請碼（你也可以搬去 User model 寫成靜態方法）
                do {
                    $newInviteCode = Str::upper(Str::random(8));
                } while (User::where('invite_code', $newInviteCode)->exists());

                $user = User::create([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar,
                    'invited_by' => $invitedById,
                    'invite_code' => $newInviteCode,
                    'subscription_plan' => 'free',
                    'subscription_ends_at' => null,
                ]);
            } else {
                // 已存在的使用者 → 更新基本資料 + 綁定 google_id（若還沒綁）
                $existingUser->update([
                    'google_id' => $existingUser->google_id ?: $googleUser->id,
                    'name' => $googleUser->name,
                    'avatar' => $googleUser->avatar,
                ]);

                $user = $existingUser;
            }

            $user->last_login_at = now();
            $user->save();
        });

        Auth::login($user, remember: true);

        session()->forget('invite_code');

        return redirect()->route('filament.account.pages.dashboard');
    }
}
