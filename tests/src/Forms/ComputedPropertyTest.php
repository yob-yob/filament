<?php

use Filament\Forms\Components\TextInput;
use Filament\Tests\Forms\Fixtures\Livewire;
use Filament\Tests\TestCase;
use Pest\Expectation;

uses(TestCase::class);

test('computed properties used to generate form schema can be accessed before caching forms', function () {
    expect(ComputedPropertySchema::make())
        ->getSchema()
        ->toBeArray()
        ->sequence(
            fn (Expectation $expect) => $expect->toBeInstanceOf(TextInput::class)
        );
});

class ComputedPropertySchema extends Livewire
{
    public function getFormSchema(): array
    {
        return $this->schema;
    }

    public function getSchemaProperty()
    {
        return [
            TextInput::make(''),
        ];
    }

    public function getSchema()
    {
        return $this->schema;
    }
}
