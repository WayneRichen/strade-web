<?php

namespace App\Filament\Account\Pages;

use App\Models\ExchangeAccount;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Bot extends Page implements HasSchemas
{
    protected string $view = 'filament.account.pages.bot';

    use InteractsWithSchemas;

    protected static ?string $navigationLabel = 'Wizard Demo';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1：綁定 / 選擇交易所帳戶
                    Step::make('綁定帳戶')
                        ->description('選擇要使用的交易所帳戶')
                        ->schema([
                            Select::make('exchange_account_id')
                                ->label('交易所帳戶')
                                ->options(fn () => ExchangeAccount::query()
                                    ->where('user_id', Auth::id())
                                    ->pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->hint('先到「交易所帳戶」頁面新增再回來選')
                                ->helperText('這是 Bot 下單會用到的 API 帳戶'),

                            // Placeholder::make('exchange_account_info')
                            //     ->label('帳戶狀態')
                            //     ->content(function (Get $get) {
                            //         $id = $get('exchange_account_id');
                            //         if (! $id) {
                            //             return '請先選擇帳戶';
                            //         }

                            //         $account = ExchangeAccount::find($id);

                            //         if (! $account) {
                            //             return '帳戶不存在，請重新選擇';
                            //         }

                            //         return sprintf(
                            //             '交易所：%s、狀態：%s',
                            //             $account->exchange ?? '-',
                            //             $account->status ?? '-',
                            //         );
                            //     }),
                        ]),

                    Step::make('更多資訊')
                        ->schema([
                            Select::make('role')
                                ->label('角色')
                                ->options([
                                    'user' => '一般使用者',
                                    'admin' => '管理員',
                                ])
                                ->required(),

                            Textarea::make('note')
                                ->label('備註')
                                ->rows(3),
                        ]),
                ])
                // 有需要可以再加其他設定，例如 icon / description 等 :contentReference[oaicite:1]{index=1}
            ])
            ->statePath('data'); // 把表單 state 存到 $this->data
    }

    // 表單送出
    public function submit(): void
    {
        $data = $this->form->getState(); // 也跟官方建議一樣用 getState() 拿資料 :contentReference[oaicite:2]{index=2}

        // 這裡你可以改成真正的儲存，例如 Model::create($data);
        // 先用通知看資料長怎樣
        Notification::make()
            ->success()
            ->title('送出成功')
            ->body('收到資料：' . json_encode($data, JSON_UNESCAPED_UNICODE))
            ->send();

        // 送出後清空表單
        $this->form->fill();
    }
}
