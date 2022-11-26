<?php

namespace Filament\Tests\Admin\Fixtures\Pages;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;

class PageActions extends Page
{
    protected static string $view = 'admin.fixtures.pages.actions';

    protected function getActions(): array
    {
        return [
            Action::make('simple')
                ->action(function () {
                    $this->emit('simple-called');
                }),
            Action::make('data')
                ->mountUsing(fn (ComponentContainer $form) => $form->fill(['foo' => 'bar']))
                ->form([
                    TextInput::make('payload')->required(),
                ])
                ->action(function (array $data) {
                    $this->emit('data-called', $data);
                }),
            Action::make('arguments')
                ->requiresConfirmation()
                ->action(function (array $arguments) {
                    $this->emit('arguments-called', $arguments);
                }),
            Action::make('halt')
                ->requiresConfirmation()
                ->action(function (Action $action) {
                    $this->emit('halt-called');

                    $action->halt();
                }),
            Action::make('visible'),
            Action::make('hidden')
                ->hidden(),
            Action::make('enabled'),
            Action::make('disabled')
                ->disabled(),
            Action::make('has-icon')
                ->icon('heroicon-s-pencil'),
            Action::make('has-label')
                ->label('My Action'),
            Action::make('has-color')
                ->color('primary'),
            Action::make('exists'),
            Action::make('url')
                ->url('https://filamentphp.com'),
            Action::make('url_in_new_tab')
                ->url('https://filamentphp.com', true),
            Action::make('url_not_in_new_tab')
                ->url('https://filamentphp.com', false),
        ];
    }
}
