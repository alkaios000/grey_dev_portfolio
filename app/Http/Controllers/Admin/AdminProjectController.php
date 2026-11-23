<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProjectController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $nextOrder = (int) PortfolioProject::query()->where('group', $data['group'])->max('sort_order') + 1;
        $data['sort_order'] = $nextOrder;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('projects', 'public');
        }

        PortfolioProject::query()->create($data);

        return redirect()
            ->route('admin.index', ['tab' => 'project'])
            ->with('status', "PROJECT REGISTERED // {$data['title']} ditambahkan ke {$data['group']}.");
    }

    public function update(Request $request, PortfolioProject $project): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->boolean('remove_image') && $project->image_path) {
            Storage::disk('public')->delete($project->image_path);
            $data['image_path'] = null;
        }

        if ($request->hasFile('image')) {
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $data['image_path'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()
            ->route('admin.index', ['tab' => 'project'])
            ->with('status', "PROJECT SYNCED // {$project->title} diperbarui.");
    }

    public function destroy(PortfolioProject $project): RedirectResponse
    {
        $title = $project->title;
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();

        return redirect()
            ->route('admin.index', ['tab' => 'project'])
            ->with('status', "PROJECT PURGED // {$title} dihapus dari arsip.");
    }

    public function move(Request $request, PortfolioProject $project): RedirectResponse
    {
        $direction = $request->input('direction') === 'up' ? 'up' : 'down';

        $siblings = PortfolioProject::query()
            ->where('group', $project->group)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->values();

        $idx = $siblings->search(fn (PortfolioProject $p) => $p->id === $project->id);
        if ($idx !== false) {
            $targetIdx = $direction === 'up' ? $idx - 1 : $idx + 1;
            if (isset($siblings[$targetIdx])) {
                $swap = $siblings[$targetIdx];
                $siblings[$targetIdx] = $project;
                $siblings[$idx] = $swap;

                foreach ($siblings as $order => $item) {
                    $item->update(['sort_order' => $order + 1]);
                }
            }
        }

        return redirect()
            ->route('admin.index', ['tab' => 'project'])
            ->with('status', 'ORDER UPDATED // Urutan tampilan project disinkronkan.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'group' => ['required', 'in:released,unreleased'],
            'code' => ['required', 'string', 'max:40'],
            'status_label' => ['required', 'string', 'max:60'],
            'version' => ['required', 'string', 'max:40'],
            'title' => ['required', 'string', 'max:160'],
            'category' => ['required', 'string', 'max:100'],
            'accent' => ['required', 'in:sky,blue,indigo,cyan'],
            'description' => ['nullable', 'string', 'max:1000'],
            'stack_raw' => ['required', 'string', 'max:500'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'max:8192'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $stack = collect(preg_split('/[\r\n,]+/', (string) $validated['stack_raw']))
            ->map(fn ($s) => trim((string) $s))
            ->filter()
            ->values()
            ->all();

        return [
            'group' => $validated['group'],
            'code' => strtoupper(trim($validated['code'])),
            'status_label' => strtoupper(trim($validated['status_label'])),
            'version' => trim($validated['version']),
            'title' => strtoupper(trim($validated['title'])),
            'category' => strtoupper(trim($validated['category'])),
            'accent' => $validated['accent'],
            'description' => $validated['description'] ?? '',
            'stack' => $stack,
            'project_url' => $validated['project_url'] ?? null,
            'is_published' => $request->boolean('is_published', true),
        ];
    }
}
