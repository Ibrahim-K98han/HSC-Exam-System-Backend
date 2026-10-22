<?php

namespace App\Filament\Imports;

use App\Models\Question;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class QuestionImporter extends Importer
{
    protected static ?string $model = Question::class;

    public static function getColumns(): array
{
    return [
        ImportColumn::make('chapter')
            ->label('chapter')
            ->requiredMapping()
            ->relationship(resolveUsing: 'name')
            ->rules(['required']),

        ImportColumn::make('question')
            ->requiredMapping()
            ->rules(['required']),

        ImportColumn::make('option_a')->requiredMapping()->rules(['required']),
        ImportColumn::make('option_b')->requiredMapping()->rules(['required']),
        ImportColumn::make('option_c')->requiredMapping()->rules(['required']),
        ImportColumn::make('option_d')->requiredMapping()->rules(['required']),

        ImportColumn::make('correct_index')
            ->label('correct')
            ->requiredMapping()
            ->castStateUsing(fn ($state) => ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3][strtoupper(trim((string) $state))] ?? null)
            ->rules(['required', 'integer', 'between:0,3']),

        ImportColumn::make('explanation'),

        ImportColumn::make('difficulty')
            ->castStateUsing(fn ($state) => in_array($state, ['easy', 'medium', 'hard']) ? $state : 'medium'),

        ImportColumn::make('status')
            ->castStateUsing(fn ($state) => in_array($state, ['draft', 'published']) ? $state : 'draft'),
    ];
}

    public function resolveRecord(): Question
    {
        return new Question();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your question import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
