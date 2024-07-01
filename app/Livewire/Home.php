<?php

namespace App\Livewire;

use App\Mail\MailSender;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Home extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Recipient Email')
                    ->email()
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                \Filament\Forms\Components\RichEditor::make('body'),
            ])
            ->statePath('data');
    }

    public function send(): void
    {
        $data = $this->form->getState();
        try {

            Mail::to($data['email'])->send(new MailSender($data));

        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            Notification::make()
                ->title($message)
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title('Sent successfully')
            ->success()
            ->send();
        // dd();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
