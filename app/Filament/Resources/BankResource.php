<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Bank;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BankResource\Pages;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BankResource\RelationManagers;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('bank_name')->required(),
                Select::make('bank_location')->options([
                    'USA' => 'USA',
                    'England' => 'England',
                    'Japan' => 'Japan'
                ])->required(),
                TextInput::make('bank_balance')->required(),
                TextInput::make('bank_account_number')->required(),
                Select::make('account_type')->options([
                    'Checking' => 'Checking',
                    // 'Savings' => 'Savings'
                ])->required(),
                Select::make('currency')->options([
                    'USD' => 'USD',
                    'GBP' => 'GBP',
                    'EURO' => 'EURO'
                ])->required(),
                TextInput::make('routing_number'),
                TextInput::make('routing_aba'),

                Select::make('transfer_type')->options([
                    'ACH' => 'ACH',
                    'Local Transfer' => 'Local Transfer'
                ]),
                TextInput::make('account_holder_name'),
                TextInput::make('bic'),
                TextInput::make('iban'),
                TextInput::make('bank_address'),
                TextInput::make('bank_short_code'),
                Select::make('status')->options([
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                    'Expired' => 'Expired',
                ])->default('Inactive'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bank_name'),
                TextColumn::make('bank_location'),
                TextColumn::make('account_type'),
                TextColumn::make('bank_account_number')->label('Bank Number'),
                TextColumn::make('status'),
                TextColumn::make('registered_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('update_balance')
                    ->label('Update Balance')
                    ->icon('heroicon-o-banknotes')
                    ->form([
                        TextInput::make('bank_balance')
                            ->label('Amount')
                            ->numeric()
                            ->required(),

                        Select::make('type')
                            ->label('Transaction Type')
                            ->options([
                                'Incoming' => 'Incoming',
                                'Outgoing' => 'Outgoing'
                            ])
                            ->required(),

                        TextInput::make('merchant')
                            ->label('Merchant')
                            ->required(),
                    ])
                    ->action(function (array $data, Bank $record): void {
                        $amount = floatval($data['bank_balance']);
                        $type = $data['type'];

                        if ($type === 'Outgoing') {
                            if ($record->bank_balance < $amount) {
                                Notification::make()
                                    ->title('Insufficient Balance')
                                    ->body('This bank does not have enough funds for the debit transaction.')
                                    ->danger()
                                    ->persistent() // optional: keeps the notification until manually dismissed
                                    ->send();

                                return; // Stop further execution
                            }
                            $record->bank_balance -= $amount;
                        } elseif ($type === 'Incoming') {
                            $record->bank_balance += $amount;
                        }

                        $record->save();

                        Transaction::create([
                            'user_id' => $record->user_id,
                            'bank_id' => $record->id,
                            'amount' => $amount,
                            'payment_method' => 'Bank',
                            'type' => $type,
                            'status' => "Approved",
                            'payment_id' => Str::upper(Str::random(10)),
                            'merchant' => $data['merchant'],
                        ]);

                        Notification::make()
                            ->title('Task Complete Successfully')
                            ->body('This bank balance has been updated successfully')
                            ->success()
                            ->persistent()
                            ->send();
                    })
                    ->modalHeading('Update Bank Balance')
                    ->modalSubmitActionLabel('Apply')
                    ->requiresConfirmation(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}
