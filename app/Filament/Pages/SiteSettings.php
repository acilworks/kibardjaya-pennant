<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.site-settings';

    public ?string $announcement_text = '';

    public function mount(): void
    {
        $this->announcement_text = SiteSetting::get('announcement_text', '');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Announcement Bar')
                    ->description('Teks yang tampil di bar atas halaman')
                    ->schema([
                        Forms\Components\TextInput::make('announcement_text')
                            ->label('Announcement Text')
                            ->maxLength(255)
                            ->helperText('Contoh: Subscribe for 15% off your first order')
                            ->nullable(),
                    ]),
            ]);
    }

    public function save(): void
    {
        SiteSetting::set('announcement_text', $this->announcement_text);

        Notification::make()
            ->title('Settings saved!')
            ->success()
            ->send();
    }
}
