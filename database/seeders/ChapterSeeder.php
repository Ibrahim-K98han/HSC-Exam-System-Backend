<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    public function run(): void
    {
        $chapters = [
            'তথ্য ও যোগাযোগ প্রযুক্তি: বিশ্ব ও বাংলাদেশ প্রেক্ষিত',
            'কমিউনিকেশন সিস্টেমস ও কম্পিউটার নেটওয়ার্কিং',
            'সংখ্যা পদ্ধতি ও ডিজিটাল ডিভাইস',
            'ওয়েব ডিজাইন পরিচিতি ও HTML',
            'প্রোগ্রামিং ভাষা',
            'ডাটাবেজ ম্যানেজমেন্ট সিস্টেম',
        ];

        foreach ($chapters as $i => $name) {
            Chapter::create([
                'name' => $name,
                'sort_order' => $i + 1,
            ]);
        }
    }
}