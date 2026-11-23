<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioTool;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminToolController extends Controller
{
    private const ACCENT_HEX_MAP = [
        'cyan' => '#0ea5e9',
        'blue' => '#3b82f6',
        'amber' => '#6366f1',
        'violet' => '#2563eb',
    ];

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['sort_order'] = (int) PortfolioTool::query()->max('sort_order') + 1;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('tools', 'public');
        }

        PortfolioTool::query()->create($data);

        return redirect()
            ->route('admin.index', ['tab' => 'tools'])
            ->with('status', "TOOL REGISTERED // {$data['title']} ditambahkan.");
    }

    public function update(Request $request, PortfolioTool $tool): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->boolean('remove_image') && $tool->image_path) {
            Storage::disk('public')->delete($tool->image_path);
            $data['image_path'] = null;
        }

        if ($request->hasFile('image')) {
            if ($tool->image_path) {
                Storage::disk('public')->delete($tool->image_path);
            }
            $data['image_path'] = $request->file('image')->store('tools', 'public');
        }

        $tool->update($data);

        return redirect()
            ->route('admin.index', ['tab' => 'tools'])
            ->with('status', "TOOL SYNCED // {$tool->title} diperbarui.");
    }

    public function destroy(PortfolioTool $tool): RedirectResponse
    {
        $title = $tool->title;
        if ($tool->image_path) {
            Storage::disk('public')->delete($tool->image_path);
        }
        $tool->delete();

        return redirect()
            ->route('admin.index', ['tab' => 'tools'])
            ->with('status', "TOOL PURGED // {$title} dihapus.");
    }

    public function move(Request $request, PortfolioTool $tool): RedirectResponse
    {
        $direction = $request->input('direction') === 'up' ? 'up' : 'down';
        $items = PortfolioTool::query()->orderBy('sort_order')->orderBy('id')->get()->values();

        $idx = $items->search(fn (PortfolioTool $t) => $t->id === $tool->id);
        if ($idx !== false) {
            $targetIdx = $direction === 'up' ? $idx - 1 : $idx + 1;
            if (isset($items[$targetIdx])) {
                $swap = $items[$targetIdx];
                $items[$targetIdx] = $tool;
                $items[$idx] = $swap;

                foreach ($items as $order => $item) {
                    $item->update(['sort_order' => $order + 1]);
                }
            }
        }

        return redirect()
            ->route('admin.index', ['tab' => 'tools'])
            ->with('status', 'ORDER UPDATED // Urutan carousel TOOLS diperbarui.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:40'],
            'version' => ['required', 'string', 'max:40'],
            'title' => ['required', 'string', 'max:160'],
            'badge' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'faction' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:100'],
            'accent' => ['required', 'in:cyan,blue,amber,violet'],
            'description' => ['required', 'string', 'max:1500'],
            'highlights_raw' => ['nullable', 'string', 'max:1500'],
            'stack_raw' => ['required', 'string', 'max:500'],
            'metric_labels' => ['nullable', 'array'],
            'metric_labels.*' => ['nullable', 'string', 'max:40'],
            'metric_values' => ['nullable', 'array'],
            'metric_values.*' => ['nullable', 'integer', 'min:0', 'max:100'],
            'image' => ['nullable', 'image', 'max:8192'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $highlights = collect(preg_split('/\r?\n/', (string) ($validated['highlights_raw'] ?? '')))
            ->map(fn ($line) => trim((string) $line))
            ->filter()
            ->values()
            ->all();

        $stack = collect(preg_split('/[\r\n,]+/', (string) $validated['stack_raw']))
            ->map(fn ($s) => trim((string) $s))
            ->filter()
            ->values()
            ->all();

        $metrics = [];
        $labels = $validated['metric_labels'] ?? [];
        $values = $validated['metric_values'] ?? [];
        for ($i = 0; $i < 3; $i++) {
            $lbl = strtoupper(trim((string) ($labels[$i] ?? '')));
            if ($lbl !== '') {
                $metrics[] = [
                    'label' => $lbl,
                    'value' => max(0, min(100, (int) ($values[$i] ?? 90))),
                ];
            }
        }
        if (count($metrics) === 0) {
            $metrics = [
                ['label' => 'ARCHITECTURE', 'value' => 94],
                ['label' => 'PERFORMANCE', 'value' => 92],
                ['label' => 'RELIABILITY', 'value' => 95],
            ];
        }

        return [
            'code' => strtoupper(trim($validated['code'])),
            'version' => strtoupper(trim($validated['version'])),
            'title' => strtoupper(trim($validated['title'])),
            'badge' => trim($validated['badge']),
            'category' => strtoupper(trim($validated['category'])),
            'faction' => trim($validated['faction']),
            'type' => trim($validated['type']),
            'accent' => $validated['accent'],
            'accent_hex' => self::ACCENT_HEX_MAP[$validated['accent']] ?? '#3b82f6',
            'description' => trim($validated['description']),
            'highlights' => $highlights,
            'stack' => $stack,
            'metrics' => $metrics,
            'is_published' => $request->boolean('is_published', true),
        ];
    }
}
