<?php

namespace App\Schedulers;

use App\Models\HistoryView;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ViewAggregationScheduler
{
    public static function aggregate()
    {
        $guestViews = Cache::get('guest_views', []);

        if (empty($guestViews)) {
            return;
        }

        DB::transaction(function () use ($guestViews) {
            $groupedViews = collect($guestViews)->groupBy(function ($item) {
                return $item['viewable_type'] . '|' . $item['viewable_id'];
            });

            $groupedViews->each(function ($items, $key) {
                [$type, $id] = explode('|', $key);

                $model = $type::query()->whereId($id)->first();

                if ($model) {
                    $model->views_count += $items->count();
                    $model->save();
                }
            });

            Cache::forget('guest_views');
        });
    }

    public static function aggregateAuth()
    {
        HistoryView::query()
            ->where('is_counted', false)
            ->chunk(100, function ($views) {
                DB::transaction(function () use ($views) {
                    $viewableIds = [];

                    foreach ($views as $view) {
                        $key = get_class($view->viewable) . '|' . $view->viewable_id;
                        if (!isset($viewableIds[$key])) {
                            $viewableIds[$key] = 0;
                        }
                        $viewableIds[$key]++;
                    }

                    foreach ($viewableIds as $key => $count) {
                        [$type, $id] = explode('|', $key);

                        $model = $type::query()->whereId($id)->first();

                        if ($model) {
                            $model->views_count += $count;
                            $model->save();
                        }
                    }

                    HistoryView::query()
                        ->whereIn('id', $views->pluck('id'))
                        ->update(['is_counted' => true]);
                });
            });

    }
}
