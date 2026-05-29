<?php

namespace App\Filament\Resources\Portarias;

use App\Filament\Resources\Portarias\Pages;
use App\Models\Registro;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PortariaResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';

    public static function getNavigationLabel(): string
    {
        $role = Auth::user()?->role;

        if ($role === 'professor' || $role === 'docente') {
            return 'Histórico de Acessos';
        }

        return 'Portaria';
    }

    public static function shouldRegisterNavigation(): bool
    {
        $role = Auth::user()?->role;
        return in_array($role, ['diretoria', 'professor', 'docente']);
    }

    public static function canViewAny(): bool
    {
        $role = Auth::user()?->role;
        return in_array($role, ['diretoria', 'professor', 'docente']);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        if (in_array($user?->role, ['professor', 'docente'])) {
            return parent::getEloquentQuery()
                ->whereDate('data', Carbon::today())
                ->orderBy('id', 'desc');
        }

        return parent::getEloquentQuery()
            ->where('tipo', 'saida')
            ->whereRaw('(confirmado IS NULL OR confirmado = 0)')
            ->orderBy('id', 'desc');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('3s')
            ->columns([
                Grid::make(['default' => 1])
                    ->schema([
                        Stack::make([
                            TextColumn::make('nome_aluno')
                                ->size('lg')
                                ->weight('bold'),

                            TextColumn::make('matricula')
                                ->formatStateUsing(fn ($state) => "Matrícula: #{$state}")
                                ->color('gray'),

                            TextColumn::make('nome_diretora')
                                ->formatStateUsing(fn ($state) => "Autorizado por: " . ($state ?? 'Diretoria'))
                                ->color('gray')
                                ->weight('medium'),

                            TextColumn::make('hora')
                                ->formatStateUsing(fn ($state) => "Horário: " . ($state ?? 'Aguardando liberação'))
                                ->color('success')
                                ->weight('bold')
                                ->visible(fn () => Auth::user()?->role !== 'diretoria'),

                            TextColumn::make('tipo')
                                ->badge()
                                ->color(fn ($state): string => match ((string) $state) {
                                    'saida'   => 'danger',
                                    'entrada' => 'success',
                                    default   => 'gray',
                                })
                                ->formatStateUsing(fn ($state) => "Movimento: " . ucfirst($state)),
                        ])
                        ->space(2),
                    ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->actions([
                Action::make('confirmarSaida')
                    ->label('Confirmar Saída do Aluno')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->button()
                    ->requiresConfirmation()
                    ->modalHeading('Confirmar Liberação')
                    ->modalDescription('Você confirma que o aluno está cruzando o portão da portaria?')
                    ->visible(fn ($record) =>
                        Auth::user()?->role === 'diretoria' && !$record->confirmado
                    )
                    ->action(fn ($record) => $record->update([
                        'confirmado' => 1,
                        'hora'       => now()->format('H:i'),
                    ])),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortarias::route('/'),
        ];
    }
}