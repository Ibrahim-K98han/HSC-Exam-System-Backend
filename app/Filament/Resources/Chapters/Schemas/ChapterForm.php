<?php

namespace App\Filament\Resources\Chapters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ChapterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('exam')
                    ->required()
                    ->default('HSC'),
                TextInput::make('subject')
                    ->required()
                    ->default('ICT'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
