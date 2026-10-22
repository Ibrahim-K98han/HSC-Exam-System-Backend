<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\JsonResponse;

class ChapterController extends Controller
{
    public function index(): JsonResponse
    {
        $chapters = Chapter::query()
            ->withCount([
                'questions as questions_count' => fn ($q) => $q->where('status', 'published'),
            ])
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'exam' => $c->exam,
                'subject' => $c->subject,
                'name' => $c->name,
                'sort_order' => $c->sort_order,
                'questions_count' => $c->questions_count,
            ]);

        return response()->json(['data' => $chapters], 200, [], JSON_UNESCAPED_UNICODE);
    }
}