<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $request->validate(['updated_after' => ['nullable', 'date']]);

        $serverTime = now();

        if ($request->filled('updated_after')) {
            // সিঙ্ক: শেষ সিঙ্কের পর বদলানো প্রশ্ন (মুছে ফেলা ও ড্রাফটসহ)
            $query = Question::withTrashed()
                ->where('updated_at', '>=', Carbon::parse($request->query('updated_after')));
        } else {
            // প্রথমবার: শুধু প্রকাশিত প্রশ্ন
            $query = Question::query()->where('status', 'published');
        }

        $items = $query->orderBy('id')->get()->map(fn ($q) => [
            'id' => $q->id,
            'chapter_id' => $q->chapter_id,
            'question' => $q->question,
            'options' => [$q->option_a, $q->option_b, $q->option_c, $q->option_d],
            'correct_index' => $q->correct_index,
            'explanation' => $q->explanation,
            'difficulty' => $q->difficulty,
            'is_deleted' => $q->trashed() || $q->status !== 'published',
            'updated_at' => $q->updated_at->toIso8601String(),
        ]);

        return response()->json([
            'data' => $items,
            'server_time' => $serverTime->toIso8601String(),
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
