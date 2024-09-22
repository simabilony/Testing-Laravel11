<?php

//test('example', function () {
//    expect(true)->toBeTrue();
//});

use App\Services\CurrencyService;

test('convert usd to eur successful', function () {
    $convertedCurrency = (new CurrencyService())->convert(100, 'usd', 'eur');

    expect($convertedCurrency)
        ->toBeFloat()
        ->toEqual(98.0);
});

test('convert usd to gbp returns zero', function () {
    $convertedCurrency = (new CurrencyService())->convert(100, 'usd', 'gbp');

    expect($convertedCurrency)
        ->toBeFloat()
        ->toEqual(0.0);
});
