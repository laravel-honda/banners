<?php

use Honda\Banner\Photograph;

Route::prefix('/_/og/')->group(function () {
    Route::get('render', fn () => new Photograph())->name('og.render');

    Route::get('generate', function (Illuminate\Http\Request $request) {
        ['payload' => $payload] = $request->validate([
            'payload' => 'required|string',
        ]);

        return view(config('banners.view'), json_decode($payload, true));
    })->name('og.generate');
});
