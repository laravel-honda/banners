<?php

namespace Honda\Banner;

use Illuminate\Contracts\Support\Responsable;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Photograph implements Responsable
{
    public function toResponse($request): StreamedResponse
    {
        return $this->shoot();
    }

    public function shoot(): StreamedResponse
    {
        return new StreamedResponse(fn () => print $this->takeScreenshot(), 200, [
            'Content-Type' => 'image/png',
        ]);
    }

    protected function takeScreenshot(): string
    {
        $photograph = Browsershot::url(
        // request()->all() might seem dangerous at first. It's not.
            route('og.generate', ['payload' => json_encode(app('request')->all())])
        );

        return $this->prepareShooting($photograph)->screenshot();
    }

    protected function prepareShooting(Browsershot $photograph): Browsershot
    {
        transform(config('banners.node'), fn ($node) => $photograph->setNodeBinary($node));
        transform(config('banners.npm'), fn ($npm) => $photograph->setNpmBinary($npm));
        transform(config('banners.node_modules'), fn ($modules) => $photograph->setNodeModulePath($modules));

        return $photograph->addChromiumArguments(app()->environment('local') ? [
            'ignore-certificate-errors',
        ] : [])
            ->disableJavascript()
            ->waitUntilNetworkIdle()
            ->windowSize(config('banners.width'), config('banners.height'))
            ->fullPage();
    }
}
