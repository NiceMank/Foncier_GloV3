<!DOCTYPE html>

<html lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Système Foncier Glo - Tableau de bord</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface": "#f8f9ff",
                        "secondary": "#0b61a1",
                        "on-tertiary-fixed-variant": "#5516be",
                        "tertiary-container": "#5a20c3",
                        "surface-variant": "#d3e4fe",
                        "surface-container-low": "#eff4ff",
                        "secondary-fixed": "#d1e4ff",
                        "background": "#f8f9ff",
                        "on-background": "#0b1c30",
                        "outline-variant": "#c2c7d0",
                        "surface-container-high": "#dce9ff",
                        "surface-bright": "#f8f9ff",
                        "secondary-fixed-dim": "#9ecaff",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#d0bcff",
                        "on-tertiary-fixed": "#23005c",
                        "primary-fixed": "#d1e4ff",
                        "primary-container": "#1f4e79",
                        "on-primary-container": "#95bff1",
                        "inverse-primary": "#a0cafc",
                        "on-secondary-container": "#004a7d",
                        "on-error": "#ffffff",
                        "tertiary": "#41009d",
                        "primary-fixed-dim": "#a0cafc",
                        "on-error-container": "#93000a",
                        "surface-dim": "#cbdbf5",
                        "inverse-on-surface": "#eaf1ff",
                        "error-container": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#0b1c30",
                        "on-secondary-fixed-variant": "#00497c",
                        "outline": "#72777f",
                        "on-tertiary-container": "#c7b0ff",
                        "inverse-surface": "#213145",
                        "tertiary-fixed": "#e9ddff",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#42474f",
                        "surface-tint": "#35618d",
                        "surface-container": "#e5eeff",
                        "error": "#ba1a1a",
                        "on-primary-fixed-variant": "#184974",
                        "on-secondary-fixed": "#001d36",
                        "surface-container-highest": "#d3e4fe",
                        "primary": "#00375e",
                        "secondary-container": "#7cbaff",
                        "on-primary-fixed": "#001d35",
                        "on-secondary": "#ffffff",
                        "brand-blue": "#2E75B6",
                        "status-green": "#10B981",
                        "status-green-bg": "rgba(16, 185, 129, 0.1)"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "1.5rem",
                        "base": "4px",
                        "xs": "0.5rem",
                        "sm": "1rem",
                        "lg": "2rem",
                        "gutter": "24px",
                        "xl": "3rem",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px"
                    },
                    "fontFamily": {
                        "label-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg-mobile": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "title-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "label-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "display-lg": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    "fontSize": {
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700" }]
                    },
                    "boxShadow": {
                        "level-1": "0 4px 12px rgba(31, 78, 121, 0.05)",
                        "level-2": "0 8px 20px rgba(31, 78, 121, 0.10)"
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bento-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            border-radius: 0.75rem;
            transition: box-shadow 0.2s ease-in-out;
        }
        .bento-card:hover {
            box-shadow: 0 8px 20px rgba(31, 78, 121, 0.10);
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen">
<!-- Top Navigation (Hidden on Mobile, visible md+) -->
<header class="hidden md:flex justify-between items-center px-margin-desktop w-full max-w-full sticky top-0 z-50 bg-surface dark:bg-surface-container-high h-16 shadow-sm dark:shadow-none border-b border-outline-variant">
<div class="flex items-center gap-lg">
<div class="font-headline-md text-headline-md text-primary dark:text-inverse-primary tracking-tight">Système Foncier Glo</div>
<nav class="flex gap-md">
<a class="text-primary dark:text-inverse-primary font-bold border-b-2 border-primary font-label-md text-label-md pb-5 mt-5" href="#">Tableau de bord</a>
<a class="text-on-surface-variant dark:text-outline hover:text-primary transition-colors font-label-md text-label-md pb-5 mt-5" href="#">Mes Titres</a>
<a class="text-on-surface-variant dark:text-outline hover:text-primary transition-colors font-label-md text-label-md pb-5 mt-5" href="#">Transferts</a>
<a class="text-on-surface-variant dark:text-outline hover:text-primary transition-colors font-label-md text-label-md pb-5 mt-5" href="#">Assistance</a>
</nav>
</div>
<div class="flex items-center gap-sm">
<button class="p-2 hover:bg-surface-container-low dark:hover:bg-surface-container-highest rounded-lg active:scale-95 transition-transform duration-200 text-on-surface-variant">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="p-2 hover:bg-surface-container-low dark:hover:bg-surface-container-highest rounded-lg active:scale-95 transition-transform duration-200 text-on-surface-variant mr-xs">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
</button>
<div class="flex items-center gap-xs cursor-pointer hover:bg-surface-container-low p-1 rounded-lg">
<img alt="User profile avatar" class="w-8 h-8 rounded-full" data-alt="A professional headshot of a confident African man in his late 30s wearing a modern business casual outfit. He has a warm smile, well-groomed beard, and short hair. The lighting is bright and even, casting soft shadows. The background is a slightly blurred, light-colored modern office setting, contributing to a clean, trustworthy, and corporate tech aesthetic suitable for a secure government portal." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDISppw_lVzcOHs4n-EFWdWRXj4P32dpiAuLhBHw5vqned-l3lG3idCz_aU8NVr9gj7i0xeCQv8z60APpU-vxts91KkPHWGYpxZUO9xRueCZv40Nq32bRC4_ujP2bBq9YeY1GyYeCeqd8b_4WlgB9uiQ-3rAb3ueY_RC8vfdLnAhojEyFY9iBr0I965Hv77AF5esJt0_FNQmxSX-zfoV4YfyJVBob-h-T80pNzkC8ld5uTiRjxPdFAF7NlylGptkSMasAsSXel69kpB"/>
<span class="font-label-md text-label-md font-semibold">M. Koffi</span>
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="px-margin-mobile md:px-margin-desktop py-lg pb-24 md:pb-lg max-w-[1440px] mx-auto">
<!-- Bento Grid Layout -->
<div class="grid grid-cols-4 md:grid-cols-12 gap-gutter">
<!-- Welcome Widget (Top Left, Spans 8 cols on desktop) -->
<div class="bento-card col-span-4 md:col-span-8 p-md flex flex-col justify-between">
<div>
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-xs">Bonjour, M. Koffi</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Voici un aperçu de vos propriétés enregistrées et de vos démarches en cours.</p>
</div>
<div class="flex gap-md mt-lg">
<div class="bg-surface-container-low rounded-lg p-sm border border-outline-variant flex-1">
<div class="font-label-sm text-label-sm text-on-surface-variant mb-1 uppercase tracking-wider">Parcelles Enregistrées</div>
<div class="font-headline-md text-headline-md text-primary">3</div>
</div>
<div class="bg-surface-container-low rounded-lg p-sm border border-outline-variant flex-1">
<div class="font-label-sm text-label-sm text-on-surface-variant mb-1 uppercase tracking-wider">Litiges</div>
<div class="font-headline-md text-headline-md text-status-green">0</div>
</div>
</div>
</div>
<!-- Action Widget (Top Right, Spans 4 cols on desktop) -->
<div class="bento-card col-span-4 md:col-span-4 p-md flex flex-col justify-center items-center text-center bg-surface-container-low">
<div class="w-16 h-16 bg-surface rounded-full flex items-center justify-center mb-sm shadow-sm">
<span class="material-symbols-outlined text-primary text-3xl" data-icon="add_business">add_business</span>
</div>
<h2 class="font-title-lg text-title-lg text-primary mb-2">Nouvelle Démarche</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-md">Initiez une transaction ou modifiez vos titres fonciers en toute sécurité.</p>
<button class="w-full py-3 px-4 bg-brand-blue text-on-primary font-label-md text-label-md rounded-lg hover:bg-opacity-90 active:scale-95 transition-all shadow-sm font-semibold">
                    + Initier une vente / Transfert
                </button>
</div>
<!-- Section Title for Grid -->
<div class="col-span-4 md:col-span-12 mt-4 mb-2 flex justify-between items-end">
<h3 class="font-title-lg text-title-lg text-primary">Mes Parcelles Récentes</h3>
<a class="font-label-md text-label-md text-brand-blue hover:underline" href="#">Voir tout</a>
</div>
<!-- Parcel Card 1 -->
<div class="bento-card col-span-4 md:col-span-6 p-md flex flex-col md:flex-row gap-sm items-start">
<div class="w-full md:w-32 h-32 bg-gray-200 rounded-lg overflow-hidden shrink-0">
<img alt="Map thumbnail" class="w-full h-full object-cover" data-alt="A clean, minimalist satellite map view showing an urban grid with a highlighted rectangular land plot outlined in a bright, tech-blue stroke. The map colors are muted pastels and soft grays, fitting a modern government dashboard aesthetic. The lighting is flat and analytical, with no harsh shadows, ensuring clarity and precision for cadastral data visualization." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8B_Wu9PhO9svwqb1d8ErCd9qBabPT57GE-GGiHLxV7lqtUc7hhFg1kLAPC-qC_zpdLHB6Z75SUtyZ7c7vcfVRyAnQSuvBm001Ed61m9D4CphKdlkJGrlUFovDJUOqfbacDRIqxV8iaPFwuZ2JWFV3BGbo1xs2brHMhXlbVH5jQewBN0I9cOY_I6SLT2tJIiLbAISbckv0adDXf_ErUpCmY9hmoTOy-cmar8pw3KP9o3ujJ1X5_E4egKwg_AS_fWlUzU9GQPnCOIX_"/>
</div>
<div class="flex flex-col flex-grow justify-between h-full w-full">
<div class="flex justify-between items-start mb-2">
<div>
<div class="font-label-sm text-label-sm text-on-surface-variant uppercase">Réf. Cadastrale</div>
<div class="font-title-lg text-title-lg text-primary font-bold">REF-GLO-045</div>
</div>
<div class="bg-[#10B981]/10 text-status-green px-2 py-1 rounded text-[12px] font-semibold flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]" data-icon="check_circle">check_circle</span> Propriété Validée
                        </div>
</div>
<div class="text-on-surface-variant font-body-md text-body-md mb-3">
                        Quartier Résidentiel, Cotonou
                    </div>
<div class="flex justify-between items-end mt-auto">
<div>
<div class="font-label-sm text-label-sm text-outline">Superficie</div>
<div class="font-label-md text-label-md font-semibold">0.45 ha</div>
</div>
<button class="text-brand-blue border border-brand-blue hover:bg-brand-blue/5 px-3 py-1.5 rounded-lg font-label-md text-label-md transition-colors">
                            Détails
                        </button>
</div>
</div>
</div>
<!-- Parcel Card 2 -->
<div class="bento-card col-span-4 md:col-span-6 p-md flex flex-col md:flex-row gap-sm items-start">
<div class="w-full md:w-32 h-32 bg-gray-200 rounded-lg overflow-hidden shrink-0">
<img alt="Map thumbnail" class="w-full h-full object-cover" data-alt="A detailed digital map interface showing a suburban land parcel demarcated with precise white dashed lines over a muted green and gray satellite image. The overall tone is clinical, secure, and modern, utilizing a soft light mode color palette suitable for an official government land registry application. Minimalist UI elements overlay the map subtly." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBj7vkIb_jYFDOCqTJWcNlCdAtVVaVJhZj5an1zw5gwmlyCQCaqk9r14mnfaDdsXwH4Vhf7mWixWxO7YmGitMqry9Jy5N26rAkx4I6s6TXbaNjxqm5nPvrB3bvBBrtSpvD1mjMJB1B81aCiL12Ov4-XpO4d7KV0_S_a2XELhY_wWC5aR5sHXyDYVkLF4-nhTqJ1_DT8Q_gkRM5nelVBy3oK6Zj9UGVHDTESmDsogGcQzwtZgHp9-f_5yfIBB4nBslqt-gOxxhU7iowy"/>
</div>
<div class="flex flex-col flex-grow justify-between h-full w-full">
<div class="flex justify-between items-start mb-2">
<div>
<div class="font-label-sm text-label-sm text-on-surface-variant uppercase">Réf. Cadastrale</div>
<div class="font-title-lg text-title-lg text-primary font-bold">REF-GLO-112</div>
</div>
<div class="bg-[#10B981]/10 text-status-green px-2 py-1 rounded text-[12px] font-semibold flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]" data-icon="check_circle">check_circle</span> Propriété Validée
                        </div>
</div>
<div class="text-on-surface-variant font-body-md text-body-md mb-3">
                        Zone Commerciale, Abomey-Calavi
                    </div>
<div class="flex justify-between items-end mt-auto">
<div>
<div class="font-label-sm text-label-sm text-outline">Superficie</div>
<div class="font-label-md text-label-md font-semibold">1.20 ha</div>
</div>
<button class="text-brand-blue border border-brand-blue hover:bg-brand-blue/5 px-3 py-1.5 rounded-lg font-label-md text-label-md transition-colors">
                            Détails
                        </button>
</div>
</div>
</div>
<!-- Bottom Section: History Stepper (Spans full width) -->
<div class="bento-card col-span-4 md:col-span-12 p-md mt-4">
<h3 class="font-title-lg text-title-lg text-primary mb-md">Historique des demandes (Récentes)</h3>
<div class="flex flex-col md:flex-row items-center md:items-start w-full relative">
<!-- Stepper Line for desktop -->
<div class="hidden md:block absolute top-4 left-[10%] right-[10%] h-0.5 bg-outline-variant z-0"></div>
<!-- Step 1: Soumis (Completed) -->
<div class="flex-1 flex flex-col items-center relative z-10 w-full mb-4 md:mb-0">
<div class="w-8 h-8 rounded-full bg-status-green text-on-primary flex items-center justify-center mb-2 shadow-sm">
<span class="material-symbols-outlined text-[18px]" data-icon="check">check</span>
</div>
<div class="font-label-md text-label-md font-semibold text-primary text-center">Soumis</div>
<div class="font-label-sm text-label-sm text-on-surface-variant text-center">12 Oct 2023</div>
</div>
<!-- Desktop connector active -->
<div class="hidden md:block absolute top-4 left-[10%] w-[30%] h-0.5 bg-status-green z-0"></div>
<!-- Step 2: En cours (Active) -->
<div class="flex-1 flex flex-col items-center relative z-10 w-full mb-4 md:mb-0">
<div class="w-8 h-8 rounded-full bg-surface border-2 border-brand-blue text-brand-blue flex items-center justify-center mb-2 shadow-sm">
<span class="w-2 h-2 rounded-full bg-brand-blue"></span>
</div>
<div class="font-label-md text-label-md font-bold text-brand-blue text-center">En cours de vérification</div>
<div class="font-label-sm text-label-sm text-on-surface-variant text-center">Estimation: 3 jours</div>
</div>
<!-- Step 3: Validation (Pending) -->
<div class="flex-1 flex flex-col items-center relative z-10 w-full mb-4 md:mb-0 opacity-50">
<div class="w-8 h-8 rounded-full bg-surface border-2 border-outline-variant text-outline-variant flex items-center justify-center mb-2">
</div>
<div class="font-label-md text-label-md font-medium text-on-surface-variant text-center">Validation</div>
</div>
<!-- Step 4: Terminé (Pending) -->
<div class="flex-1 flex flex-col items-center relative z-10 w-full opacity-50">
<div class="w-8 h-8 rounded-full bg-surface border-2 border-outline-variant text-outline-variant flex items-center justify-center mb-2">
</div>
<div class="font-label-md text-label-md font-medium text-on-surface-variant text-center">Terminé</div>
</div>
</div>
<div class="mt-md pt-md border-t border-outline-variant flex justify-between items-center bg-surface-container-low p-sm rounded-lg">
<div>
<div class="font-label-md text-label-md font-semibold text-primary">Transfert de titre - REF-GLO-112</div>
<div class="font-label-sm text-label-sm text-on-surface-variant">Dossier #TR-2023-0891</div>
</div>
<button class="text-brand-blue hover:underline font-label-md text-label-md">Voir le dossier</button>
</div>
</div>
</div>
</main>
<!-- BottomNavBar (Visible on Mobile, hidden on md+) -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 md:hidden pb-safe bg-surface dark:bg-surface-container-highest h-16 rounded-t-xl shadow-[0_-4px_12px_rgba(31,78,121,0.05)] border-t border-outline-variant/20">
<a class="flex flex-col items-center justify-center text-primary dark:text-inverse-primary bg-primary-container/30 rounded-full px-4 py-1 active:scale-90 transition-all duration-200" href="#">
<span class="material-symbols-outlined" data-icon="home" data-weight="fill">home</span>
<span class="font-label-sm text-label-sm-mobile mt-1">Accueil</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-outline active:bg-surface-container-high rounded-lg p-1 active:scale-90 transition-all duration-200" href="#">
<span class="material-symbols-outlined" data-icon="map">map</span>
<span class="font-label-sm text-label-sm-mobile mt-1">Mes Terres</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-outline active:bg-surface-container-high rounded-lg p-1 active:scale-90 transition-all duration-200" href="#">
<span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
<span class="font-label-sm text-label-sm-mobile mt-1">Actions</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-outline active:bg-surface-container-high rounded-lg p-1 active:scale-90 transition-all duration-200" href="#">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-label-sm text-label-sm-mobile mt-1">Profil</span>
</a>
</nav>
</body></html>