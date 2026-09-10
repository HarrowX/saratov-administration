<?php

namespace App\Services;

use App\Models\HistoryView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ViewService
{
    public function calculate($id, $type)
    {
        $this->calculateAuth($id, $type);
        $this->calculateGuest($id, $type);
    }

    private function calculateAuth($id, $type)
    {
        if (! Auth::check()) {
            return;
        }

        $view = HistoryView::query()
            ->where('viewable_id', $id)
            ->where('viewable_type', $type)
            ->where('user_id', auth()->id())
            ->first();

        if (! $view) {
            HistoryView::query()->create([
                'viewable_id' => $id,
                'user_id' => auth()->id(),
                'viewable_type' => $type,
            ]);

            return;
        }

        $view->update([
            'updated_at' => now(),
        ]);
    }

    private function calculateGuest($id, $type)
    {
        if (Auth::check()) {
            return;
        }

        $guestViews = Cache::get('guest_views', []);

        $sessionKey = 'viewed_'.$type.'_'.$id;
        if (session()->has($sessionKey)) {
            return;
        }

        $guestViews[] = [
            'viewable_id' => $id,
            'viewable_type' => $type,
            'session_id' => session()->id(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now()->toDateTimeString(),
        ];
        Cache::put('guest_views', $guestViews, now()->addHours(2));

        session()->put($sessionKey, true);
    }
}
