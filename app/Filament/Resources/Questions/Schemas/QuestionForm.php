<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    Select::make('chapter_id')
    ->label('অধ্যায়')
    ->relationship('chapter', 'name')
    ->searchable()
    ->preload()
    ->required(),

Textarea::make('question')
    ->label('প্রশ্ন')
    ->required()
    ->rows(3)
    ->columnSpanFull(),

TextInput::make('option_a')->label('অপশন A')->required(),
TextInput::make('option_b')->label('অপশন B')->required(),
TextInput::make('option_c')->label('অপশন C')->required(),
TextInput::make('option_d')->label('অপশন D')->required(),

Select::make('correct_index')
    ->label('সঠিক উত্তর')
    ->options([0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D'])
    ->required(),

Textarea::make('explanation')
    ->label('ব্যাখ্যা')
    ->rows(3)
    ->columnSpanFull(),

Select::make('difficulty')
    ->label('কঠিনতা')
    ->options(['easy' => 'সহজ', 'medium' => 'মাঝারি', 'hard' => 'কঠিন'])
    ->default('medium')
    ->required(),

Select::make('status')
    ->label('অবস্থা')
    ->options(['draft' => 'ড্রাফট', 'published' => 'প্রকাশিত'])
    ->default('draft')
    ->required()
            ]);
    }
}
