<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

function art_svg(string $type): void
{
    echo '<svg class="art" viewBox="0 0 160 110" aria-hidden="true">';
    switch ($type) {
        case 'erp':
            echo '<rect x="16" y="12" width="128" height="74" rx="8" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<rect x="24" y="22" width="50" height="6" rx="2" fill="currentColor"/>';
            echo '<rect x="24" y="36" width="112" height="8" rx="2" fill="currentColor" opacity=".15"/>';
            echo '<rect x="24" y="50" width="112" height="8" rx="2" fill="currentColor" opacity=".28"/>';
            echo '<rect x="24" y="64" width="112" height="8" rx="2" fill="currentColor" opacity=".15"/>';
            echo '<path d="M62 98h36" stroke="#d5d8e0" stroke-width="4" stroke-linecap="round"/>';
            break;
        case 'map':
            echo '<rect x="18" y="14" width="124" height="82" rx="12" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<path d="M36 72c18-28 28-8 42-24 10-12 22-6 40-20" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>';
            echo '<circle cx="40" cy="68" r="5" fill="currentColor"/>';
            echo '<circle cx="78" cy="48" r="5" fill="currentColor"/>';
            echo '<circle cx="116" cy="30" r="5" fill="currentColor"/>';
            break;
        case 'portal':
            echo '<rect x="18" y="16" width="124" height="78" rx="8" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<rect x="18" y="16" width="124" height="16" rx="8" fill="currentColor"/>';
            echo '<rect x="18" y="26" width="124" height="8" fill="currentColor"/>';
            echo '<circle cx="30" cy="24" r="2.2" fill="#fff"/>';
            echo '<circle cx="38" cy="24" r="2.2" fill="#fff" opacity=".7"/>';
            echo '<rect x="30" y="44" width="72" height="7" rx="2" fill="currentColor" opacity=".2"/>';
            echo '<rect x="30" y="58" width="88" height="7" rx="2" fill="currentColor" opacity=".35"/>';
            echo '<rect x="30" y="72" width="60" height="7" rx="2" fill="currentColor" opacity=".2"/>';
            echo '<path d="M126 70l6 6 12-14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>';
            break;
        case 'phone':
            echo '<rect x="58" y="8" width="44" height="90" rx="10" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<rect x="64" y="20" width="32" height="8" rx="2" fill="currentColor"/>';
            echo '<rect x="64" y="34" width="32" height="6" rx="2" fill="currentColor" opacity=".25"/>';
            echo '<rect x="64" y="46" width="32" height="6" rx="2" fill="currentColor" opacity=".45"/>';
            echo '<rect x="64" y="58" width="24" height="6" rx="2" fill="currentColor" opacity=".25"/>';
            echo '<circle cx="80" cy="86" r="3" fill="currentColor"/>';
            break;
        case 'scan':
            echo '<rect x="56" y="8" width="48" height="90" rx="10" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<path d="M66 28h8M86 28h8M66 28v8M94 28v8M66 62h8M86 62h8M66 70v-8M94 70v-8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>';
            echo '<path d="M70 46h20M74 50h12M70 54h20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>';
            break;
        case 'finance':
            echo '<rect x="56" y="8" width="48" height="90" rx="10" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<path d="M68 64l8-12 8 6 12-18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>';
            echo '<path d="M68 72h28" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity=".4"/>';
            break;
        default:
            echo '<rect x="16" y="14" width="128" height="72" rx="8" fill="#fff" stroke="currentColor" stroke-width="2"/>';
            echo '<rect x="24" y="24" width="28" height="40" rx="3" fill="currentColor" opacity=".35"/>';
            echo '<rect x="58" y="24" width="34" height="16" rx="3" fill="currentColor"/>';
            echo '<rect x="98" y="24" width="34" height="16" rx="3" fill="currentColor" opacity=".7"/>';
            echo '<rect x="58" y="46" width="74" height="18" rx="3" fill="currentColor" opacity=".25"/>';
            echo '<path d="M62 100h36" stroke="#d5d8e0" stroke-width="4" stroke-linecap="round"/>';
            break;
    }
    echo '</svg>';
}
