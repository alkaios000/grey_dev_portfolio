<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioChannel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminChannelController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['sort_order'] = (int) PortfolioChannel::query()->max('sort_order') + 1;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('channels', 'public');
        }

        PortfolioChannel::query()->create($data);

        return redirect()
            ->route('admin.index', ['tab' => 'others'])
            ->with('status', "CHANNEL REGISTERED // {$data['title']} ditambahkan.");
    }

    public function update(Request $request, PortfolioChannel $channel): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->boolean('remove_image') && $channel->image_path) {
            Storage::disk('public')->delete($channel->image_path);
            $data['image_path'] = null;
        }

        if ($request->hasFile('image')) {
            if ($channel->image_path) {
                Storage::disk('public')->delete($channel->image_path);
            }
            $data['image_path'] = $request->file('image')->store('channels', 'public');
        }

        $channel->update($data);

        return redirect()
            ->route('admin.index', ['tab' => 'others'])
            ->with('status', "CHANNEL SYNCED // {$channel->title} diperbarui.");
    }

    public function destroy(PortfolioChannel $channel): RedirectResponse
    {
        $title = $channel->title;
        if ($channel->image_path) {
            Storage::disk('public')->delete($channel->image_path);
        }
        $channel->delete();

        return redirect()
            ->route('admin.index', ['tab' => 'others'])
            ->with('status', "CHANNEL PURGED // {$title} dihapus.");
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:40'],
            'title' => ['required', 'string', 'max:100'],
            'subtitle' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'action_label' => ['required', 'string', 'max:60'],
            'href' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:link,scroll,modal'],
            'target_section' => ['nullable', 'in:home,media,projects,connect'],
            'accent' => ['required', 'in:blue,cyan,emerald'],
            'image' => ['nullable', 'image', 'max:8192'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        return [
            'code' => strtoupper(trim($validated['code'])),
            'title' => strtoupper(trim($validated['title'])),
            'subtitle' => strtoupper(trim($validated['subtitle'])),
            'description' => trim($validated['description']),
            'action_label' => strtoupper(trim($validated['action_label'])),
            'href' => trim($validated['href']),
            'type' => $validated['type'],
            'target_section' => $validated['type'] === 'scroll' ? ($validated['target_section'] ?? 'projects') : null,
            'accent' => $validated['accent'],
            'is_published' => $request->boolean('is_published', true),
        ];
    }
}
