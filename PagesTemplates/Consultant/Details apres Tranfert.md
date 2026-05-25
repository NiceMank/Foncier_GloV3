<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Suivi de Transaction Foncière - Bénin Cadastre</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
        
        /* Pulse Animation for Active Node */
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.5); opacity: 0; }
        }
        .pulse-indicator::before {
            content: '';
            position: absolute;
            left: -4px;
            top: -4px;
            right: -4px;
            bottom: -4px;
            border-radius: 50%;
            background-color: theme('colors.secondary');
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
            z-index: -1;
        }
    </style>
<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed-variant": "#5516be",
                        "secondary-fixed-dim": "#9ecaff",
                        "secondary-container": "#7cbaff",
                        "on-tertiary-container": "#c7b0ff",
                        "on-secondary-fixed-variant": "#00497c",
                        "primary": "#00375e",
                        "on-primary-fixed": "#001d35",
                        "on-primary-container": "#95bff1",
                        "on-primary": "#ffffff",
                        "surface-tint": "#35618d",
                        "surface-container-highest": "#d3e4fe",
                        "on-background": "#0b1c30",
                        "on-surface-variant": "#42474f",
                        "on-tertiary": "#ffffff",
                        "primary-fixed": "#d1e4ff",
                        "surface-container-high": "#dce9ff",
                        "on-secondary": "#ffffff",
                        "on-surface": "#0b1c30",
                        "primary-fixed-dim": "#a0cafc",
                        "outline-variant": "#c2c7d0",
                        "tertiary-fixed": "#e9ddff",
                        "on-tertiary-fixed": "#23005c",
                        "on-primary-fixed-variant": "#184974",
                        "on-error": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#eaf1ff",
                        "outline": "#72777f",
                        "surface-container-low": "#eff4ff",
                        "inverse-surface": "#213145",
                        "tertiary-container": "#5a20c3",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "background": "#f8f9ff",
                        "on-error-container": "#93000a",
                        "secondary-fixed": "#d1e4ff",
                        "surface-dim": "#cbdbf5",
                        "on-secondary-container": "#004a7d",
                        "primary-container": "#1f4e79",
                        "surface-variant": "#d3e4fe",
                        "tertiary-fixed-dim": "#d0bcff",
                        "surface-bright": "#f8f9ff",
                        "tertiary": "#41009d",
                        "inverse-primary": "#a0cafc",
                        "surface-container": "#e5eeff",
                        "surface": "#f8f9ff",
                        "secondary": "#0b61a1",
                        "on-secondary-fixed": "#001d36",
                        "emerald-custom": "#10b981", // For approved status
                        "amber-custom": "#f59e0b"    // For in progress status
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "1.5rem",
                        "gutter": "24px",
                        "sm": "1rem",
                        "lg": "2rem",
                        "base": "4px",
                        "margin-desktop": "40px",
                        "xs": "0.5rem",
                        "xl": "3rem",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "label-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "title-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="bg-surface border-b border-outline-variant shadow-sm flex justify-between items-center w-full px-margin-desktop py-xs sticky top-0 z-50">
