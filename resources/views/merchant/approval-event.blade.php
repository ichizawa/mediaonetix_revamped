@extends('layouts')

@section('content')
    <style>
        :root {
            --bg-base: #0a0f1e;
            --bg-surface: #0e1628;
            --bg-elevated: #131e35;
            --border: rgba(255, 255, 255, 0.08);
            --border-bright: rgba(255, 255, 255, 0.15);
            --text-primary: #f0f4ff;
            --text-secondary: #7a8ba8;
            --text-muted: #4a5a72;
            --accent-blue: #4f8fff;
            --accent-blue-glow: rgba(79, 143, 255, 0.2);
            --accent-green: #3ecf8e;
            --accent-green-glow: rgba(62, 207, 142, 0.15);
            --accent-amber: #f0a832;
            --accent-amber-glow: rgba(240, 168, 50, 0.15);
            --accent-red: #ff5e5e;
        }

        * { box-sizing: border-box; }

        body {
            font-family: inherit;
            background: var(--bg-base);
            color: var(--text-primary);
        }

        .approval-wrapper,
        .approval-wrapper * {
            font-family: inherit !important;
        }

        /* ─── Layout ─── */
        .approval-wrapper {
            min-height: 100vh;
            background: var(--bg-base);
        }

        .approval-inner {
            margin-left: 0;
        }

        @media (min-width: 1024px) {
            .approval-inner { margin-left: 16rem; }
        }

        /* ─── Header ─── */
        .page-header {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(10, 15, 30, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        .header-inner {
            padding: 1rem 1.25rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        @media (min-width: 640px) { .header-inner { padding: 1.25rem 2rem; } }
        @media (min-width: 1024px) { .header-inner { padding: 1.25rem 2.5rem; } }

        .header-eyebrow {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.2rem;
        }

        .eyebrow-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent-amber);
            box-shadow: 0 0 8px var(--accent-amber);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(0.85); }
        }

        .eyebrow-text {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent-amber);
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.1;
        }

        @media (min-width: 640px) { .page-title { font-size: 1.65rem; } }

        .page-subtitle {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 0.2rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: transparent;
            border: 1px solid var(--border-bright);
            border-radius: 0.6rem;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .back-btn:hover {
            color: var(--text-primary);
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.25);
        }

        /* ─── Page Content ─── */
        .page-content {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        @media (min-width: 640px) { .page-content { padding: 1.75rem 2rem; gap: 2rem; } }
        @media (min-width: 1024px) { .page-content { padding: 2rem 2.5rem; } }

        /* ─── Alerts ─── */
        .alert {
            padding: 0.85rem 1.1rem;
            border-radius: 0.75rem;
            font-size: 0.82rem;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
        }

        .alert-success {
            background: rgba(62,207,142,0.08);
            border: 1px solid rgba(62,207,142,0.25);
            color: #9efad0;
        }

        .alert-error {
            background: rgba(255,94,94,0.07);
            border: 1px solid rgba(255,94,94,0.25);
            color: #ffb3b3;
        }

        .alert-icon {
            flex-shrink: 0;
            width: 1.1rem;
            height: 1.1rem;
            margin-top: 0.05rem;
        }

        .alert ul { margin: 0; padding-left: 1rem; }
        .alert li { margin-top: 0.2rem; }

        /* ─── Modal ─── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: rgba(5, 10, 20, 0.78);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 90;
        }

        .modal-backdrop.active {
            display: flex;
        }

        .modal-panel {
            width: 100%;
            max-width: 30rem;
            background: var(--bg-surface);
            border: 1px solid var(--border-bright);
            border-radius: 0.9rem;
            padding: 1rem;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.4);
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .modal-body {
            font-size: 0.85rem;
            color: var(--text-secondary);
            line-height: 1.55;
        }

        .modal-error-list {
            margin: 0.25rem 0 0;
            padding-left: 1rem;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .modal-btn {
            border: 1px solid var(--border-bright);
            border-radius: 0.55rem;
            padding: 0.5rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.04);
            cursor: pointer;
        }

        .modal-btn:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .modal-btn.primary {
            border-color: rgba(79, 143, 255, 0.55);
            background: rgba(79, 143, 255, 0.18);
        }

        /* ─── Event Card ─── */
        .event-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 1.25rem;
            overflow: hidden;
        }

        .event-card-grid {
            display: grid;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .event-card-grid { grid-template-columns: 280px 1fr; }
        }

        @media (min-width: 1024px) {
            .event-card-grid { grid-template-columns: 320px 1fr; }
        }

        /* Image panel */
        .event-image-panel {
            position: relative;
            min-height: 200px;
            background: var(--bg-elevated);
            overflow: hidden;
        }

        @media (min-width: 768px) { .event-image-panel { min-height: 100%; } }

        .event-image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .event-image-empty {
            width: 100%;
            height: 100%;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .event-image-empty svg {
            width: 2.5rem;
            height: 2.5rem;
            opacity: 0.35;
        }

        /* Image overlay gradient */
        .event-image-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 60%, rgba(10,15,30,0.5));
            pointer-events: none;
        }

        /* Info panel */
        .event-info-panel {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        @media (min-width: 640px) { .event-info-panel { padding: 2rem; } }

        .event-header-row {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .event-pending-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
        }

        .event-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.15;
        }

        @media (min-width: 640px) { .event-title { font-size: 1.75rem; } }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.85rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            letter-spacing: 0.04em;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .status-badge.pending {
            background: var(--accent-amber-glow);
            border: 1px solid rgba(240,168,50,0.4);
            color: var(--accent-amber);
        }

        .status-badge-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Meta grid */
        .meta-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        @media (min-width: 480px) {
            .meta-grid { grid-template-columns: 1fr 1fr; }
        }

        .meta-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.85rem 1rem;
            transition: border-color 0.2s;
        }

        .meta-item:hover { border-color: var(--border-bright); }

        .meta-label {
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
        }

        .meta-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Description */
        .description-box {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .description-label {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .description-text {
            font-size: 0.85rem;
            line-height: 1.65;
            color: #8da0bc;
            white-space: pre-line;
        }

        /* ─── Documents Section ─── */
        .docs-section {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 1.25rem;
            padding: 1.5rem;
        }

        @media (min-width: 640px) { .docs-section { padding: 2rem; } }

        .docs-section-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        .docs-section-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.3rem;
        }

        .docs-section-subtitle {
            font-size: 0.8rem;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        /* Document type cards */
        .doc-types-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .doc-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.25rem;
            transition: border-color 0.2s;
        }

        .doc-card:hover { border-color: var(--border-bright); }

        .doc-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .doc-card-number {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .doc-number-badge {
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            background: rgba(79,143,255,0.12);
            border: 1px solid rgba(79,143,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--accent-blue);
            flex-shrink: 0;
        }

        .doc-card-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .required-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.65rem;
            border-radius: 99px;
            font-size: 0.65rem;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            background: rgba(62,207,142,0.1);
            border: 1px solid rgba(62,207,142,0.3);
            color: var(--accent-green);
            white-space: nowrap;
        }

        .remove-doc-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.65rem;
            border-radius: 0.5rem;
            font-size: 0.72rem;
            font-weight: 600;
            background: rgba(255,94,94,0.08);
            border: 1px solid rgba(255,94,94,0.2);
            color: #ff8f8f;
            cursor: pointer;
            transition: all 0.2s;
        }

        .remove-doc-btn:hover {
            background: rgba(255,94,94,0.16);
            border-color: rgba(255,94,94,0.4);
        }

        /* Form fields */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        @media (min-width: 640px) {
            .field-group { flex-direction: row; gap: 1rem; align-items: flex-start; }
            .field-group .field { flex: 1; }
            .field-group .field.file-field { flex: 1.4; }
        }

        .field { display: flex; flex-direction: column; gap: 0.35rem; }

        .field-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .field-input {
            width: 100%;
            padding: 0.65rem 0.85rem;
            background: rgba(10,15,30,0.6);
            border: 1px solid var(--border-bright);
            border-radius: 0.6rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            color: var(--text-primary);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus {
            border-color: rgba(79,143,255,0.5);
            box-shadow: 0 0 0 3px rgba(79,143,255,0.1);
        }

        .field-input[readonly] {
            color: var(--text-secondary);
            cursor: default;
            border-color: var(--border);
        }

        /* File input */
        .file-input-wrapper {
            position: relative;
        }

        .file-input-custom {
            width: 100%;
            padding: 0;
            background: transparent;
            border: none;
            font-size: 0;
            cursor: pointer;
        }

        .file-drop-zone {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem;
            background: rgba(10,15,30,0.4);
            border: 1.5px dashed rgba(79,143,255,0.3);
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .file-drop-zone:hover {
            background: rgba(79,143,255,0.05);
            border-color: rgba(79,143,255,0.5);
        }

        .file-drop-zone svg {
            width: 1.5rem;
            height: 1.5rem;
            color: rgba(79,143,255,0.6);
        }

        .file-drop-text {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .file-drop-text span {
            color: var(--accent-blue);
            font-weight: 600;
        }

        .file-drop-hint {
            font-size: 0.68rem;
            color: var(--text-muted);
        }

        /* Preview grid */
        .preview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin-top: 0.6rem;
        }

        .preview-item {
            position: relative;
            border-radius: 0.6rem;
            overflow: hidden;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            aspect-ratio: 4/3;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .preview-remove {
            position: absolute;
            top: 0.3rem;
            right: 0.3rem;
            width: 1.4rem;
            height: 1.4rem;
            border-radius: 50%;
            background: rgba(0,0,0,0.75);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
            line-height: 1;
        }

        .preview-remove:hover { background: rgba(200,0,0,0.85); }

        /* Add document button */
        .add-doc-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.85rem;
            background: transparent;
            border: 1.5px dashed var(--border-bright);
            border-radius: 0.85rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .add-doc-btn:hover {
            background: rgba(255,255,255,0.03);
            border-color: rgba(255,255,255,0.25);
            color: var(--text-primary);
        }

        .add-doc-btn svg {
            width: 1rem;
            height: 1rem;
        }

        /* Rule notice */
        .rule-notice {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.85rem 1rem;
            background: rgba(79,143,255,0.06);
            border: 1px solid rgba(79,143,255,0.2);
            border-radius: 0.75rem;
            font-size: 0.8rem;
            color: #89b4ff;
            line-height: 1.5;
        }

        .rule-notice svg {
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
            margin-top: 0.1rem;
            color: var(--accent-blue);
        }

        /* Submit area */
        .submit-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-top: 0.5rem;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            background: rgba(79,143,255,0.15);
            border: 1px solid rgba(79,143,255,0.4);
            border-radius: 0.7rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: #afd0ff;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 0 20px rgba(79,143,255,0.12);
        }

        .submit-btn:hover {
            background: rgba(79,143,255,0.25);
            border-color: rgba(79,143,255,0.6);
            box-shadow: 0 0 28px rgba(79,143,255,0.22);
            color: #fff;
        }

        .submit-btn svg { width: 1rem; height: 1rem; }

        /* Hidden real file input */
        .real-file-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            font-size: 0;
        }

        .submission-summary {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background: rgba(79,143,255,0.06);
            border: 1px solid rgba(79,143,255,0.18);
            border-radius: 1rem;
        }

        @media (min-width: 768px) {
            .submission-summary {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        .submission-summary-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .submission-summary-copy {
            font-size: 0.8rem;
            color: var(--text-secondary);
            line-height: 1.45;
        }

        .submission-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .submission-chip.pending {
            background: rgba(240,168,50,0.12);
            border-color: rgba(240,168,50,0.35);
            color: var(--accent-amber);
        }

        .submission-chip.approved {
            background: rgba(62,207,142,0.12);
            border-color: rgba(62,207,142,0.35);
            color: var(--accent-green);
        }

        .submission-chip.rejected {
            background: rgba(255,94,94,0.12);
            border-color: rgba(255,94,94,0.35);
            color: #ff8f8f;
        }

        .submission-progress {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.65rem;
            width: 100%;
            margin-top: 0.25rem;
        }

        @media (min-width: 768px) {
            .submission-progress { max-width: 28rem; }
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            padding: 0.75rem 0.5rem;
            border-radius: 0.85rem;
            border: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
        }

        .progress-step.active {
            border-color: rgba(79,143,255,0.38);
            background: rgba(79,143,255,0.1);
        }

        .progress-step.rejected.active {
            border-color: rgba(255,94,94,0.4);
            background: rgba(255,94,94,0.09);
        }

        .progress-step-dot {
            width: 0.6rem;
            height: 0.6rem;
            border-radius: 50%;
            background: var(--text-muted);
        }

        .progress-step.active .progress-step-dot {
            background: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(79,143,255,0.12);
        }

        .progress-step.rejected.active .progress-step-dot {
            background: var(--accent-red);
            box-shadow: 0 0 0 3px rgba(255,94,94,0.12);
        }

        .progress-step-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-align: center;
        }

        .progress-step.active .progress-step-label {
            color: var(--text-primary);
        }

        .retained-docs {
            margin-top: 1rem;
            display: grid;
            gap: 1rem;
        }

        .retained-doc-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1rem;
        }

        .retained-doc-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            margin-bottom: 0.8rem;
        }

        .retained-doc-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .retained-doc-count {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .retained-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
            gap: 0.6rem;
        }

        .retained-preview-item {
            position: relative;
            min-height: 110px;
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid var(--border);
            background: var(--bg-elevated);
        }

        .retained-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .retained-preview-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            padding: 0.55rem;
            background: linear-gradient(to top, rgba(0,0,0,0.58), rgba(0,0,0,0.04));
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .view-only-note {
            margin-top: 0.75rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .locked-note {
            margin-top: 0.75rem;
            padding: 0.9rem 1rem;
            border-radius: 0.85rem;
            background: rgba(62,207,142,0.08);
            border: 1px solid rgba(62,207,142,0.2);
            color: #9efad0;
            font-size: 0.82rem;
        }

        .submission-prompt {
            display: none;
        }

        .submission-prompt.active {
            display: flex;
        }
    </style>

    <div class="approval-wrapper">
        <div class="approval-inner">

            {{-- ── Header ── --}}
            <header class="page-header">
                <div class="header-inner">
                    <div>
                        <div class="header-eyebrow">
                            <span class="eyebrow-dot"></span>
                            <span class="eyebrow-text">Pending Review</span>
                        </div>
                        <h2 class="page-title">Event Approval</h2>
                        <p class="page-subtitle">Review event details before publishing or rejecting.</p>
                    </div>
                    <a href="{{ url()->previous() }}" class="back-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back
                    </a>
                </div>
            </header>

            {{-- ── Content ── --}}
            <div class="page-content">

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- ── Event Card ── --}}
                <div class="event-card">
                    <div class="event-card-grid">

                        {{-- Image --}}
                        <div class="event-image-panel">
                            @if (!empty($event->event_image ?? null))
                                <img src="{{ asset('images/events/' . $event->event_image) }}" alt="Event Image">
                            @else
                                <div class="event-image-empty">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>No image uploaded</span>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="event-info-panel">
                            <div class="event-header-row">
                                <div>
                                    <p class="event-pending-label">Awaiting Decision</p>
                                    <h3 class="event-title">{{ $event->event_name ?? 'Untitled Event' }}</h3>
                                </div>
                                <span class="status-badge pending">
                                    <span class="status-badge-dot"></span>
                                    For Approval
                                </span>
                            </div>

                            <div class="meta-grid">
                                <div class="meta-item">
                                    <p class="meta-label">Date</p>
                                    <p class="meta-value">{{ !empty($event->event_date ?? null) ? date('M j, Y', strtotime($event->event_date)) : 'TBD' }}</p>
                                </div>
                                <div class="meta-item">
                                    <p class="meta-label">Time</p>
                                    <p class="meta-value">{{ !empty($event->event_time ?? null) ? date('g:i A', strtotime($event->event_time)) : 'TBD' }}</p>
                                </div>
                                <div class="meta-item">
                                    <p class="meta-label">Venue</p>
                                    <p class="meta-value">{{ $event->event_venue ?? 'Not set' }}</p>
                                </div>
                                <div class="meta-item">
                                    <p class="meta-label">Category</p>
                                    <p class="meta-value">{{ $event->category ?? 'Uncategorized' }}</p>
                                </div>
                                <div class="meta-item">
                                    <p class="meta-label">Total Slots</p>
                                    <p class="meta-value">{{ isset($event->tickets) ? $event->tickets->sum('original_qty') : 0 }}</p>
                                </div>
                            </div>

                            @php $plainDetails = trim(strip_tags((string)($event->description ?? ''))); @endphp
                            <div class="description-box">
                                <p class="description-label">Description</p>
                                <p class="description-text">{{ $plainDetails !== '' ? $plainDetails : 'No details provided.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── Documents Section ── --}}
                <div class="docs-section">
                    <div class="docs-section-header">
                        <h4 class="docs-section-title">Approval Documents</h4>
                        <p class="docs-section-subtitle">Your uploaded files are retained here. You can review them in view-only mode or switch to edit mode if changes are needed.</p>
                    </div>

                    @php
                        $submission = $submissionSummary ?? [
                            'has_submission' => false,
                            'status_code' => 0,
                            'status' => ['label' => 'Pending', 'color' => 'yellow'],
                            'can_edit' => false,
                            'documents' => [],
                        ];
                        $submissionStatusCode = $submission['status_code'] ?? 0;
                        $submissionStatusClass = $submissionStatusCode === 1 ? 'approved' : ($submissionStatusCode === 2 ? 'rejected' : 'pending');
                    @endphp

                    @if ($submission['has_submission'])
                        <div class="submission-summary">
                            <div>
                                <div class="submission-summary-title">Existing Submission</div>
                                <div class="submission-summary-copy">{{ $submission['can_edit'] ? 'You can keep this view-only or open edit mode to update the submission.' : 'This submission is locked because it has already been approved.' }}</div>
                                @if (($submission['status_code'] ?? 0) === 2 && !empty($submission['rejection_reason']))
                                    <div style="margin-top:0.55rem; font-size:0.8rem; color:#ffd0d0;">Rejected reason: {{ $submission['rejection_reason'] }}</div>
                                @endif
                            </div>
                            <div style="display:flex; flex-direction:column; gap:0.75rem; align-items:flex-end; width:100%;">
                                <span class="submission-chip {{ $submissionStatusClass }}">
                                    {{ $submission['status']['label'] }}
                                </span>
                                <div class="submission-progress">
                                    <div class="progress-step {{ $submissionStatusCode === 0 ? 'active' : '' }}">
                                        <span class="progress-step-dot"></span>
                                        <span class="progress-step-label">In Approval</span>
                                    </div>
                                    <div class="progress-step {{ $submissionStatusCode === 1 ? 'active' : '' }}">
                                        <span class="progress-step-dot"></span>
                                        <span class="progress-step-label">Approved</span>
                                    </div>
                                    <div class="progress-step rejected {{ $submissionStatusCode === 2 ? 'active' : '' }}">
                                        <span class="progress-step-dot"></span>
                                        <span class="progress-step-label">Rejected</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="retained-docs">
                            @foreach ($submission['documents'] as $document)
                                <div class="retained-doc-card">
                                    <div class="retained-doc-head">
                                        <div>
                                            <div class="retained-doc-title">{{ $document['title'] }}</div>
                                            <div class="retained-doc-count">{{ $document['count'] }} file{{ $document['count'] > 1 ? 's' : '' }} retained</div>
                                        </div>
                                    </div>
                                    <div class="retained-preview-grid">
                                        @foreach ($document['files'] as $file)
                                            <div class="retained-preview-item">
                                                @if ($file['is_image'])
                                                    <img src="{{ $file['url'] }}" alt="{{ $file['title'] }}">
                                                @else
                                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:rgba(79,143,255,0.08);color:var(--text-primary);font-weight:700;letter-spacing:0.08em;">{{ strtoupper($file['extension'] ?: 'FILE') }}</div>
                                                @endif
                                                <div class="retained-preview-overlay">Saved</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($submission['can_edit'])
                            <div style="margin-top:1rem; display:flex; justify-content:flex-end;">
                                <button type="button" class="submit-btn" style="padding:0.6rem 1.1rem;" onclick="openSubmissionPrompt()">
                                    Edit Submission
                                </button>
                            </div>
                        @else
                                <div class="locked-note">
                                    This submission is approved and locked for editing.
                                    @if (!empty($submission['rejection_reason']))
                                        <div style="margin-top:0.4rem; color:#ffd0d0;">Rejected reason: {{ $submission['rejection_reason'] }}</div>
                                    @endif
                                </div>
                        @endif
                    @endif

                    @if ($submission['has_submission'] && $submission['can_edit'])
                        <div id="editSubmissionPanel" class="docs-section" style="margin-top:1rem; display:none;">
                            <div class="docs-section-header">
                                <h4 class="docs-section-title">Edit Submitted Photos</h4>
                                <p class="docs-section-subtitle">Click any photo to replace it. Unchanged photos will stay as-is.</p>
                            </div>

                            <form id="editApprovalDocumentsForm" method="POST"
                                action="{{ route('merchant.events.approval.documents.update', $event->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="retained-docs">
                                    @foreach ($submission['documents'] as $document)
                                        <div class="retained-doc-card">
                                            <div class="retained-doc-head">
                                                <div>
                                                    <div class="retained-doc-title">{{ $document['title'] }}</div>
                                                    <div class="retained-doc-count">Click a photo to replace it</div>
                                                </div>
                                            </div>
                                            <div class="retained-preview-grid">
                                                @foreach ($document['files'] as $file)
                                                    <label class="retained-preview-item" data-file-id="{{ $file['id'] }}" style="cursor:pointer;">
                                                        @if ($file['is_image'])
                                                            <img src="{{ $file['url'] }}" alt="{{ $file['title'] }}" class="replace-preview-image">
                                                        @else
                                                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:rgba(79,143,255,0.08);color:var(--text-primary);font-weight:700;letter-spacing:0.08em;">{{ strtoupper($file['extension'] ?: 'FILE') }}</div>
                                                        @endif
                                                        <input type="file" name="replacements[{{ $file['id'] }}]" accept="image/*" class="replace-photo-input" hidden>
                                                        <div class="retained-preview-overlay">Click to replace</div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="submit-row" style="margin-top:1.25rem;">
                                    <button type="submit" class="submit-btn">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <div id="submissionPrompt" class="modal-backdrop submission-prompt" role="dialog" aria-modal="true" aria-labelledby="submissionPromptTitle">
                        <div class="modal-panel" style="max-width:34rem;">
                            <h3 id="submissionPromptTitle" class="modal-title">Edit existing submission?</h3>
                            <div class="modal-body">
                                You already have uploaded documents for this event. Do you want to keep this submission view-only, or edit it now?
                                @if (($submission['status_code'] ?? 0) === 2 && !empty($submission['rejection_reason']))
                                    <div style="margin-top:0.65rem; color:#ffd0d0;">Rejected reason: {{ $submission['rejection_reason'] }}</div>
                                @endif
                            </div>
                            <div class="modal-actions">
                                <button type="button" class="modal-btn" id="keepViewOnlyBtn">View only</button>
                                <button type="button" class="modal-btn primary" id="enableEditBtn">Edit submission</button>
                            </div>
                        </div>
                    </div>

                    <div id="uploadFormPanel" class="{{ $submission['has_submission'] ? 'hidden' : '' }}">
                        <form id="approvalDocumentsForm" method="POST"
                            action="{{ route('merchant.events.approval.documents.store', $event->id) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div id="documentTypesContainer" class="doc-types-container">

                                {{-- First card (required) --}}
                                <div class="doc-card" data-index="0">
                                    <div class="doc-card-header">
                                        <div class="doc-card-number">
                                            <span class="doc-number-badge">1</span>
                                            <span class="doc-card-title">Business Permit</span>
                                        </div>
                                        <span class="required-badge">
                                            <svg width="9" height="9" viewBox="0 0 12 12" fill="currentColor">
                                                <path d="M6 1l1.5 3 3.3.5-2.4 2.3.6 3.2L6 8.5 3 10l.6-3.2L1.2 4.5 4.5 4z"/>
                                            </svg>
                                            Required First
                                        </span>
                                    </div>
                                    <div class="field-group">
                                        <div class="field">
                                            <label class="field-label">Document Title</label>
                                            <input type="text" name="documents[0][title]" value="Business Permit" readonly class="field-input">
                                        </div>
                                        <div class="field file-field">
                                            <label class="field-label">Images <span style="color:var(--text-muted)">/ max 3</span></label>
                                            <div class="file-input-wrapper">
                                                <div class="file-drop-zone" id="dropZone-0">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                    </svg>
                                                    <p class="file-drop-text"><span>Choose files</span> or drag & drop</p>
                                                    <p class="file-drop-hint">PNG, JPG, JPEG, WEBP · max 20MB each</p>
                                                </div>
                                                <input type="file" name="documents[0][images][]" accept="image/*" multiple required
                                                    class="real-file-input document-images-input">
                                            </div>
                                            <div class="preview-grid document-preview-grid"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>{{-- end container --}}

                            <button type="button" id="addDocumentTypeBtn" class="add-doc-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Document Type
                            </button>

                            <div style="margin-top:1rem;">
                                <div class="rule-notice">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    At least 3 document types are required before submitting.
                                </div>
                            </div>

                            <div class="submit-row" style="margin-top:1.25rem;">
                                <button type="submit" class="submit-btn">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Submit Documents
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>{{-- page-content --}}
        </div>{{-- approval-inner --}}
    </div>

    <div id="errorModal" class="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="errorModalTitle">
        <div class="modal-panel">
            <h3 id="errorModalTitle" class="modal-title">Please Fix These Errors</h3>
            <div class="modal-body">
                <ul id="errorModalList" class="modal-error-list"></ul>
            </div>
            <div class="modal-actions">
                <button type="button" class="modal-btn" id="errorModalCloseBtn">OK</button>
            </div>
        </div>
    </div>

    <div id="confirmSubmitModal" class="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="confirmSubmitTitle">
        <div class="modal-panel">
            <h3 id="confirmSubmitTitle" class="modal-title">Confirm Submission</h3>
            <div class="modal-body">
                Are you sure you want to submit these documents for review?
            </div>
            <div class="modal-actions">
                <button type="button" class="modal-btn" id="confirmSubmitCancelBtn">Cancel</button>
                <button type="button" class="modal-btn primary" id="confirmSubmitProceedBtn">Yes, Submit</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('documentTypesContainer');
        const addBtn = document.getElementById('addDocumentTypeBtn');
        const form = document.getElementById('approvalDocumentsForm');
        const errorModal = document.getElementById('errorModal');
        const errorModalList = document.getElementById('errorModalList');
        const errorModalCloseBtn = document.getElementById('errorModalCloseBtn');
        const confirmModal = document.getElementById('confirmSubmitModal');
        const confirmCancelBtn = document.getElementById('confirmSubmitCancelBtn');
        const confirmProceedBtn = document.getElementById('confirmSubmitProceedBtn');
        const submissionSummary = @json($submissionSummary ?? ['has_submission' => false, 'can_edit' => false, 'status_code' => 0]);
        const submissionPrompt = document.getElementById('submissionPrompt');
        const uploadFormPanel = document.getElementById('uploadFormPanel');
        const keepViewOnlyBtn = document.getElementById('keepViewOnlyBtn');
        const enableEditBtn = document.getElementById('enableEditBtn');
        const editSubmissionPanel = document.getElementById('editSubmissionPanel');
        const editApprovalDocumentsForm = document.getElementById('editApprovalDocumentsForm');
        const maxFileSize = 20 * 1024 * 1024;
        let submitConfirmed = false;

        function openModal(modal) {
            if (!modal) return;
            modal.classList.add('active');
        }

        function closeModal(modal) {
            if (!modal) return;
            modal.classList.remove('active');
        }

        function openSubmissionPrompt() {
            if (submissionPrompt) {
                openModal(submissionPrompt);
            }
        }

        function closeSubmissionPrompt() {
            if (submissionPrompt) {
                closeModal(submissionPrompt);
            }
        }

        function enterEditMode() {
            closeSubmissionPrompt();
            if (editSubmissionPanel) {
                editSubmissionPanel.style.display = 'block';
                editSubmissionPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function stayViewOnly() {
            closeSubmissionPrompt();
            if (editSubmissionPanel) {
                editSubmissionPanel.style.display = 'none';
            }
        }

        function showErrorModal(errors) {
            if (!errorModal || !errorModalList) return;
            errorModalList.innerHTML = '';
            errors.forEach((message) => {
                const li = document.createElement('li');
                li.textContent = message;
                errorModalList.appendChild(li);
            });
            openModal(errorModal);
        }

        function docCardHTML(index) {
            return `
            <div class="doc-card" data-index="${index}">
                <div class="doc-card-header">
                    <div class="doc-card-number">
                        <span class="doc-number-badge">${index + 1}</span>
                        <span class="doc-card-title">Document Type ${index + 1}</span>
                    </div>
                    <button type="button" class="remove-doc-btn remove-document-type">
                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Remove
                    </button>
                </div>
                <div class="field-group">
                    <div class="field">
                        <label class="field-label">Document Title</label>
                        <input type="text" name="documents[${index}][title]" required
                            placeholder="e.g. BIR Certificate"
                            class="field-input">
                    </div>
                    <div class="field file-field">
                        <label class="field-label">Images <span style="color:var(--text-muted)">/ max 3</span></label>
                        <div class="file-input-wrapper">
                            <div class="file-drop-zone" id="dropZone-${index}">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="file-drop-text"><span>Choose files</span> or drag & drop</p>
                                <p class="file-drop-hint">PNG, JPG, JPEG, WEBP · max 20MB each</p>
                            </div>
                            <input type="file" name="documents[${index}][images][]" accept="image/*" multiple required
                                class="real-file-input document-images-input">
                        </div>
                        <div class="preview-grid document-preview-grid"></div>
                    </div>
                </div>
            </div>`;
        }

        function syncInputFiles(input, files) {
            const dt = new DataTransfer();
            files.forEach((f) => dt.items.add(f));
            input.files = dt.files;
            input._selectedFiles = files;
        }

        function renderPreview(input) {
            const card = input.closest('.doc-card');
            if (!card) return;
            const grid = card.querySelector('.document-preview-grid');
            if (!grid) return;
            const files = input._selectedFiles || [];
            grid.innerHTML = '';

            files.forEach((file, i) => {
                const wrap = document.createElement('div');
                wrap.className = 'preview-item';

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'preview-remove';
                btn.textContent = '✕';
                btn.addEventListener('click', () => {
                    const cur = [...(input._selectedFiles || [])];
                    cur.splice(i, 1);
                    syncInputFiles(input, cur);
                    renderPreview(input);
                });

                wrap.appendChild(img);
                wrap.appendChild(btn);
                grid.appendChild(wrap);
            });
        }

        function appendSelectedFiles(input, newFiles) {
            const existing = [...(input._selectedFiles || [])];
            const merged = [...existing];
            const oversized = [];

            newFiles.forEach((f) => {
                if (f.size > maxFileSize) {
                    oversized.push(`${f.name} is larger than 20MB.`);
                    return;
                }

                const dup = merged.some((c) => c.name === f.name && c.size === f.size && c.lastModified === f.lastModified);
                if (!dup && merged.length < 3) merged.push(f);
            });

            if (oversized.length) {
                showErrorModal(oversized);
            }

            if (existing.length + newFiles.length > 3 || merged.length > 3) {
                showErrorModal(['Maximum of 3 images per document type.']);
            }

            syncInputFiles(input, merged.slice(0, 3));
            renderPreview(input);
        }

        function bindDropZone(card) {
            const zone = card.querySelector('.file-drop-zone');
            const input = card.querySelector('.document-images-input');
            if (!zone || !input) return;

            zone.addEventListener('dragover', (e) => {
                e.preventDefault();
                zone.style.borderColor = 'rgba(79,143,255,0.7)';
                zone.style.background = 'rgba(79,143,255,0.08)';
            });

            zone.addEventListener('dragleave', () => {
                zone.style.borderColor = '';
                zone.style.background = '';
            });

            zone.addEventListener('drop', (e) => {
                e.preventDefault();
                zone.style.borderColor = '';
                zone.style.background = '';
                const dt = e.dataTransfer;
                if (dt && dt.files.length) appendSelectedFiles(input, [...dt.files]);
            });
        }

        function bindCardEvents(card) {
            if (!card) return;

            const removeBtn = card.querySelector('.remove-document-type');
            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    card.remove();
                    reindexCards();
                });
            }

            const imagesInput = card.querySelector('.document-images-input');
            if (imagesInput) {
                if (!imagesInput._selectedFiles) imagesInput._selectedFiles = [];
                imagesInput.addEventListener('change', function () {
                    appendSelectedFiles(this, [...this.files]);
                });
            }

            bindDropZone(card);
        }

        function reindexCards() {
            container.querySelectorAll('.doc-card').forEach((card, i) => {
                card.dataset.index = i;
                const badge = card.querySelector('.doc-number-badge');
                if (badge) badge.textContent = i + 1;
                const title = card.querySelector('.doc-card-title');
                if (title && i > 0) title.textContent = `Document Type ${i + 1}`;
                card.querySelectorAll('input').forEach((inp) => {
                    const n = inp.getAttribute('name');
                    if (n) inp.setAttribute('name', n.replace(/documents\[\d+\]/, `documents[${i}]`));
                });
            });
        }

        bindCardEvents(container.querySelector('.doc-card'));

        if (submissionSummary.has_submission && submissionSummary.can_edit && submissionPrompt) {
            openSubmissionPrompt();
        }

        if (keepViewOnlyBtn) {
            keepViewOnlyBtn.addEventListener('click', stayViewOnly);
        }

        if (enableEditBtn) {
            enableEditBtn.addEventListener('click', enterEditMode);
        }

        window.openSubmissionPrompt = openSubmissionPrompt;

        function bindReplacementInputs() {
            document.querySelectorAll('.replace-photo-input').forEach((input) => {
                input.addEventListener('change', function () {
                    const file = this.files && this.files[0];
                    const card = this.closest('.retained-preview-item');
                    const img = card ? card.querySelector('.replace-preview-image') : null;
                    const overlay = card ? card.querySelector('.retained-preview-overlay') : null;

                    if (!file || !img) return;

                    img.src = URL.createObjectURL(file);
                    if (overlay) overlay.textContent = 'Replaced';
                });
            });

            document.querySelectorAll('.retained-preview-item').forEach((item) => {
                item.addEventListener('click', function (event) {
                    const input = this.querySelector('.replace-photo-input');
                    const overlay = this.querySelector('.retained-preview-overlay');
                    if (!input) return;

                    if (event.target === overlay || event.target === this || event.target.tagName === 'IMG') {
                        input.click();
                    }
                });
            });
        }

        bindReplacementInputs();

        if (editApprovalDocumentsForm) {
            editApprovalDocumentsForm.addEventListener('submit', function () {
                if (editSubmissionPanel) {
                    editSubmissionPanel.style.display = 'block';
                }
            });
        }

        if (addBtn) {
            addBtn.addEventListener('click', () => {
                const idx = container.querySelectorAll('.doc-card').length;
                container.insertAdjacentHTML('beforeend', docCardHTML(idx));
                bindCardEvents(container.querySelector(`.doc-card[data-index="${idx}"]`));
            });
        }

        if (form) {
            form.addEventListener('submit', (e) => {
                if (submitConfirmed) {
                    submitConfirmed = false;
                    return;
                }

                const cards = container.querySelectorAll('.doc-card');
                if (cards.length < 3) {
                    e.preventDefault();
                    showErrorModal(['Please add at least 3 document types before submitting.']);
                    return;
                }

                const firstTitle = container.querySelector('input[name="documents[0][title]"]');
                if (!firstTitle || firstTitle.value.trim().toLowerCase() !== 'business permit') {
                    e.preventDefault();
                    showErrorModal(['The first document type must be Business Permit.']);
                    return;
                }

                const imageInputs = container.querySelectorAll('.document-images-input');
                for (const inp of imageInputs) {
                    if ((inp._selectedFiles || []).length > 3) {
                        e.preventDefault();
                        showErrorModal(['Each document type can only have up to 3 images.']);
                        return;
                    }

                    const invalidSize = (inp._selectedFiles || []).find((file) => file.size > maxFileSize);
                    if (invalidSize) {
                        e.preventDefault();
                        showErrorModal([`${invalidSize.name} is larger than 20MB.`]);
                        return;
                    }
                }

                e.preventDefault();
                openModal(confirmModal);
            });
        }

        if (errorModalCloseBtn) {
            errorModalCloseBtn.addEventListener('click', () => closeModal(errorModal));
        }

        if (confirmCancelBtn) {
            confirmCancelBtn.addEventListener('click', () => closeModal(confirmModal));
        }

        if (confirmProceedBtn && form) {
            confirmProceedBtn.addEventListener('click', () => {
                closeModal(confirmModal);
                submitConfirmed = true;
                form.requestSubmit();
            });
        }

        [errorModal, confirmModal].forEach((modal) => {
            if (!modal) return;
            modal.addEventListener('click', (event) => {
                if (event.target === modal) closeModal(modal);
            });
        });

        if (submissionPrompt) {
            submissionPrompt.addEventListener('click', (event) => {
                if (event.target === submissionPrompt) {
                    stayViewOnly();
                }
            });
        }

        const serverErrors = @json($errors->all());
        if (Array.isArray(serverErrors) && serverErrors.length) {
            showErrorModal(serverErrors);
        }
    });
    </script>
@endsection