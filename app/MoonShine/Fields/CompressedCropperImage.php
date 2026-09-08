<?php

declare(strict_types=1);

namespace App\MoonShine\Fields;

use Illuminate\Support\Facades\Vite;
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Fields\Image;

class CompressedCropperImage extends Image
{
    protected string $view = 'admin.fields.compressed-cropper-image';

    protected string $accept = 'image/*';

    public function assets(): array
    {
        return [
            Css::make(Vite::asset('resources/css/admin/cropper.min.css')),
            Css::make(Vite::asset('resources/css/admin/moonshine-cropper.css')),
            Js::make(Vite::asset('resources/js/admin/cropper.min.js')),
            Js::make(Vite::asset('resources/js/admin/cropper-init.js')),
        ];
    }

    protected ?int $compressWidth = null;

    protected ?int $compressHeight = null;

    protected bool $keepAspectRatio = false;

    protected string $compressFormat = 'jpg';

    protected int $compressQuality = 80;

    protected ?int $thumbWidth = null;

    protected ?int $thumbHeight = null;

    public function width(int $width): static
    {
        $this->compressWidth = $width;

        return $this;
    }

    public function height(int $height): static
    {
        $this->compressHeight = $height;

        return $this;
    }

    public function aspectRatio(): static
    {
        $this->keepAspectRatio = true;

        return $this;
    }

    public function format(string $format): static
    {
        $this->compressFormat = $format;

        return $this;
    }

    public function quality(int $quality): static
    {
        $this->compressQuality = $quality;

        return $this;
    }

    public function thumb(int $width, int $height): static
    {
        $this->thumbWidth = $width;
        $this->thumbHeight = $height;

        return $this;
    }

    public function getCompressWidth(): ?int
    {
        return $this->compressWidth;
    }

    public function getCompressHeight(): ?int
    {
        return $this->compressHeight;
    }

    public function isKeepAspectRatio(): bool
    {
        return $this->keepAspectRatio;
    }

    public function getCompressFormat(): string
    {
        return $this->compressFormat;
    }

    public function getCompressQuality(): int
    {
        return $this->compressQuality;
    }

    public function getThumbWidth(): ?int
    {
        return $this->thumbWidth;
    }

    public function getThumbHeight(): ?int
    {
        return $this->thumbHeight;
    }

    public function hasThumb(): bool
    {
        return $this->thumbWidth !== null || $this->thumbHeight !== null;
    }

    protected function resolveAfterDestroy(mixed $data): mixed
    {
        $data = parent::resolveAfterDestroy($data);

        if ($this->hasThumb() && ! blank($this->toValue())) {
            $values = $this->isMultiple() ? $this->toValue() : [$this->toValue()];

            foreach ($values as $file) {
                $thumbFile = dirname($file).'/thumb_'.basename($file);
                $this->deleteStorageFile($thumbFile);
            }
        }

        return $data;
    }

    public function removeExcludedFiles(null|array|string $newValue = null): void
    {
        if ($this->hasThumb()) {
            $values = collect($this->toValue(withDefault: false));
            $remaining = $this->getRemainingValues();

            $values->diff($remaining)->each(function (?string $file) use ($newValue): void {
                $old = array_filter(\is_array($newValue) ? $newValue : [$newValue]);

                if ($file !== null && ! \in_array($file, $old, true)) {
                    $thumbFile = dirname($file).'/thumb_'.basename($file);
                    $this->deleteStorageFile($thumbFile);
                }
            });
        }

        parent::removeExcludedFiles($newValue);
    }
}
