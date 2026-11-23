<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;

class AdminMessageController extends Controller
{
    public function toggleRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => ! $message->is_read]);

        return redirect()
            ->route('admin.index', ['tab' => 'others'])
            ->with('status', $message->is_read ? 'TRANSMISSION MARKED READ.' : 'TRANSMISSION MARKED UNREAD.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.index', ['tab' => 'others'])
            ->with('status', 'TRANSMISSION PURGED // Pesan telah dihapus.');
    }
}
