@extends('layouts')
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@4/dist/maplibre-gl.css" />
    <script src="https://unpkg.com/maplibre-gl@4/dist/maplibre-gl.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg: #08070f;
            --surface: #100e1c;
            --card: #141226;
            --card2: #100f20;
            --rim: rgba(255, 255, 255, 0.07);
            --rim2: rgba(255, 255, 255, 0.12);
            --accent: #38bdf8;
            --accent2: #7c3aed;
            --accent3: #f43f5e;
            --text: #f0eeff;
            --muted: #6b6585;
            --muted2: #9590b0;
            --red: #f43f5e;
            --green: #4ade80;
            --orange: #fb923c;
            --pink: #e879f9;
            --glow-lime: rgba(56, 189, 248, 0.18);
            --glow-purple: rgba(124, 58, 237, 0.25);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .modal.open {
            display: flex;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* NOISE GRAIN */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 999;
            opacity: .6;
        }

        /* ─── HERO ─── */
        .hero {
            position: relative;
            height: 100svh;
            min-height: 500px;
            max-height: 780px;
            overflow: hidden;
        }

        .hero__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(.38) saturate(1.5) hue-rotate(-10deg);
            transform: scale(1.06);
            animation: heroZoom 16s ease-out forwards;
        }

        @keyframes heroZoom {
            to {
                transform: scale(1);
            }
        }

        .hero__fallback {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a0a2e 0%, #0a1a2e 40%, #0e0d1f 100%);
            position: absolute;
            inset: 0;
        }

        .hero__fallback-glow {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 80% 30%, rgba(56, 189, 248, .12), transparent),
                radial-gradient(ellipse 40% 50% at 20% 50%, rgba(124, 58, 237, .2), transparent),
                radial-gradient(ellipse 50% 60% at 50% 80%, rgba(244, 63, 94, .1), transparent);
        }

        .hero__orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            animation: orbFloat 8s ease-in-out infinite;
        }

        .hero__orb--1 {
            width: 380px;
            height: 380px;
            background: var(--glow-purple);
            bottom: -60px;
            left: -80px;
            animation-delay: 0s;
        }

        .hero__orb--2 {
            width: 260px;
            height: 260px;
            background: var(--glow-lime);
            bottom: 80px;
            right: 10%;
            animation-delay: 3s;
            animation-direction: alternate-reverse;
        }

        @keyframes orbFloat {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.08);
            }
        }

        .hero__grad {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to right, rgba(8, 7, 15, .85) 0%, transparent 55%),
                linear-gradient(to top, rgba(8, 7, 15, 1) 0%, rgba(8, 7, 15, .5) 30%, transparent 65%);
        }

        .hero__content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 40px 32px;
            max-width: 680px;
        }

        .hero__back {
            position: fixed;
            top: 22px;
            left: 22px;
            z-index: 110;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid var(--rim2);
            background: rgba(8, 7, 15, .45);
            backdrop-filter: blur(8px);
            color: #fff;
            text-decoration: none;
            font-family: 'Space Mono', monospace;
            font-size: .66rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            transition: border-color .2s, background .2s, transform .2s;
        }

        .hero__back:hover {
            border-color: rgba(56, 189, 248, .45);
            background: rgba(56, 189, 248, .15);
            transform: translateY(-1px);
        }

        .hero__badge-row {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .hero__badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Space Mono', monospace;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid rgba(56, 189, 248, .35);
            color: var(--accent);
            background: rgba(56, 189, 248, .08);
        }

        .hero__badge-live {
            width: 7px;
            height: 7px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--accent);
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .3;
            }
        }

        .hero__badge-date {
            font-family: 'Space Mono', monospace;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid var(--rim2);
            color: var(--muted2);
            background: rgba(255, 255, 255, .04);
        }

        .hero__title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3.5rem, 13vw, 8rem);
            line-height: .9;
            letter-spacing: .04em;
            color: #fff;
            margin-bottom: 10px;
            text-shadow: 0 0 80px rgba(56, 189, 248, .12);
        }

        .hero__sub {
            font-size: clamp(.8rem, 2vw, 1rem);
            color: var(--muted2);
            font-weight: 400;
            letter-spacing: .02em;
            margin-bottom: 24px;
        }

        .hero__venue-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero__venue-icon {
            width: 32px;
            height: 32px;
            background: rgba(56, 189, 248, .12);
            border: 1px solid rgba(56, 189, 248, .25);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hero__venue-name {
            font-weight: 700;
            font-size: clamp(1.05rem, 2.5vw, 1.3rem);
            color: var(--text);
        }

        .hero__venue-link {
            font-size: .75rem;
            color: var(--accent);
            text-decoration: none;
            margin-top: 2px;
            display: block;
        }

        .hero__venue-link:hover {
            text-decoration: underline;
        }

        .hero__scroll-cue {
            position: absolute;
            bottom: 28px;
            right: 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            font-family: 'Space Mono', monospace;
            font-size: .58rem;
            letter-spacing: .12em;
            color: var(--muted);
            text-transform: uppercase;
            animation: scrollBounce 2s ease-in-out infinite;
        }

        @keyframes scrollBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(8px);
            }
        }

        /* ─── LAYOUT ─── */
        .wrap {
            padding: 0 20px 120px;
            max-width: 720px;
            margin: 0 auto;
        }

        .sec-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
            margin-top: 40px;
        }

        .sec-label {
            font-family: 'Space Mono', monospace;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted2);
            white-space: nowrap;
        }

        .sec-line {
            flex: 1;
            height: 1px;
            background: var(--rim);
        }

        /* ─── LINEUP ─── */
        .lineup-scroll {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            padding-bottom: 10px;
            scrollbar-width: none;
            margin: 0 -20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .lineup-scroll::-webkit-scrollbar {
            display: none;
        }

        .lineup-card {
            flex-shrink: 0;
            width: 148px;
            background: var(--card);
            border: 1px solid var(--rim);
            border-radius: 18px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            transition: transform .25s, border-color .25s, box-shadow .25s;
        }

        .lineup-card:hover {
            transform: translateY(-5px);
            border-color: rgba(56, 189, 248, .25);
            box-shadow: 0 16px 40px rgba(0, 0, 0, .4), 0 0 0 1px rgba(56, 189, 248, .1);
        }

        .lineup-card.featured {
            width: 172px;
            border-color: rgba(56, 189, 248, .2);
        }

        .lineup-card.featured::after {
            content: 'HEADLINER';
            position: absolute;
            top: 10px;
            left: 10px;
            font-family: 'Space Mono', monospace;
            font-size: .52rem;
            font-weight: 700;
            letter-spacing: .1em;
            padding: 4px 8px;
            background: var(--accent);
            color: #fff;
            border-radius: 6px;
        }

        .lineup-card__img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            display: block;
        }

        .lineup-card__img-placeholder {
            width: 100%;
            aspect-ratio: 1;
            background: linear-gradient(135deg, #1a1535, #0d0c1a);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lineup-card__body {
            padding: 12px 14px 14px;
        }

        .lineup-card__name {
            font-weight: 700;
            font-size: .88rem;
            color: #fff;
            margin-bottom: 3px;
            line-height: 1.2;
        }

        .lineup-card__role {
            font-size: .67rem;
            font-weight: 600;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .role--headliner {
            color: var(--accent);
        }

        .role--direct-support {
            color: var(--pink);
        }

        .role--opening-act {
            color: var(--orange);
        }

        .lineup-card__desc {
            font-size: .72rem;
            color: var(--muted);
            line-height: 1.5;
            margin-top: 6px;
        }

        /* ─── ABOUT ─── */
        .about-card {
            background: var(--card);
            border: 1px solid var(--rim);
            border-radius: 20px;
            padding: 24px;
        }

        .about-text {
            font-size: .9rem;
            line-height: 1.8;
            color: var(--muted2);
            font-weight: 400;
        }

        .about-text h1,
        .about-text h2,
        .about-text h3 {
            color: #fff;
            line-height: 1.25;
            margin: 1rem 0 .6rem;
            font-weight: 700;
        }

        .about-text h1 {
            font-size: 1.45rem;
        }

        .about-text h2 {
            font-size: 1.2rem;
        }

        .about-text h3 {
            font-size: 1.05rem;
        }

        .about-text p {
            margin: .65rem 0;
        }

        .about-text blockquote {
            border-left: 3px solid rgba(56, 189, 248, .65);
            padding: .2rem 0 .2rem .9rem;
            margin: .85rem 0;
            color: #c8c4dc;
            font-style: italic;
            background: rgba(56, 189, 248, .06);
            border-radius: 0 8px 8px 0;
        }

        .about-text ul,
        .about-text ol {
            margin: .7rem 0;
            padding-left: 1.35rem;
        }

        .about-text ul {
            list-style: disc;
        }

        .about-text ol {
            list-style: decimal;
        }

        .about-text li {
            margin: .25rem 0;
            line-height: 1.7;
        }

        .about-text a {
            color: var(--accent);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .show-more-btn {
            background: none;
            border: none;
            color: var(--accent);
            font-family: 'Outfit', sans-serif;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0;
            margin-top: 14px;
            letter-spacing: .02em;
        }

        .show-more-btn svg {
            transition: transform .2s;
        }

        .show-more-btn.open svg {
            transform: rotate(180deg);
        }

        .edit-toggle {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--accent);
            background: rgba(56, 189, 248, .08);
            border: 1px solid rgba(56, 189, 248, .25);
            border-radius: 8px;
            padding: 4px 12px;
            cursor: pointer;
            transition: all .2s;
            margin-left: auto;
        }

        .edit-toggle:hover {
            background: rgba(56, 189, 248, .15);
        }

        #editor-wrap {
            display: none;
            margin-top: 12px;
        }

        /* ── Quill toolbar ── */
        #editor-wrap .ql-toolbar.ql-snow {
            border: 1px solid var(--rim2);
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            background: #1a1535;
            padding: 8px 10px;
        }

        /* toolbar buttons */
        #editor-wrap .ql-toolbar.ql-snow .ql-formats {
            margin-right: 10px;
        }

        #editor-wrap .ql-toolbar button,
        #editor-wrap .ql-toolbar .ql-picker-label {
            color: var(--muted2) !important;
        }

        /* SVG strokes/fills inside toolbar icons */
        #editor-wrap .ql-toolbar .ql-stroke {
            stroke: var(--muted2) !important;
        }

        #editor-wrap .ql-toolbar .ql-fill {
            fill: var(--muted2) !important;
        }

        #editor-wrap .ql-toolbar .ql-thin {
            stroke: var(--muted2) !important;
        }

        /* hover */
        #editor-wrap .ql-toolbar button:hover .ql-stroke,
        #editor-wrap .ql-toolbar .ql-picker-label:hover .ql-stroke {
            stroke: var(--accent) !important;
        }

        #editor-wrap .ql-toolbar button:hover .ql-fill,
        #editor-wrap .ql-toolbar .ql-picker-label:hover .ql-fill {
            fill: var(--accent) !important;
        }

        #editor-wrap .ql-toolbar button:hover,
        #editor-wrap .ql-toolbar .ql-picker-label:hover {
            color: var(--accent) !important;
        }

        /* active/selected */
        #editor-wrap .ql-toolbar button.ql-active .ql-stroke,
        #editor-wrap .ql-toolbar .ql-picker-label.ql-active .ql-stroke,
        #editor-wrap .ql-toolbar .ql-picker-item.ql-selected .ql-stroke {
            stroke: var(--accent) !important;
        }

        #editor-wrap .ql-toolbar button.ql-active .ql-fill,
        #editor-wrap .ql-toolbar .ql-picker-label.ql-active .ql-fill {
            fill: var(--accent) !important;
        }

        #editor-wrap .ql-toolbar button.ql-active,
        #editor-wrap .ql-toolbar .ql-picker-label.ql-active {
            color: var(--accent) !important;
        }

        /* header dropdown */
        #editor-wrap .ql-toolbar .ql-picker-options {
            background: #1e1a38;
            border: 1px solid var(--rim2) !important;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .4);
        }

        #editor-wrap .ql-toolbar .ql-picker-item {
            color: var(--muted2) !important;
        }

        #editor-wrap .ql-toolbar .ql-picker-item:hover {
            color: var(--accent) !important;
            background: rgba(56, 189, 248, .06);
        }

        /* ── Quill editor area ── */
        #editor-wrap .ql-container.ql-snow {
            border: 1px solid var(--rim2);
            border-top: none;
            border-radius: 0 0 10px 10px;
            background: var(--card2);
            min-height: 120px;
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            font-size: .9rem;
        }

        #editor-wrap .ql-editor {
            min-height: 120px;
            padding: 14px 16px;
            line-height: 1.75;
        }

        #editor-wrap .ql-editor.ql-blank::before {
            color: var(--muted);
            font-style: normal;
            left: 16px;
        }

        /* links inside editor */
        #editor-wrap .ql-editor a {
            color: var(--accent);
        }

        /* tooltip/link input */
        #editor-wrap .ql-tooltip {
            background: #1e1a38 !important;
            border: 1px solid var(--rim2) !important;
            border-radius: 8px;
            color: var(--text) !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .4);
        }

        #editor-wrap .ql-tooltip input[type=text] {
            background: rgba(255, 255, 255, .06) !important;
            border: 1px solid var(--rim2) !important;
            border-radius: 6px;
            color: var(--text) !important;
            outline: none;
        }

        #editor-wrap .ql-tooltip a.ql-action,
        #editor-wrap .ql-tooltip a.ql-remove {
            color: var(--accent) !important;
        }

        /* ─── RULES ─── */
        .rules-card {
            background: rgba(56, 189, 248, .04);
            border: 1px solid rgba(56, 189, 248, .12);
            border-radius: 16px;
            padding: 20px 22px;
            margin-top: 14px;
        }

        .rules-card ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .rules-card li {
            font-size: .82rem;
            color: var(--muted2);
            padding-left: 20px;
            position: relative;
            line-height: 1.55;
        }

        .rules-card li::before {
            content: '—';
            position: absolute;
            left: 0;
            color: var(--accent);
            font-weight: 700;
        }

        /* ─── SEAT CHART ─── */
        .seat-chart-wrap {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: zoom-in;
            border: 1px solid var(--rim);
            transition: border-color .2s;
        }

        .seat-chart-wrap:hover {
            border-color: rgba(56, 189, 248, .25);
        }

        .seat-chart-wrap img {
            width: 100%;
            display: block;
            max-height: 260px;
            object-fit: cover;
            filter: brightness(.65) saturate(.8);
            transition: filter .3s;
        }

        .seat-chart-wrap:hover img {
            filter: brightness(.8) saturate(1);
        }

        .seat-chart-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(8, 7, 15, .2);
        }

        .seat-chart-label {
            background: rgba(8, 7, 15, .8);
            border: 1px solid rgba(255, 255, 255, .12);
            backdrop-filter: blur(10px);
            border-radius: 999px;
            padding: 10px 22px;
            font-size: .78rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: .06em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ─── TICKET CARDS ─── */
        .ticket-cards {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .tkt {
            position: relative;
            overflow: hidden;
            background: var(--card2);
            border: 1px solid var(--rim);
            border-radius: 22px;
            padding: 22px 24px;
            cursor: pointer;
            transition: border-color .25s, box-shadow .25s;
        }

        .tkt::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity .25s;
            background: linear-gradient(135deg, rgba(var(--tkt-rgb, 56, 189, 248), .05), transparent 60%);
            pointer-events: none;
        }

        .tkt:hover {
            border-color: rgba(var(--tkt-rgb, 56, 189, 248), .2);
        }

        .tkt:hover::before {
            opacity: 1;
        }

        .tkt.selected {
            border-color: rgba(var(--tkt-rgb, 56, 189, 248), .5);
            box-shadow: 0 0 0 1px rgba(var(--tkt-rgb, 56, 189, 248), .25), 0 8px 40px rgba(0, 0, 0, .4), inset 0 1px 0 rgba(var(--tkt-rgb, 56, 189, 248), .1);
        }

        .tkt.selected::before {
            opacity: 1;
        }

        .tkt.sold-out {
            opacity: 1;
            cursor: not-allowed;
        }

        .tkt__top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 6px;
        }

        .tkt__name {
            font-weight: 700;
            font-size: 1.05rem;
            color: #fff;
            letter-spacing: .01em;
        }

        .tkt__price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            line-height: 1;
            color: var(--accent);
            letter-spacing: .04em;
        }

        .tkt.sold-out .tkt__name {
            color: var(--muted) !important;
            text-decoration: line-through;
            text-decoration-thickness: 2px;
            text-decoration-color: rgba(255, 255, 255, .28);
        }

        .tkt.sold-out .tkt__price {
            color: var(--muted) !important;
            text-decoration: line-through;
            text-decoration-thickness: 2px;
            text-decoration-color: rgba(255, 255, 255, .28);
        }

        .tkt__currency {
            font-size: 1.1rem;
            vertical-align: top;
            margin-top: .25rem;
            display: inline-block;
        }

        .tkt__sub {
            font-size: .75rem;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .tkt__avail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            font-family: 'Space Mono', monospace;
        }

        .avail-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .avail-dot--red {
            background: var(--red);
            box-shadow: 0 0 7px var(--red);
        }

        .avail-dot--orange {
            background: var(--orange);
            box-shadow: 0 0 7px var(--orange);
        }

        .avail-dot--green {
            background: var(--green);
            box-shadow: 0 0 7px var(--green);
        }

        .avail-dot--gray {
            background: var(--muted);
        }

        .avail--red {
            color: var(--red);
        }

        .avail--orange {
            color: var(--orange);
        }

        .avail--green {
            color: var(--green);
        }

        .avail--gray {
            color: var(--muted);
        }

        .tkt.sold-out .tkt__avail {
            color: var(--red) !important;
        }

        .tkt.sold-out .avail-dot--gray {
            background: var(--red);
            box-shadow: 0 0 7px var(--red);
        }

        .tkt__divider {
            border: none;
            border-top: 1px dashed rgba(255, 255, 255, .07);
            margin: 14px 0;
        }

        .tkt__inclusions-label {
            font-family: 'Space Mono', monospace;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .tkt__perks {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .tkt__perk {
            font-size: .78rem;
            color: var(--muted2);
            line-height: 1.5;
        }

        .tkt__stepper-row {
            display: none;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--rim);
        }

        .tkt.selected .tkt__stepper-row {
            display: flex;
        }

        .tkt.sold-out .tkt__stepper-row {
            display: none;
        }

        .stepper-label {
            font-size: .65rem;
            color: var(--muted);
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-family: 'Space Mono', monospace;
        }

        .stepper-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stepper-btn {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 12px;
            font-size: 1.3rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
            font-weight: 700;
            line-height: 1;
        }

        .stepper-btn--minus {
            background: rgba(255, 255, 255, .08);
            color: #fff;
        }

        .stepper-btn--minus:hover {
            background: rgba(255, 255, 255, .15);
        }

        .stepper-btn--plus {
            background: var(--accent);
            color: #fff;
        }

        .stepper-btn--plus:hover {
            background: #0ea5e9;
            box-shadow: 0 0 16px rgba(56, 189, 248, .4);
        }

        .stepper-num {
            width: 40px;
            text-align: center;
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            font-family: 'Space Mono', monospace;
        }

        /* ─── BOTTOM BAR ─── */
        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(8, 7, 15, .95);
            backdrop-filter: blur(20px) saturate(1.5);
            border-top: 1px solid var(--rim2);
            padding: 16px 24px calc(env(safe-area-inset-bottom, 0px) + 16px);
            display: flex;
            align-items: center;
            gap: 16px;
            z-index: 100;
            transform: translateY(100%);
            transition: transform .35s cubic-bezier(.4, 0, .2, 1);
        }

        .bottom-bar.visible {
            transform: translateY(0);
        }

        .bottom-bar__info {
            flex: 1;
            min-width: 0;
        }

        .bottom-bar__total-label {
            font-size: .62rem;
            color: var(--muted);
            font-family: 'Space Mono', monospace;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .bottom-bar__total {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            color: #fff;
            line-height: 1;
            letter-spacing: .04em;
        }

        .bottom-bar__total-accent {
            color: var(--accent);
        }

        .buy-btn {
            flex-shrink: 0;
            padding: 14px 32px;
            background: var(--accent);
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.2rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all .2s;
            box-shadow: 0 4px 28px rgba(56, 189, 248, .3);
            white-space: nowrap;
        }

        .buy-btn:hover {
            background: #0ea5e9;
            transform: translateY(-2px);
            box-shadow: 0 8px 36px rgba(56, 189, 248, .45);
        }

        .buy-btn:active {
            transform: translateY(0);
        }

        /* ─── MODAL ─── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .85);
            backdrop-filter: blur(12px);
            z-index: 200;
            align-items: flex-end;
            justify-content: center;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--card);
            border: 1px solid var(--rim2);
            border-radius: 28px 28px 0 0;
            width: 100%;
            max-width: 600px;
            padding: 0 0 calc(env(safe-area-inset-bottom, 0px) + 28px);
            animation: slideUp .28s cubic-bezier(.4, 0, .2, 1);
            max-height: 92svh;
            overflow-y: auto;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal__handle {
            width: 44px;
            height: 4px;
            background: rgba(255, 255, 255, .12);
            border-radius: 99px;
            margin: 14px auto 0;
        }

        .modal__head {
            padding: 22px 28px;
            border-bottom: 1px solid var(--rim);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .modal__head-text h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: .06em;
            color: #fff;
            line-height: 1;
        }

        .modal__head-text p {
            font-size: .78rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .modal__close {
            background: rgba(255, 255, 255, .07);
            border: 1px solid var(--rim);
            border-radius: 10px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--muted);
            transition: all .2s;
            flex-shrink: 0;
        }

        .modal__close:hover {
            background: rgba(255, 255, 255, .12);
            color: #fff;
        }

        .modal__body {
            padding: 24px 28px 0;
        }

        .modal__event-card {
            background: linear-gradient(135deg, rgba(56, 189, 248, .07), rgba(124, 58, 237, .07));
            border: 1px solid rgba(56, 189, 248, .15);
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 20px;
        }

        .modal__event-name {
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            margin-bottom: 4px;
        }

        .modal__event-meta {
            font-size: .78rem;
            color: var(--muted2);
        }

        .modal__summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
        }

        .modal__stat {
            background: rgba(255, 255, 255, .04);
            border: 1px solid var(--rim);
            border-radius: 14px;
            padding: 14px 16px;
        }

        .modal__stat-label {
            font-size: .6rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .1em;
            font-family: 'Space Mono', monospace;
            margin-bottom: 4px;
        }

        .modal__stat-val {
            font-weight: 700;
            font-size: .95rem;
            color: #fff;
        }

        .modal__total-row {
            background: rgba(56, 189, 248, .07);
            border: 1px solid rgba(56, 189, 248, .2);
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal__total-label {
            font-size: .68rem;
            color: var(--muted2);
            text-transform: uppercase;
            letter-spacing: .1em;
            font-family: 'Space Mono', monospace;
        }

        .modal__total-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2rem;
            color: var(--accent);
            letter-spacing: .04em;
            line-height: 1;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 7px;
            font-family: 'Space Mono', monospace;
        }

        .form-group input {
            width: 100%;
            background: rgba(255, 255, 255, .05);
            border: 1px solid var(--rim2);
            border-radius: 12px;
            padding: 13px 16px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: .92rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input:focus {
            border-color: rgba(56, 189, 248, .4);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, .08);
        }

        .form-group input::placeholder {
            color: var(--muted);
        }

        .modal__cta {
            width: 100%;
            padding: 16px;
            background: var(--accent);
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            margin-top: 8px;
            transition: all .2s;
            box-shadow: 0 4px 24px rgba(56, 189, 248, .25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .modal__cta:hover {
            background: #0ea5e9;
            box-shadow: 0 8px 36px rgba(56, 189, 248, .4);
            transform: translateY(-1px);
        }

        .modal__note {
            text-align: center;
            font-size: .68rem;
            color: var(--muted);
            margin-top: 14px;
            padding-bottom: 4px;
        }

        /* ─── LIGHTBOX ─── */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .96);
            z-index: 300;
            align-items: center;
            justify-content: center;
            cursor: zoom-out;
            padding: 24px;
            animation: fadeIn .2s ease;
        }

        .lightbox.open {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .lightbox img {
            max-width: 100%;
            max-height: 90svh;
            border-radius: 16px;
            object-fit: contain;
        }

        /* ─── NOT FOUND ─── */
        .not-found {
            text-align: center;
            padding: 80px 20px;
            color: var(--muted);
        }

        .not-found h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            color: var(--red);
            margin: 16px 0 8px;
            letter-spacing: .05em;
        }

        /* ─── TWO-COLUMN DESKTOP/TABLET LAYOUT ─── */
        .two-col {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .col-left {
            width: 100%;
        }

        .col-right {
            width: 100%;
        }

        @media (min-width: 768px) {
            .wrap {
                max-width: 1160px;
                padding: 0 32px 120px;
            }

            .two-col {
                flex-direction: row;
                align-items: flex-start;
                gap: 32px;
            }

            /* About column: sticky so it stays visible while scrolling tickets */
            .col-left {
                flex: 1 1 0;
                min-width: 0;
                position: sticky;
                top: 24px;
                align-self: flex-start;
            }

            /* Seating + tickets column */
            .col-right {
                flex: 1 1 0;
                min-width: 0;
            }
        }

        /* ─── ENTRANCE ANIMATIONS ─── */
        .fade-up {
            opacity: 0;
            transform: translateY(22px);
            animation: fadeUp .55s ease forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up:nth-child(1) {
            animation-delay: .05s;
        }

        .fade-up:nth-child(2) {
            animation-delay: .10s;
        }

        .fade-up:nth-child(3) {
            animation-delay: .15s;
        }

        .fade-up:nth-child(4) {
            animation-delay: .20s;
        }

        .fade-up:nth-child(5) {
            animation-delay: .25s;
        }

        /* ─── RESPONSIVE (mobile overrides) ─── */
        @media (max-width: 480px) {
            .hero__back {
                top: 16px;
                left: 16px;
            }

            .hero__content {
                padding: 28px 20px;
            }

            .hero__title {
                font-size: clamp(3rem, 18vw, 4.5rem);
            }

            .wrap {
                padding: 0 16px 120px;
            }

            .tkt {
                padding: 18px;
            }

            .buy-btn {
                padding: 13px 20px;
                font-size: 1rem;
            }

            .bottom-bar {
                padding: 14px 16px 20px;
            }

            .modal {
                border-radius: 22px 22px 0 0;
            }

            .modal__body {
                padding: 20px 20px 0;
            }

            .modal__head {
                padding: 18px 20px;
            }

            .modal__summary-grid {
                grid-template-columns: 1fr 1fr;
            }

            .hero__scroll-cue {
                display: none;
            }

            .lineup-card {
                width: 136px;
            }

            .lineup-card.featured {
                width: 158px;
            }

            .sec-head {
                margin-top: 32px;
            }
        }

        @media (min-width: 700px) {
            .hero__content {
                padding: 60px 48px;
            }

            .bottom-bar {
                padding: 18px 32px 22px;
            }
        }
    </style>

    @if (isset($event))

        {{-- ─── HERO ─── --}}
        <div class="hero">
            <a class="hero__back" href="{{ route('public') }}" aria-label="Go back">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Back</span>
            </a>

            @if ($event->event_image)
                <img class="hero__img" src="{{ asset('images/events/' . $event->event_image) }}"
                    alt="{{ $event->event_name }}">
            @else
                <div class="hero__fallback">
                    <div class="hero__fallback-glow"></div>
                </div>
            @endif

            <div class="hero__orb hero__orb--1"></div>
            <div class="hero__orb hero__orb--2"></div>
            <div class="hero__grad"></div>

            <div class="hero__content">
                @php
                    $ticketCollection = collect($event->tickets ?? []);
                    $hasTickets = $ticketCollection->count() > 0;
                    $hasAvailableTickets = $ticketCollection->contains(function ($ticket) {
                        return (int) ($ticket->quantity ?? 0) > 0;
                    });
                    $saleBadgeText = $hasAvailableTickets
                        ? 'On Sale Now'
                        : ($hasTickets
                            ? 'Sold Out'
                            : 'No Available Tickets');
                @endphp
                <div class="hero__badge-row">
                    <div class="hero__badge">
                        @if ($hasAvailableTickets)
                            <div class="hero__badge-live"></div>
                        @endif
                        {{ $saleBadgeText }}
                    </div>
                    @if ($event->event_date)
                        <div class="hero__badge-date">
                            {{ strtoupper(\Carbon\Carbon::parse($event->event_date)->format('M d, Y')) }}</div>
                    @endif
                </div>

                <h1 class="hero__title">{{ $event->event_name }}</h1>

                @if ($event->event_tagline ?? null)
                    <p class="hero__sub">{{ $event->event_tagline }}</p>
                @endif

                @if ($event->event_venue)
                    <div class="hero__venue-row">
                        <div class="hero__venue-icon">
                            <svg width="16" height="16" fill="none" stroke="#38bdf8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="hero__venue-name">{{ $event->event_venue }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="hero__scroll-cue">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                Scroll
            </div>
        </div>

        <div class="wrap">

            {{-- ─── LINE-UP (full width above columns) ─── --}}
            @if (isset($event->artists) && count($event->artists))
                <div class="sec-head fade-up">
                    <div class="sec-label">Line-Up</div>
                    <div class="sec-line"></div>
                </div>
                <div class="lineup-scroll fade-up">
                    @foreach ($event->artists as $artist)
                        <div class="lineup-card {{ $loop->first ? 'featured' : '' }}">
                            @if ($artist->photo ?? null)
                                <img class="lineup-card__img" src="{{ asset('images/artists/' . $artist->photo) }}"
                                    alt="{{ $artist->name }}">
                            @else
                                <div class="lineup-card__img-placeholder">
                                    <svg width="40" height="40" fill="none" stroke="rgba(56,189,248,.25)"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                </div>
                            @endif
                            <div class="lineup-card__body">
                                <div class="lineup-card__name">{{ $artist->name }}</div>
                                <div class="lineup-card__role role--{{ Str::slug($artist->role ?? 'headliner') }}">
                                    {{ $artist->role ?? 'Headliner' }}</div>
                                @if ($loop->first && ($artist->bio ?? null))
                                    <div class="lineup-card__desc">{{ Str::limit($artist->bio, 90) }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- ─── TWO-COLUMN SECTION ─── --}}
            <div class="two-col">

                {{-- LEFT: About + Rules --}}
                <div class="col-left">
                    <div class="sec-head fade-up">
                        <div class="sec-label">About</div>
                        <div class="sec-line"></div>
                        @auth
                            @if (auth()->user()->is_admin ?? false)
                                <button class="edit-toggle" id="editToggle" onclick="toggleEditor()">Edit</button>
                            @endif
                        @endauth
                    </div>

                    <div class="about-card fade-up">
                        <div id="descDisplay">
                            <div class="about-text">{!! $event->description ?? 'No description available.' !!}</div>
                        </div>
                        <div id="editor-wrap">
                            <div id="quillEditor"></div>
                            <div style="display:flex;gap:10px;margin-top:12px;">
                                <button onclick="saveDescription()"
                                    style="background:var(--accent);color:#fff;border:none;border-radius:10px;padding:9px 20px;font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.08em;cursor:pointer;">Save</button>
                                <button onclick="cancelEdit()"
                                    style="background:rgba(255,255,255,.07);color:#fff;border:1px solid var(--rim);border-radius:10px;padding:9px 20px;font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:.08em;cursor:pointer;">Cancel</button>
                            </div>
                        </div>

                        @if ($event->rules ?? null)
                            <button class="show-more-btn" id="showMoreBtn" onclick="toggleRules()">
                                View Rules &amp; Restrictions
                                <svg width="14" height="14" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- RULES --}}
                    @if ($event->rules ?? null)
                        <div class="rules-card" id="rulesCard" style="display:none;">
                            <ul>
                                @foreach (explode("\n", $event->rules) as $rule)
                                    @if (trim($rule))
                                        <li>{{ trim($rule) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                {{-- END col-left --}}

                {{-- RIGHT: Seating Chart + Tickets --}}
                <div class="col-right">

                    {{-- SEAT CHART --}}
                    @if ($event->seat_plan)
                        <div class="sec-head fade-up">
                            <div class="sec-label">Seating Chart</div>
                            <div class="sec-line"></div>
                        </div>
                        <div class="seat-chart-wrap fade-up"
                            onclick="document.getElementById('lightbox').classList.add('open')">
                            <img src="{{ asset('images/events/seat_plan/' . $event->seat_plan) }}" alt="Seating Chart">
                            <div class="seat-chart-overlay">
                                <div class="seat-chart-label">
                                    <svg width="14" height="14" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                    Tap to Zoom
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- TICKETS --}}
                    @if ($event->tickets && count($event->tickets))
                        <div class="sec-head fade-up">
                            <div class="sec-label">Select Tickets</div>
                            <div class="sec-line"></div>
                        </div>

                        <div class="ticket-cards" id="ticketList">
                            @foreach ($event->tickets as $i => $ticket)
                                @php
                                    $qty = $ticket->quantity ?? 0;
                                    $sold = $qty <= 0;
                                    $tktName = $ticket->name ?? ($ticket->type ?? 'General');
                                    $tktType = $ticket->type ?? ($ticket->category ?? 'General Admission');
                                    $inclusions = $ticket->inclusions ?? ($ticket->perks ?? null);

                                    $rawColor = ltrim(trim((string) ($ticket->color ?? '')), '#');
                                    if (preg_match('/^[A-Fa-f0-9]{3}$/', $rawColor)) {
                                        $rawColor = preg_replace('/(.)/', '$1$1', $rawColor);
                                    }
                                    $isValidHex = preg_match('/^[A-Fa-f0-9]{6}$/', $rawColor) === 1;
                                    $hexColor = $isValidHex ? '#' . strtoupper($rawColor) : '#38BDF8';
                                    $rgbColor = $isValidHex
                                        ? hexdec(substr($rawColor, 0, 2)) .
                                            ',' .
                                            hexdec(substr($rawColor, 2, 2)) .
                                            ',' .
                                            hexdec(substr($rawColor, 4, 2))
                                        : '56,189,248';
                                @endphp

                                <div class="tkt fade-up {{ $i === 0 && !$sold ? 'selected' : '' }} {{ $sold ? 'sold-out' : '' }}"
                                    data-id="{{ $ticket->id }}" data-price="{{ $ticket->price ?? 0 }}"
                                    data-name="{{ $tktName }}" data-sold="{{ $sold ? '1' : '0' }}"
                                    data-max="{{ max(0, (int) $qty) }}" data-color="{{ $hexColor }}"
                                    style="--tkt-color: {{ $hexColor }}; --tkt-rgb: {{ $rgbColor }};"
                                    onclick="selectTicket(this)">
                                    {{-- Top row: name + price --}}
                                    <div class="tkt__top">
                                        <div>
                                            <div class="tkt__name" style="color: {{ $hexColor }};">
                                                {{ $tktName }}</div>
                                            <div class="tkt__sub">{{ $tktType }}</div>
                                        </div>
                                        <div class="tkt__price" style="color: {{ $hexColor }};">
                                            <span
                                                class="tkt__currency">₱</span>{{ number_format($ticket->price ?? 0, 0) }}
                                        </div>
                                    </div>

                                    {{-- Availability --}}
                                    @if ($sold)
                                        <div class="tkt__avail avail--gray">
                                            <div class="avail-dot avail-dot--gray"></div>
                                            Sold Out
                                        </div>
                                    @else
                                        <div class="tkt__avail" style="color: {{ $hexColor }};">
                                            <div class="avail-dot"
                                                style="background: {{ $hexColor }}; box-shadow: 0 0 7px {{ $hexColor }};">
                                            </div>
                                            Available
                                        </div>
                                    @endif

                                    {{-- Inclusions --}}
                                    @if ($inclusions && !$sold)
                                        <hr class="tkt__divider">
                                        <div class="tkt__inclusions-label" style="color: {{ $hexColor }};">Inclusions
                                        </div>
                                        <div class="tkt__perks">
                                            @foreach (preg_split('/\r\n|\r|\n/', $inclusions) as $item)
                                                @php $item = trim(ltrim(trim($item), '-')); @endphp
                                                @if ($item)
                                                    <div class="tkt__perk">— {{ $item }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Quantity stepper --}}
                                    <div class="tkt__stepper-row" style="--tkt-rgb: {{ $rgbColor }};">
                                        <div class="stepper-label">Quantity</div>
                                        <div class="stepper-controls">
                                            <button type="button" class="stepper-btn stepper-btn--minus"
                                                onclick="changeQty(event, this, -1)">−</button>
                                            <span class="stepper-num" data-qty="1">1</span>
                                            <button type="button" class="stepper-btn stepper-btn--plus"
                                                style="background: {{ $hexColor }}; color: #000;"
                                                onmouseover="this.style.filter='brightness(1.15)'"
                                                onmouseout="this.style.filter=''"
                                                onclick="changeQty(event, this, 1)">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="sec-head fade-up">
                            <div class="sec-label">Tickets</div>
                            <div class="sec-line"></div>
                        </div>
                        <div class="about-card fade-up">
                            <div class="about-text">Tickets are still not available. Stay tuned.</div>
                        </div>
                    @endif

                </div>
                {{-- END col-right --}}

            </div>
            {{-- END two-col --}}

            <div style="height:60px;"></div>
        </div>

        {{-- ─── BOTTOM BAR ─── --}}
        <div class="bottom-bar" id="bottomBar">
            <div class="bottom-bar__info">
                <div class="bottom-bar__total-label">Total Amount</div>
                <div class="bottom-bar__total">
                    ₱<span class="bottom-bar__total-accent" id="barTotal">0</span>
                </div>
            </div>
            <button class="buy-btn" onclick="openModal()">
                <a id="buyTicketsBtn" class="buy-btn" href="#">
                    Buy Tickets
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <script>
                    // ...existing code...
                    // Redirect to purchase page with ticket and quantity
                    document.getElementById('buyTicketsBtn')?.addEventListener('click', function(e) {
                        e.preventDefault();
                        const selectedTicket = document.querySelector('.tkt.selected');
                        if (!selectedTicket) return;
                        const ticketId = selectedTicket.getAttribute('data-id') || selectedTicket.getAttribute(
                            'data-ticket-id') || selectedTicket.dataset.ticketId || selectedTicket.dataset.id;
                        const qty = selQty;
                        const url = `{{ url('purchase') }}?event={{ $event->id }}&ticket=${ticketId}&quantity=${qty}`;
                        window.location.href = url;
                    });
                </script>
        </div>



        {{-- ─── LIGHTBOX ─── --}}
        @if ($event->seat_plan)
            <div class="lightbox" id="lightbox" onclick="this.classList.remove('open')">
                <img src="{{ asset('images/events/seat_plan/' . $event->seat_plan) }}" alt="Seating Chart Full View">
            </div>
        @endif
    @else
        <div class="wrap">
            <div class="not-found">
                <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="color:var(--red);opacity:.5;display:block;margin:0 auto;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2>Event Not Found</h2>
                <p>Sorry, we couldn't find the event you're looking for.</p>
            </div>
        </div>

    @endif

    <script>
        let selPrice = 0,
            selName = '',
            selQty = 1,
            selMaxQty = 1;

        function parsePrice(value) {
            if (typeof value === 'number') return value;
            if (!value) return 0;
            return Number(String(value).replace(/[^\d.-]/g, '')) || 0;
        }

        function getCardMaxQty(card) {
            const maxQty = parseInt(card?.dataset?.max, 10);
            return Number.isFinite(maxQty) && maxQty > 0 ? maxQty : 1;
        }

        function selectTicket(el) {
            if (el.dataset.sold === '1') return;
            document.querySelectorAll('.tkt').forEach(t => {
                t.classList.remove('selected');
                const n = t.querySelector('.stepper-num');
                if (n) {
                    n.textContent = 1;
                    n.dataset.qty = 1;
                }
            });
            el.classList.add('selected');
            selPrice = parsePrice(el.dataset.price);
            selName = el.dataset.name;
            selMaxQty = getCardMaxQty(el);
            selQty = Math.min(1, selMaxQty) || 1;
            const n = el.querySelector('.stepper-num');
            if (n) {
                n.textContent = selQty;
                n.dataset.qty = selQty;
            }
            updateBar();
        }

        function changeQty(e, btn, delta) {
            e?.preventDefault?.();
            e?.stopPropagation?.();
            const card = (btn || e?.currentTarget || e?.target)?.closest('.tkt');
            if (!card.classList.contains('selected')) return;
            const num = card.querySelector('.stepper-num');
            let q = parseInt(num.dataset.qty) || 1;
            const maxQty = getCardMaxQty(card);
            q = Math.max(1, Math.min(maxQty, q + delta));
            num.textContent = q;
            num.dataset.qty = q;
            selQty = q;
            selMaxQty = maxQty;
            updateBar();
        }

        function updateBar() {
            document.getElementById('barTotal').textContent = (selPrice * selQty).toLocaleString('en-PH');
            if (selName) document.getElementById('bottomBar').classList.add('visible');
        }

        // Auto-select first available ticket on load
        (function() {
            const first = document.querySelector('.tkt:not(.sold-out)');
            if (first) selectTicket(first);
        })();

        function openModal() {
            if (!selName) return;
            document.getElementById('modalType').textContent = selName;
            document.getElementById('modalQty').textContent = selQty + ' ticket' + (selQty > 1 ? 's' : '');
            document.getElementById('modalUnit').textContent = '₱' + selPrice.toLocaleString('en-PH');
            document.getElementById('modalTotal').textContent = '₱' + (selPrice * selQty).toLocaleString('en-PH');
            // Set hidden ticket and quantity fields
            const selectedTicket = document.querySelector('.tkt.selected');
            if (selectedTicket) {
                const ticketId = selectedTicket.getAttribute('data-id') || selectedTicket.getAttribute('data-ticket-id') ||
                    selectedTicket.dataset.ticketId || selectedTicket.dataset.id;
                document.getElementById('ticketIdInput').value = ticketId;
            }
            document.getElementById('quantityInput').value = selQty;
            document.getElementById('purchaseModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('purchaseModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.getElementById('purchaseModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Ensure hidden fields are set before form submission
        document.addEventListener('DOMContentLoaded', function() {
            const purchaseForm = document.querySelector('form[action*="public.sales.store"]');
            if (purchaseForm) {
                purchaseForm.addEventListener('submit', function(e) {
                    // Set ticket and quantity fields again just before submit for safety
                    const selectedTicket = document.querySelector('.tkt.selected');
                    if (selectedTicket) {
                        const ticketId = selectedTicket.getAttribute('data-id') || selectedTicket
                            .getAttribute('data-ticket-id') || selectedTicket.dataset.ticketId ||
                            selectedTicket.dataset.id;
                        document.getElementById('ticketIdInput').value = ticketId;
                    }
                    document.getElementById('quantityInput').value = selQty;
                });
            }
        });

        function toggleRules() {
            const rules = document.getElementById('rulesCard');
            const btn = document.getElementById('showMoreBtn');
            if (!rules) return;
            const open = rules.style.display === 'block';
            rules.style.display = open ? 'none' : 'block';
            btn.classList.toggle('open', !open);
            btn.childNodes[0].textContent = open ? 'View Rules & Restrictions ' : 'Hide Rules ';
        }

        let quill = null;

        function toggleEditor() {
            const wrap = document.getElementById('editor-wrap');
            const disp = document.getElementById('descDisplay');
            const btn = document.getElementById('editToggle');
            if (wrap.style.display === 'block') {
                cancelEdit();
                return;
            }
            wrap.style.display = 'block';
            disp.style.display = 'none';
            btn.textContent = 'Cancel';
            if (!quill) {
                quill = new Quill('#quillEditor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, 3, false]
                            }],
                            ['bold', 'italic', 'underline', 'blockquote'],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }],
                            ['link'],
                            ['clean']
                        ]
                    }
                });
            }
            quill.clipboard.dangerouslyPasteHTML(disp.innerHTML);
        }

        function cancelEdit() {
            document.getElementById('editor-wrap').style.display = 'none';
            document.getElementById('descDisplay').style.display = '';
            const btn = document.getElementById('editToggle');
            if (btn) btn.textContent = 'Edit';
        }

        function saveDescription() {
            if (!quill) return;
            document.getElementById('descDisplay').innerHTML = quill.root.innerHTML;
            cancelEdit();
            // TODO: POST updated HTML to your Laravel route
        }

        function toggleCardFields() {
            const method = document.getElementById('paymentMethod').value;
            const cardFields = document.getElementById('cardFields');
            if (method === 'card') {
                cardFields.style.display = 'block';
                document.getElementById('cardNumber').required = true;
                document.getElementById('expMonth').required = true;
                document.getElementById('expYear').required = true;
                document.getElementById('cardCvc').required = true;
            } else {
                cardFields.style.display = 'none';
                document.getElementById('cardNumber').required = false;
                document.getElementById('expMonth').required = false;
                document.getElementById('expYear').required = false;
                document.getElementById('cardCvc').required = false;
            }
        }
    </script>


    {{-- @include('public.component.ticket.modal') --}} <!-- Removed admin modal include from public page -->



    <script>
        // Removed duplicate openBuyModal and closeModal for ticketModal (admin modal)
    </script>
@endsection
