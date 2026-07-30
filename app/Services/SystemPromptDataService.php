<?php

namespace App\Services;

use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SystemPromptDataService
{
    protected const array restaurantValuableFieldNames = [
        'name',
        'description',
        'address',
        'district',
        'latitude',
        'longitude',
        'worktime',
        'phone',
        'kitchen',
        'email',
        'website',
        'price_category',
        'capacity',
        'rating',
        'reviews_count',
        'views_count',
        'created_at',
        'updated_at',
    ];

    protected const array hotelValuableFieldNames = [
        'name',
        'description',
        'second_description',
        'type',
        'stars',
        'worktime',
        'phone',
        'address',
        'district',
        'latitude',
        'longitude',
        'email',
        'website',
        'max_price',
        'min_price',
        'reviews_count',
        'views_count',
    ];

    protected const array excursionValuableFieldNames = [
        'name',
        'description',
        'type',
        'duration',
        'distance',
        'difficulty',
        'group_size_min',
        'group_size_max',
        'price_adult',
        'price_child',
        'price_group',
        'is_free',
        'age_restriction',
        'meeting_point',
        'meeting_address',
        'schedule_type',
        'rating',
        'views_count',
        'status',
    ];

    protected const array attractionValuableFieldNames = [
        'name',
        'short_description',
        'description',
        'worktime',
        'phone',
        'address',
        'district',
        'latitude',
        'longitude',
        'email',
        'website',
        'status',
        'ticket_price',
        'visit_duration',
        'is_accessible',
        'has_parking',
        'views_count',
    ];

    protected const string databaseHotelsCacheKey = 'database-hotels-entries';

    protected const string databaseAttractionsCacheKey = 'database-attractions-entries';

    protected const string databaseExcursionsCacheKey = 'database-excursions-entries';

    protected const string databaseRestaurantsCacheKey = 'database-restaurants-entries';

    public function __construct(
        protected int $databaseEntriesTtl
    ) {}

    /**
     * @return Collection<Hotel>
     */
    public function fetchHotels(): iterable
    {
        return Cache::remember(self::databaseHotelsCacheKey, $this->databaseEntriesTtl, static function () {
            return Hotel::query()->select(self::hotelValuableFieldNames)->get();
        });
    }

    /**
     * @return Collection<Attraction>
     */
    public function fetchAttractions(): iterable
    {
        return Cache::remember(self::databaseAttractionsCacheKey, $this->databaseEntriesTtl, static function () {
            return Attraction::query()->select(self::attractionValuableFieldNames)->get();
        });

    }

    /**
     * @return Collection<Restaurant>
     */
    public function fetchRestaurants(): iterable
    {
        return Cache::remember(self::databaseRestaurantsCacheKey, $this->databaseEntriesTtl, static function () {
            return Restaurant::query()->select(self::restaurantValuableFieldNames)->get();
        });
    }

    /**
     * @return Collection<Excursion>
     */
    public function fetchExcursions(): iterable
    {
        return Cache::remember(self::databaseExcursionsCacheKey, $this->databaseEntriesTtl, static function () {
            return Excursion::query()->select(self::excursionValuableFieldNames)->get();
        });
    }

    public function resetCachedHotels()
    {
        Cache::forget(self::databaseHotelsCacheKey);
    }

    public function resetCachedRestaurants()
    {
        Cache::forget(self::databaseRestaurantsCacheKey);
    }

    public function resetCachedAttractions()
    {
        Cache::forget(self::databaseAttractionsCacheKey);
    }

    public function resetCachedExcursions()
    {
        Cache::forget(self::databaseExcursionsCacheKey);
    }
}
