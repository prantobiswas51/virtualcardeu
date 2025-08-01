<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Bank;
use App\Models\Card;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->searchable()
                    ->options(User::pluck('name', 'id')), // adjust as needed

                Select::make('card_id')
                    ->label('Card')
                    ->searchable()
                    ->options(Card::pluck('number', 'id')), // adjust as needed

                Select::make('bank_id')
                    ->label('Bank')
                    ->searchable()
                    ->options(Bank::pluck('bank_name', 'id')), // adjust as needed

                Select::make('payment_method')->options([
                    'Paypal' => 'Paypal',
                    'Payeer' => 'Payeer',
                    'Crypto' => 'Crypto',
                    'Bank' => 'Bank',
                    'Card' => 'Card',
                ]),
                TextInput::make('payment_id'),
                TextInput::make('amount')->numeric(),
                Select::make('status')->options([
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                    'Insufficient Balance' => 'Insufficient Balance',
                    'Canceled' => 'Canceled'
                ]),
                Select::make('type')->options([
                    'Debit' => 'Debit',
                    'Credit' => 'Credit',
                    'Topup' => 'Topup',
                    'Bank to Balance' => 'Bank to Balance',
                ]),
                TextInput::make('merchant')->label('Merchant (Ex-Amazon)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Owner'),
                TextColumn::make('card_id'),
                TextColumn::make('card.number')->label('Card Number'),
                TextColumn::make('bank_id'),
                TextColumn::make('payment_method'),
                TextColumn::make('amount'),
                TextColumn::make('status'),
                TextColumn::make('type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation() // Ask for confirmation before approving
                    ->modalHeading('Approve Transaction')
                    ->modalDescription('Are you sure you want to approve this transaction and update the bank balance?')
                    ->visible(fn(Transaction $record): bool => $record->status === 'Pending' && ($record->type === 'Incoming' || $record->type === 'Debit' || $record->type === 'Credit' || $record->type === 'Topup'))
                    ->action(function (Transaction $record) {
                        DB::beginTransaction();
                        try {
                            $previousStatus = $record->status;

                            // Update status after financial changes
                            $record->status = 'Approved';
                            $record->save();

                            // Only process if not already approved
                            if ($previousStatus !== 'Approved') {
                                // Incoming transaction
                                if ($record->type === 'Incoming' && $record->bank_id) {
                                    $bank = Bank::findOrFail($record->bank_id);
                                    $bank->bank_balance += $record->amount;
                                    $bank->save();

                                    $user = User::findOrFail($record->user_id);
                                    $user->balance += $record->amount;
                                    $user->save();
                                }

                                // Debit transaction
                                if ($record->type === 'Debit' && $previousStatus === 'Pending') {
                                    $card = Card::findOrFail($record->card_id);
                                    $card->amount -= $record->amount;
                                    $card->save();
                                }

                                // Debit transaction
                                if ($record->type === 'Topup' && $previousStatus === 'Pending') {
                                    $card = Card::findOrFail($record->card_id);
                                    $card->amount += $record->amount;
                                    $card->save();
                                }

                                // Credit transaction
                                if ($record->type === 'Credit' && $previousStatus === 'Pending') {
                                    $card = Card::findOrFail($record->card_id);
                                    $card->amount += $record->amount;
                                    $card->save();
                                }
                            }

                            DB::commit();

                            Notification::make()
                                ->title('Transaction approved successfully!')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();

                            Notification::make()
                                ->title('Error approving transaction!')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),

            ])->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