<div class="flex items-center gap-6">
<div class="font-headline-md text-headline-md font-bold text-primary">Benin Cadastre</div>
<nav class="hidden md:flex gap-6">
<a class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md" href="#">Tableau de Bord</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md" href="#">Mes Titres</a>
<a class="text-primary font-bold border-b-2 border-primary pb-1 font-label-md text-label-md" href="#">Transactions</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md" href="#">Support</a>
</nav>
</div>
<div class="flex items-center gap-4">
<button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 transition-colors">
<span class="material-symbols-outlined" data-icon="search">search</span>
</button>
<button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 transition-colors">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
</button>
<img alt="Photo de profil de l'utilisateur" class="w-8 h-8 rounded-full border border-outline-variant ml-2" data-alt="A professional headshot of a user, clean lighting, corporate style, against a neutral light background. High resolution, modern professional aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuByg7iJXRryYfU8M-rS4U2up0-KwLpxDsoCIZ_59OT2Uev8ZbLN2FY0oIYcECQb7T_GYz505OmNhBion4DzyRKIJiQOe-6khv9-6gmHKz3pUHDFjSfu4xtUcE1tbI0IafAJhus3FXhoLh2jK5CjJQQQPU1GdyR7CBRyV7IR3KVq99QojgkD_P9hLtdt2hN3gw2g6Vgi0TSqkHTuAj1rdB0GKkh3PgSjMPbX0eXCFv9CDlwTAJywmVthP3_IHR-iAp8Dwqjx_Xe5yN6j"/>
</div>
</header>
<!-- Main Content Canvas -->
<main class="flex-grow w-full px-margin-desktop py-xl max-w-7xl mx-auto flex flex-col md:flex-row gap-gutter">
<!-- Page Header -->
<div class="w-full mb-md md:hidden">
<h1 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface">Suivi de la Demande</h1>
</div>
<!-- Left Column: Summary Card (Bento Style) -->
<section class="w-full md:w-1/3 flex flex-col gap-md">
<div class="hidden md:block mb-sm">
<h1 class="font-headline-lg text-headline-lg text-on-surface">Détails de la Transaction</h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-xs">Aperçu des informations relatives à votre demande de cession foncière.</p>
</div>
<!-- Bento Card: Details -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-md shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
<!-- Top Decorative Line -->
<div class="absolute top-0 left-0 w-full h-1 bg-primary"></div>
<div class="flex items-center justify-between mb-sm mt-xs">
<h2 class="font-title-lg text-title-lg text-on-surface">Résumé</h2>
<span class="material-symbols-outlined text-primary" data-icon="receipt_long">receipt_long</span>
</div>
<div class="flex flex-col gap-sm mt-md">
<!-- Field 1 -->
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant mb-1">Référence</span>
<div class="font-body-md text-body-md text-on-surface font-medium">TR-2023-0890</div>
</div>
<div class="w-full h-px bg-outline-variant opacity-50"></div>
<!-- Field 2 -->
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant mb-1">ID Parcelle</span>
<div class="font-body-md text-body-md text-on-surface font-medium flex items-center gap-2">
                            REF-GLO-415
                            <span class="material-symbols-outlined text-primary text-[16px]" data-icon="map">map</span>
</div>
</div>
<div class="w-full h-px bg-outline-variant opacity-50"></div>
<!-- Field 3 -->
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant mb-1">Acquéreur</span>
<div class="font-body-md text-body-md text-on-surface font-medium">Société Immobilière BÉNIN</div>
</div>
<div class="w-full h-px bg-outline-variant opacity-50"></div>
<!-- Field 4 -->
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant mb-1">Date de demande</span>
<div class="font-body-md text-body-md text-on-surface font-medium">22 Oct 2023</div>
</div>
</div>
</div>
<!-- Contextual Action (Secondary) -->
<button class="mt-xs w-full bg-transparent border border-primary text-primary font-label-md text-label-md py-2 px-4 rounded-lg hover:bg-surface-container transition-colors flex justify-center items-center gap-2">
<span class="material-symbols-outlined" data-icon="download">download</span>
                Télécharger le reçu
            </button>
