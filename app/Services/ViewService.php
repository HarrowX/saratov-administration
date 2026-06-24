<?php

namespace App\Services;

use App\Models\Attraction;
use App\Models\HistoryView;
use Illuminate\Support\Facades\Auth;

class ViewService
{

    public function calculate($id, $type)
    {
        if (Auth::check()) {

            $view = HistoryView::query()
                ->where('viewable_id', $id)
                ->where('viewable_type', $type)
                ->where('user_id', auth()->id())
                ->first();

            if (!$view) {
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

            return;
        }
    }
}
