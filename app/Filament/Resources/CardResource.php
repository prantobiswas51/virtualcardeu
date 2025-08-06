<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Card;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CardResource\Pages;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CardResource\RelationManagers;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')->maxLength(30)->unique()->visibleOn('create'),
                TextInput::make('expiry_date')->maxLength(10),
                Select::make('type')->options([
                    'Temporary Card' => 'Temporary Card',
                    'Reloadable Visa Card' => 'Reloadable Visa Card',
                ]),
                TextInput::make('cvc')->numeric()->maxLength(3),
                TextInput::make('user_id'),
                TextInput::make('amount')->numeric()->default(0),
                TextInput::make('status')->default('Inactive'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')->searchable(),
                TextColumn::make('expiry_date'),
                TextColumn::make('type')->searchable(),
                TextColumn::make('cvc'),
                TextColumn::make('amount'),
                TextColumn::make('status'),
                TextColumn::make('user.name')->label('Owner'),
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
                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->required(),

                        Select::make('type')
                            ->label('Transaction Type')
                            ->options([
                                'Credit' => 'Credit',
                                'Debit' => 'Debit',
                                'Refund' => 'Refund',
                            ])
                            ->required(),

                        TextInput::make('merchant')
                            ->label('Merchant')
                            ->required(),
                    ])
                    ->action(function (array $data, Card $record): void {
                        $amount = floatval($data['amount']);
                        $type = $data['type'];

                        if ($type === 'Debit') {
                            if ($record->amount < $amount) {
                                throw ValidationException::withMessages([
                                    'success' => 'Insufficient balance for debit transaction.',
                                ]);
                            }
                            $record->amount -= $amount;
                        } elseif ($type === 'Credit' || $type === 'Refund') {
                            $record->amount += $amount;
                        }

                        $record->save();

                        // Optional: you could also create a transaction log model here
                        Transaction::create([
                            'user_id' => $record->user_id,
                            'card_id' => $record->id,
                            'amount' => $amount,
                            'payment_method' => 'Card',
                            'type' => $type,
                            'status' => "Approved",
                            'payment_id' => Str::upper(Str::random(10)),
                            'merchant' => $data['merchant'],
                        ]);
                    })
                    ->modalHeading('Update Card Balance')
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
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
