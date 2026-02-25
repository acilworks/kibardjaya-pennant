<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Services\MidtransService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sync_all_pending')
                ->label('Sync All Pending')
                ->icon('heroicon-o-arrow-path')
                ->color('info')
                ->requiresConfirmation()
                ->modalHeading('Sync All Pending Orders')
                ->modalDescription('Cek status pembayaran semua order pending dari Midtrans?')
                ->modalSubmitActionLabel('Sync All')
                ->action(function () {
                    $pendingOrders = Order::where('payment_status', 'pending')->get();

                    if ($pendingOrders->isEmpty()) {
                        Notification::make()
                            ->title('Tidak ada order pending')
                            ->info()
                            ->send();
                        return;
                    }

                    $midtrans = app(MidtransService::class);
                    $updated = 0;
                    $failed = 0;

                    foreach ($pendingOrders as $order) {
                        try {
                            $status = $midtrans->getTransactionStatus($order->order_number);
                            $previousStatus = $order->payment_status;

                            $newStatus = match ($status->transaction_status) {
                                'settlement', 'capture' => 'paid',
                                'pending' => 'pending',
                                'expire' => 'expired',
                                'cancel', 'deny' => 'failed',
                                default => $order->payment_status,
                            };

                            if ($newStatus !== $previousStatus) {
                                $order->update(['payment_status' => $newStatus]);
                                $updated++;

                                // Kirim email jika berubah ke paid
                                if ($newStatus === 'paid') {
                                    try {
                                        \Illuminate\Support\Facades\Mail::to($order->customer_email)
                                            ->send(new \App\Mail\OrderInvoiceMail($order));
                                    } catch (\Exception $mailError) {
                                        // Email gagal, tapi sync tetap berhasil
                                    }
                                }
                            }
                        } catch (\Exception $e) {
                            $failed++;
                        }
                    }

                    Notification::make()
                        ->title('Sync Selesai')
                        ->body("Total: {$pendingOrders->count()} | Updated: {$updated} | Gagal: {$failed}")
                        ->success()
                        ->send();
                }),
            Actions\CreateAction::make(),
        ];
    }
}
