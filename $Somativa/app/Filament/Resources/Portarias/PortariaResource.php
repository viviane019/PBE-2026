<?php

namespace App\Filament\Resources\Portarias;

use App\Enums\UserRole;
use App\Filament\Resources\Portarias\Pages;
use App\Models\Registro;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PortariaResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';

    public static function getNavigationLabel(): string
    {
        $role = Auth::user()?->role;

        if ($role === UserRole::Professor || $role === UserRole::Docente) {
            return 'Histórico de Acessos';
        }

        return 'Portaria';
    }

    public static function shouldRegisterNavigation(): bool
    {
        $role = Auth::user()?->role;
        return in_array($role, [UserRole::Diretoria, UserRole::Professor, UserRole::Docente]);
    }

    public static function canViewAny(): bool
    {
        $role = Auth::user()?->role;
        return in_array($role, [UserRole::Diretoria, UserRole::Professor, UserRole::Docente]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        if (in_array($user?->role, [UserRole::Professor, UserRole::Docente])) {
            return parent::getEloquentQuery()
                ->whereDate('data', Carbon::today())
                ->orderBy('id', 'desc');
        }

        return parent::getEloquentQuery()
            ->where('tipo', 'saida')
            ->where('confirmado', false)
            ->orderBy('id', 'desc');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s')
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
                                ->visible(fn () => Auth::user()?->role !== UserRole::Diretoria),

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
                        Auth::user()?->role === UserRole::Diretoria && !$record->confirmado
                    )
                    ->action(fn ($record) => $record->update([
                        'confirmado' => true,
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
