<?php

use App\Livewire\Counter;
use Livewire\Livewire;

test('counter component can increment', function () {
    Livewire::test(Counter::class)
        ->assertSet('count', 0)
        ->call('increment')
        ->assertSet('count', 1);
});

test('counter component can decrement', function () {
    Livewire::test(Counter::class)
        ->assertSet('count', 0)
        ->call('decrement')
        ->assertSet('count', -1);
});

test('counter component renders successfully', function () {
    Livewire::test(Counter::class)
        ->assertSee('0')
        ->assertSee('+')
        ->assertSee('-');
});
