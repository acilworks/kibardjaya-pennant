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

    public ?array $announcement_texts = [];

    public function mount(): void
    {
        $texts = SiteSetting::get('announcement_texts', '[]');
        $this->announcement_texts = json_decode($texts, true) ?? [];
        
        // Migrate old setting if available
        if (empty($this->announcement_texts)) {
            $oldText = SiteSetting::get('announcement_text', '');
            if (!empty($oldText)) {
                $this->announcement_texts = [['text' => $oldText]];
            }
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Announcement Bar')
                    ->description('Teks yang tampil di bar atas halaman (otomatis berganti setiap 15 detik)')
                    ->schema([
                        Forms\Components\Repeater::make('announcement_texts')
                            ->label('Announcement Texts')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Text')
                                    ->maxLength(255)
                                    ->required(),
                            ])
                            ->addActionLabel('Add Announcement')
                            ->defaultItems(1),
                    ]),
            ]);
    }

    public function save(): void
    {
        SiteSetting::set('announcement_texts', json_encode($this->announcement_texts));

        Notification::make()
            ->title('Settings saved!')
            ->success()
            ->send();
    }
}
