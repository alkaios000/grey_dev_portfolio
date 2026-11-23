<?php

namespace App\Http\Controllers;

use App\Services\PortfolioContentService;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function __construct(private readonly PortfolioContentService $content) {}

    /**
     * Render the Grey_dev portfolio with live database-backed PGR tactical HUD data.
     */
    public function __invoke(): View
    {
        return view('portfolio', $this->content->getPublicData());
    }
}
