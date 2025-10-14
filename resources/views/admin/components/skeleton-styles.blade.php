<style>
/* Skeleton Editor Styles */

/* Content nodes in skeleton view */
[data-content-key] {
    position: relative;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 2px solid transparent;
    border-radius: 4px;
    padding: 2px 4px;
    margin: 1px;
    min-height: 20px;
    display: inline-block;
}

/* Text content nodes */
[data-content-key][data-content-type="text"] {
    background: rgba(59, 130, 246, 0.1);
    border-color: rgba(59, 130, 246, 0.3);
}

[data-content-key][data-content-type="text"]:hover {
    background: rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.6);
    transform: scale(1.02);
}

/* Image content nodes */
[data-content-key][data-content-type="image"] {
    background: rgba(34, 197, 94, 0.1);
    border-color: rgba(34, 197, 94, 0.3);
}

[data-content-key][data-content-type="image"]:hover {
    background: rgba(34, 197, 94, 0.2);
    border-color: rgba(34, 197, 94, 0.6);
    transform: scale(1.02);
}

/* Content updated animation */
.content-updated {
    animation: contentUpdate 2s ease-out;
}

@keyframes contentUpdate {
    0% {
        background: rgba(34, 197, 94, 0.4);
        border-color: rgba(34, 197, 94, 0.8);
        transform: scale(1.05);
    }
    100% {
        background: transparent;
        border-color: transparent;
        transform: scale(1);
    }
}

/* Hover tooltip */
[data-content-key]:hover::before {
    content: attr(data-content-key) ' (' attr(data-content-type) ')';
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    white-space: nowrap;
    z-index: 1000;
    pointer-events: none;
}

/* Hover tooltip arrow */
[data-content-key]:hover::after {
    content: '';
    position: absolute;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 6px solid rgba(0, 0, 0, 0.9);
    z-index: 1000;
    pointer-events: none;
}

/* Skeleton page specific styles */
.skeleton-editor {
    background: #0f0f0f;
    min-height: 100vh;
    color: #fff;
}

.skeleton-header {
    background: rgba(23, 23, 23, 0.9);
    border-bottom: 1px solid #374151;
    padding: 1rem 2rem;
    position: sticky;
    top: 0;
    z-index: 100;
    backdrop-filter: blur(8px);
}

.skeleton-nav {
    position: sticky;
    top: 80px; /* Below the header */
    z-index: 99;
    backdrop-filter: blur(8px);
}

.skeleton-content {
    padding: 2rem;
}

/* Section headers */
.section-header {
    border-bottom: 2px solid rgba(156, 163, 175, 0.3);
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
}

.section-header h2 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Section highlight animation */
.bg-white\/10 {
    background-color: rgba(255, 255, 255, 0.1) !important;
    transition: background-color 2s ease-out;
}

/* Completion summary */
.completion-summary {
    margin-top: 2rem;
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mode indicator */
.skeleton-mode-indicator {
    position: fixed;
    top: 20px;
    right: 20px;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 1001;
    backdrop-filter: blur(4px);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Skeleton instructions */
.skeleton-instructions {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 24px;
    color: #ddd;
}

.skeleton-instructions h3 {
    color: #60a5fa;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 600;
}

.skeleton-instructions ul {
    list-style: disc;
    margin-left: 20px;
    font-size: 13px;
    line-height: 1.5;
}

.skeleton-instructions li {
    margin-bottom: 4px;
}

/* Empty content placeholder */
[data-content-key]:empty::before {
    content: '[Click to edit: ' attr(data-content-key) ']';
    color: #9ca3af;
    font-style: italic;
    font-size: 12px;
}

/* Content type badges in skeleton */
.content-type-badge {
    display: inline-block;
    background: rgba(75, 85, 99, 0.8);
    color: #e5e7eb;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 500;
    margin-left: 4px;
    vertical-align: super;
}

/* Text content badge */
[data-content-type="text"] .content-type-badge {
    background: rgba(59, 130, 246, 0.8);
    color: #dbeafe;
}

/* Image content badge */
[data-content-type="image"] .content-type-badge {
    background: rgba(34, 197, 94, 0.8);
    color: #dcfce7;
}

/* Loading overlay for skeleton */
.skeleton-loading {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.skeleton-loading .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(239, 68, 68, 0.3);
    border-top: 4px solid #ef4444;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .skeleton-header {
        padding: 1rem;
    }
    
    .skeleton-content {
        padding: 1rem;
    }
    
    [data-content-key]:hover::before {
        font-size: 10px;
        padding: 2px 6px;
    }
}

/* Dark mode optimizations */
@media (prefers-color-scheme: dark) {
    [data-content-key]:hover::before {
        background: rgba(255, 255, 255, 0.9);
        color: black;
    }
    
    [data-content-key]:hover::after {
        border-top-color: rgba(255, 255, 255, 0.9);
    }
}

/* Print styles (hide editing elements when printing) */
@media print {
    [data-content-key] {
        border: none !important;
        background: transparent !important;
        cursor: default !important;
    }
    
    [data-content-key]:hover::before,
    [data-content-key]:hover::after,
    .skeleton-mode-indicator,
    .skeleton-instructions {
        display: none !important;
    }
}
</style>