</section>
<!-- Right Column: Vertical Timeline -->
<section class="w-full md:w-2/3 flex flex-col">
<div class="hidden md:block mb-sm">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Suivi de la Demande</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-xs">État d'avancement de votre dossier TR-2023-0890.</p>
</div>
<!-- Bento Card: Timeline -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-lg shadow-sm flex-grow">
<div class="relative pl-6 md:pl-8 border-l-2 border-outline-variant ml-3 md:ml-4 flex flex-col gap-xl">
<!-- Stage 1: Completed -->
<div class="relative">
<!-- Node Icon -->
<div class="absolute -left-[37px] md:-left-[41px] top-0 w-6 h-6 md:w-8 md:h-8 rounded-full bg-emerald-custom flex items-center justify-center border-4 border-surface-container-lowest shadow-sm z-10">
<span class="material-symbols-outlined text-on-primary text-[14px] md:text-[16px]" data-icon="check" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<div class="flex flex-col -mt-1">
<h3 class="font-title-lg text-title-lg text-on-surface">Demande Soumise</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Votre dossier a été reçu avec succès.</p>
<span class="font-label-sm text-label-sm text-on-surface-variant opacity-70 mt-2">22 Oct 2023, 10:45</span>
</div>
</div>
<!-- Stage 2: In Progress -->
<div class="relative">
<!-- Connecting Line Override for completed path up to here -->
<div class="absolute -left-[26px] md:-left-[26px] -top-16 bottom-0 w-0.5 bg-emerald-custom h-[120%] z-0"></div>
<!-- Node Icon (Pulsing) -->
<div class="absolute -left-[37px] md:-left-[41px] top-0 w-6 h-6 md:w-8 md:h-8 rounded-full bg-amber-custom flex items-center justify-center border-4 border-surface-container-lowest shadow-sm z-10 pulse-indicator relative">
<span class="material-symbols-outlined text-on-primary text-[14px] md:text-[16px]" data-icon="hourglass_empty" style="font-variation-settings: 'FILL' 1;">hourglass_empty</span>
</div>
<div class="flex flex-col -mt-1 ml-6 md:ml-8">
<div class="inline-flex items-center gap-2 bg-amber-custom bg-opacity-10 text-amber-custom font-label-sm text-label-sm px-2 py-1 rounded w-max mb-2">
<span class="w-1.5 h-1.5 rounded-full bg-amber-custom"></span> En cours
                            </div>
<h3 class="font-title-lg text-title-lg text-on-surface">En cours de traitement par l'Agent</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">L'agent examine actuellement les pièces jointes et la conformité du dossier.</p>
</div>
</div>
<!-- Stage 3: Pending -->
<div class="relative">
<!-- Node Icon -->
<div class="absolute -left-[37px] md:-left-[41px] top-0 w-6 h-6 md:w-8 md:h-8 rounded-full bg-surface-container-highest flex items-center justify-center border-4 border-surface-container-lowest shadow-sm z-10">
<div class="w-2 h-2 rounded-full bg-outline"></div>
</div>
<div class="flex flex-col -mt-1 opacity-60">
<h3 class="font-title-lg text-title-lg text-on-surface">Validation finale par le Chef de Service</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Dernière étape avant la signature officielle.</p>
</div>
</div>
<!-- Stage 4: Pending (Final) -->
<div class="relative">
<!-- Hide bottom border for last item -->
<div class="absolute -left-[26px] md:-left-[26px] top-0 bottom-0 w-0.5 bg-surface-container-lowest h-full z-0 translate-y-6"></div>
<!-- Node Icon -->
<div class="absolute -left-[37px] md:-left-[41px] top-0 w-6 h-6 md:w-8 md:h-8 rounded-full bg-surface-container-highest flex items-center justify-center border-4 border-surface-container-lowest shadow-sm z-10">
<div class="w-2 h-2 rounded-full bg-outline"></div>
</div>
<div class="flex flex-col -mt-1 opacity-60">
<h3 class="font-title-lg text-title-lg text-on-surface">Transfert Effectué</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Le titre foncier sera mis à jour et disponible dans votre espace.</p>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="flex flex-col md:flex-row justify-between items-center w-full px-margin-desktop py-md bg-surface-container-lowest border-t border-outline-variant mt-auto">
<div class="font-label-md text-label-md font-bold text-on-surface mb-4 md:mb-0">
            © 2024 Agence Nationale du Domaine et du Foncier. Tous droits réservés.
        </div>
<div class="flex gap-4">
<a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="#">Conditions d'utilisation</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="#">Politique de confidentialité</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-body-md text-body-md" href="#">Contact</a>
</div>
</footer>
</body></html>