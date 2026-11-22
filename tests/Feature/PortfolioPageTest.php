<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioPageTest extends TestCase
{
    public function test_portfolio_home_page_renders_grey_dev_and_tactical_sections(): void
    {
        $response = $this->get(route('portfolio.index'));

        $response->assertOk()
            ->assertViewIs('portfolio')
            ->assertSee('Grey_dev')
            ->assertSee('We Stand for Humanity')
            ->assertDontSee('Software Engineer')
            ->assertSee('ARTIFICIAL INTELLIGENCE')
            ->assertSee('PROJECT')
            ->assertSee('RELEASED')
            ->assertSee('UNRELEASED')
            ->assertSee('VIEW MORE')
            ->assertSee('pgr-project-stage')
            ->assertSee('data-diag-card', false)
            ->assertSee('TOOLS')
            ->assertSee('OTHERS')
            ->assertSee('TOOL DATA')
            ->assertSee('pgr-project-archive-view')
            ->assertSee('pgr-tool-detail-view')
            ->assertSee('pgr-carousel-stage')
            ->assertSee('data-parallax-layer', false)
            ->assertSee('data-slot="active"', false)
            ->assertSee('data-slot="next"', false)
            ->assertSee('data-slot="prev"', false)
            ->assertSee('https://github.com/alkaios000')
            ->assertSee('mailto:greymistbeta010@gmail.com')
            ->assertSee('https://wa.me/6285878523281')
            ->assertSee('https://www.instagram.com/ahmadnasuha62')
            ->assertSee('https://www.tiktok.com/@nasuhaaa_000')
            ->assertSee('data-theme-toggle', false)
            ->assertDontSee('DOMAINS')
            ->assertDontSee('EXPLORE PROJECTS')
            ->assertDontSee('id="section-updates"', false)
            ->assertDontSee('id="section-data"', false)
            ->assertDontSee('TRANSMIT')
            ->assertDontSee('https://github.com/Grey-dev')
            ->assertDontSee('#e62e39')
            ->assertDontSee('SYSTEM ONLINE // CONSTRUCT UNIT 01')
            ->assertDontSee('FULL-STACK UNIT')
            ->assertDontSee('PORTFOLIO // V1.0')
            ->assertDontSee('Membangun sistem web modern berbasis Laravel');
    }

    public function test_custom_cursor_svg_asset_exists_with_browser_safe_dimensions(): void
    {
        $cursorPath = resource_path('svg/cursor/cursor.svg');

        $this->assertFileExists($cursorPath);

        $svgContents = (string) file_get_contents($cursorPath);

        $this->assertMatchesRegularExpression('/width="(\d+)"/', $svgContents);
        $this->assertMatchesRegularExpression('/height="(\d+)"/', $svgContents);
    }
}
