<?php

use Filament\Tests\Admin\Fixtures\Pages\PageActions;
use Filament\Tests\Admin\Pages\TestCase;
use Illuminate\Support\Str;
use function Pest\Livewire\livewire;

uses(TestCase::class);

it('can call an action', function () {
    livewire(PageActions::class)
        ->callPageAction('simple')
        ->assertEmitted('simple-called');
});

it('can call an action with data', function () {
    livewire(PageActions::class)
        ->callPageAction('data', data: [
            'payload' => $payload = Str::random(),
        ])
        ->assertHasNoPageActionErrors()
        ->assertEmitted('data-called', [
            'payload' => $payload,
        ]);
});

it('can validate an action\'s data', function () {
    livewire(PageActions::class)
        ->callPageAction('data', data: [
            'payload' => null,
        ])
        ->assertHasPageActionErrors(['payload' => ['required']])
        ->assertNotEmitted('data-called');
});

it('can set default action data when mounted', function () {
    livewire(PageActions::class)
        ->mountPageAction('data')
        ->assertPageActionDataSet([
            'foo' => 'bar',
        ]);
});

it('can call an action with arguments', function () {
    livewire(PageActions::class)
        ->callPageAction('arguments', arguments: [
            'payload' => $payload = Str::random(),
        ])
        ->assertEmitted('arguments-called', [
            'payload' => $payload,
        ]);
});

it('can call an action and halt', function () {
    livewire(PageActions::class)
        ->callPageAction('halt')
        ->assertEmitted('halt-called')
        ->assertPageActionHalted('halt');
});

it('can hide an action', function () {
    livewire(PageActions::class)
        ->assertPageActionVisible('visible')
        ->assertPageActionHidden('hidden');
});

it('can disable an action', function () {
    livewire(PageActions::class)
        ->assertPageActionEnabled('enabled')
        ->assertPageActionDisabled('disabled');
});

it('can have an icon', function () {
    livewire(PageActions::class)
        ->assertPageActionHasIcon('has-icon', 'heroicon-s-pencil')
        ->assertPageActionDoesNotHaveIcon('has-icon', 'heroicon-o-trash');
});

it('can have a label', function () {
    livewire(PageActions::class)
        ->assertPageActionHasLabel('has-label', 'My Action')
        ->assertPageActionDoesNotHaveLabel('has-label', 'My Other Action');
});

it('can have a color', function () {
    livewire(PageActions::class)
        ->assertPageActionHasColor('has-color', 'primary')
        ->assertPageActionDoesNotHaveColor('has-color', 'secondary');
});

it('can have a URL', function () {
    livewire(PageActions::class)
        ->assertPageActionHasUrl('url', 'https://filamentphp.com')
        ->assertPageActionDoesNotHaveUrl('url', 'https://google.com');
});

it('can open a URL in a new tab', function () {
    livewire(PageActions::class)
        ->assertPageActionShouldOpenUrlInNewTab('url_in_new_tab')
        ->assertPageActionShouldNotOpenUrlInNewTab('url_not_in_new_tab');
});

it('can state whether a page action exists', function () {
    livewire(PageActions::class)
        ->assertPageActionExists('exists')
        ->assertPageActionDoesNotExist('does_not_exist');
});
