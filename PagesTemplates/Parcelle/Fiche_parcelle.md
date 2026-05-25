<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Système Foncier Glo - Détail Parcelle</title>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Config -->
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed-variant": "#00497c",
                        "surface-tint": "#35618d",
                        "surface-container-lowest": "#ffffff",
                        "primary": "#00375e",
                        "tertiary-container": "#5a20c3",
                        "surface-bright": "#f8f9ff",
                        "on-primary": "#ffffff",
                        "background": "#f8f9ff",
                        "on-secondary-fixed": "#001d36",
                        "on-surface": "#0b1c30",
                        "inverse-surface": "#213145",
                        "inverse-on-surface": "#eaf1ff",
                        "tertiary-fixed": "#e9ddff",
                        "tertiary-fixed-dim": "#d0bcff",
                        "surface-container-high": "#dce9ff",
                        "primary-fixed": "#d1e4ff",
                        "outline": "#72777f",
                        "primary-fixed-dim": "#a0cafc",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#d1e4ff",
                        "on-error": "#ffffff",
                        "surface": "#f8f9ff",
                        "secondary-fixed-dim": "#9ecaff",
                        "inverse-primary": "#a0cafc",
                        "surface-dim": "#cbdbf5",
                        "surface-container-highest": "#d3e4fe",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#42474f",
                        "surface-container": "#e5eeff",
                        "on-tertiary": "#ffffff",
                        "secondary": "#0b61a1",
                        "on-error-container": "#93000a",
                        "surface-container-low": "#eff4ff",
                        "on-background": "#0b1c30",
                        "outline-variant": "#c2c7d0",
                        "on-tertiary-fixed": "#23005c",
                        "on-tertiary-fixed-variant": "#5516be",
                        "on-primary-container": "#95bff1",
                        "on-tertiary-container": "#c7b0ff",
                        "error-container": "#ffdad6",
                        "on-secondary-container": "#004a7d",
                        "on-primary-fixed": "#001d35",
                        "primary-container": "#1f4e79",
                        "secondary-container": "#7cbaff",
                        "on-primary-fixed-variant": "#184974",
                        "surface-variant": "#d3e4fe",
                        "tertiary": "#41009d"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "3rem",
                        "sm": "1rem",
                        "md": "1.5rem",
                        "lg": "2rem",
                        "xs": "0.5rem",
                        "gutter": "24px",
                        "margin-desktop": "40px",
                        "margin-mobile": "16px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "label-sm": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "title-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "display-lg": ["48px", { "lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
        
        .bento-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            border-radius: 0.5rem;
            transition: box-shadow 0.3s ease;
        }
        
        .bento-card:hover {
            box-shadow: 0 8px 20px rgba(31, 78, 121, 0.10);
        }
        
        .map-overlay {
            background: linear-gradient(180deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 100%);
        }
    </style>
</head>
<body class="bg-surface text-on-surface flex h-screen overflow-hidden">
<!-- SideNavBar -->
<nav class="hidden md:flex flex-col h-full py-md docked full-height left-0 w-64 bg-surface-container-low border-r border-outline-variant z-40">
<!-- Header -->
<div class="px-md mb-lg">
<div class="flex items-center gap-3">
<img alt="Logo de l'institution" class="w-10 h-10 rounded-full object-cover" data-alt="A clean, minimalist circular logo graphic suitable for a modern government land administration portal. The design features subtle geometric shapes in Deep Slate Blue and white, conveying trust and official authority. High-key lighting, corporate aesthetic, isolated on a white background." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCq2BSMpZGsLiCP7rSPuVrnXVnfD5JeYCqbwbRo81Gg6HQI7A_RgKB0rQbFLN9UCLXCgMY4DPfmSW97r-SWR0Nh1A42e3hG8MMP0rrtutLUSE3_AxNf3x0yYCo8zUSjJqnUuwk54OExL3biOT9lUVxNhHEj-KJthZpJRIxGlTdiKw6UgDDfZ-YoE2INoyhmSH-bdqYEYsr4U-0e7-SIPjN2kdUpDKbNgr2cEZSAO71ur4hGQzUdRBceetu8QjCqWh-gDr-VpA7yPNSj"/>
<div>
<h1 class="font-headline-md text-headline-md font-black text-primary">Portail Foncier</h1>
<p class="font-label-sm text-label-sm text-on-surface-variant">République du Bénin</p>
</div>
</div>
</div>
<!-- Navigation Links -->
<ul class="flex flex-col gap-2 flex-grow">
<li>
<a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high rounded-lg px-4 py-3 mx-2 hover:bg-surface-variant transition-all scale-95 duration-200" href="#">
<span class="material-symbols-outlined">home</span>
<span class="font-label-md text-label-md">Accueil</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 bg-secondary-container text-on-secondary-container rounded-lg px-4 py-3 mx-2 hover:bg-surface-variant transition-all scale-95 duration-200" href="#">
<span class="material-symbols-outlined">domain</span>
<span class="font-label-md text-label-md">Propriétés</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high rounded-lg px-4 py-3 mx-2 hover:bg-surface-variant transition-all scale-95 duration-200" href="#">
<span class="material-symbols-outlined">assignment</span>
<span class="font-label-md text-label-md">Demandes</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high rounded-lg px-4 py-3 mx-2 hover:bg-surface-variant transition-all scale-95 duration-200" href="#">
<span class="material-symbols-outlined">folder_open</span>
<span class="font-label-md text-label-md">Documents</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-high rounded-lg px-4 py-3 mx-2 hover:bg-surface-variant transition-all scale-95 duration-200" href="#">
<span class="material-symbols-outlined">help_outline</span>
<span class="font-label-md text-label-md">Aide</span>
</a>
</li>
</ul>
<!-- CTA -->
<div class="px-md mt-auto">
<button class="w-full bg-primary-container text-on-primary rounded-lg py-3 font-label-md text-label-md hover:bg-opacity-90 transition-colors shadow-sm flex items-center justify-center gap-2">
<span class="material-symbols-outlined">add</span>
                Nouvelle Demande
            </button>
</div>
</nav>
<!-- Main Content Area -->
<main class="flex-grow flex flex-col h-full overflow-y-auto">
<!-- Header TopAppBar for Mobile (Hidden on Desktop) -->
<header class="md:hidden flex justify-between items-center w-full px-margin-mobile py-sm bg-surface sticky top-0 z-50 border-b border-outline-variant shadow-sm">
<h1 class="font-headline-md text-headline-md font-bold text-primary">Portail Foncier</h1>
<button class="text-on-surface-variant">
<span class="material-symbols-outlined">menu</span>
</button>
</header>
<div class="p-margin-mobile md:p-margin-desktop max-w-[1440px] mx-auto w-full flex flex-col gap-lg">
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bento-card p-md">
<div>
<div class="flex items-center gap-3 mb-1">
<h2 class="font-headline-lg text-headline-lg text-primary">Fiche Parcelle</h2>
<span class="bg-[#D1FAE5] text-[#065F46] px-3 py-1 rounded-full font-label-sm text-label-sm flex items-center gap-1 border border-[#34D399]">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
                            Validé
                        </span>
</div>
<p class="font-title-lg text-title-lg text-on-surface-variant">REF-GLO-882</p>
</div>
<div class="flex gap-3">
<button class="flex items-center gap-2 px-4 py-2 border border-primary-container text-primary-container rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined text-[18px]">print</span>
                        Imprimer
                    </button>
<button class="flex items-center gap-2 px-4 py-2 bg-primary-container text-on-primary rounded-lg font-label-md text-label-md hover:bg-opacity-90 transition-colors shadow-sm">
<span class="material-symbols-outlined text-[18px]">edit</span>
                        Modifier
                    </button>
</div>
</div>
<!-- Two Column Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Left Column: Data Grid (5 columns on desktop) -->
<div class="lg:col-span-5 flex flex-col gap-gutter">
<!-- Informations du Propriétaire -->
<div class="bento-card p-md">
<div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant">
<h3 class="font-title-lg text-title-lg text-primary flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container">person</span>
                                Informations du Propriétaire
                            </h3>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div>
<p class="font-label-sm text-label-sm text-outline mb-1">Nom complet</p>
<p class="font-body-md text-body-md text-on-surface font-medium">Jean Dupont</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-outline mb-1">Statut</p>
<p class="font-body-md text-body-md text-on-surface">Personne Physique</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-outline mb-1">IFU</p>
<p class="font-body-md text-body-md text-on-surface font-mono">1234567890123</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-outline mb-1">Contact</p>
<p class="font-body-md text-body-md text-on-surface">+229 90 00 00 00</p>
</div>
<div class="sm:col-span-2">
<p class="font-label-sm text-label-sm text-outline mb-1">Adresse</p>
<p class="font-body-md text-body-md text-on-surface">Quartier Gbèdjromèdé, Lot 145, Cotonou, Bénin</p>
</div>
</div>
</div>
<!-- Références Légales -->
<div class="bento-card p-md">
<div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant">
<h3 class="font-title-lg text-title-lg text-primary flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container">gavel</span>
                                Références Légales
                            </h3>
</div>
<div class="space-y-4">
<div class="flex justify-between items-center py-2 border-b border-surface-container-high last:border-0">
<span class="font-label-md text-label-md text-on-surface-variant">Numéro de Titre Foncier</span>
<span class="font-body-md text-body-md text-on-surface font-semibold">TF-992-ABC</span>
</div>
<div class="flex justify-between items-center py-2 border-b border-surface-container-high last:border-0">
<span class="font-label-md text-label-md text-on-surface-variant">Date d'enregistrement</span>
<span class="font-body-md text-body-md text-on-surface">12 Octobre 2023</span>
</div>
<div class="flex justify-between items-center py-2 border-b border-surface-container-high last:border-0">
<span class="font-label-md text-label-md text-on-surface-variant">Type d'acte</span>
<span class="font-body-md text-body-md text-on-surface">Vente Définitive</span>
</div>
<div class="flex justify-between items-center py-2 border-b border-surface-container-high last:border-0">
<span class="font-label-md text-label-md text-on-surface-variant">Superficie</span>
<span class="font-body-md text-body-md text-on-surface">500 m²</span>
</div>
</div>
</div>
<!-- Historique de Propriété -->
<div class="bento-card p-md">
<div class="flex items-center justify-between mb-4 pb-2 border-b border-outline-variant">
<h3 class="font-title-lg text-title-lg text-primary flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container">history</span>
                                Historique de Propriété
                            </h3>
</div>
<div class="relative pl-6 space-y-6 before:absolute before:inset-y-0 before:left-2 before:w-px before:bg-outline-variant">
<!-- Current Owner -->
<div class="relative">
<div class="absolute -left-[29px] top-1 w-3 h-3 bg-primary-container rounded-full border-2 border-white shadow-sm ring-2 ring-primary-container ring-opacity-20"></div>
<p class="font-label-sm text-label-sm text-primary font-bold mb-1">Depuis Octobre 2023</p>
<p class="font-body-md text-body-md text-on-surface font-medium">Jean Dupont</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Transfert par Vente</p>
</div>
<!-- Previous Owner 1 -->
<div class="relative">
<div class="absolute -left-[29px] top-1 w-3 h-3 bg-outline-variant rounded-full border-2 border-white"></div>
<p class="font-label-sm text-label-sm text-outline font-semibold mb-1">Mars 2018 - Oct 2023</p>
<p class="font-body-md text-body-md text-on-surface-variant font-medium">Marie Kouassi</p>
<p class="font-label-sm text-label-sm text-outline">Héritage</p>
</div>
<!-- Previous Owner 2 -->
<div class="relative">
<div class="absolute -left-[29px] top-1 w-3 h-3 bg-outline-variant rounded-full border-2 border-white"></div>
<p class="font-label-sm text-label-sm text-outline font-semibold mb-1">Juin 2005 - Mars 2018</p>
<p class="font-body-md text-body-md text-on-surface-variant font-medium">Paul Dossou</p>
<p class="font-label-sm text-label-sm text-outline">Attribution Domaniale</p>
</div>
</div>
</div>
</div>
<!-- Right Column: Interactive Map (7 columns on desktop) -->
<div class="lg:col-span-7 flex flex-col h-full min-h-[500px]">
<div class="bento-card p-2 h-full flex flex-col relative overflow-hidden group">
<!-- Map Toolbar (Overlay) -->
<div class="absolute top-4 left-4 right-4 z-10 flex justify-between items-start pointer-events-none">
<div class="bg-white/90 backdrop-blur-sm p-2 rounded-lg shadow-sm border border-outline-variant pointer-events-auto flex items-center gap-2">
<span class="material-symbols-outlined text-on-surface-variant">map</span>
<span class="font-label-md text-label-md text-on-surface font-medium">Vue Satellite</span>
</div>
<div class="flex flex-col gap-2 pointer-events-auto">
<button class="w-10 h-10 bg-white rounded-lg shadow-sm border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined">add</span>
</button>
<button class="w-10 h-10 bg-white rounded-lg shadow-sm border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined">remove</span>
</button>
<button class="w-10 h-10 bg-white rounded-lg shadow-sm border border-outline-variant flex items-center justify-center text-on-surface mt-2 hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined">my_location</span>
</button>
<button class="w-10 h-10 bg-white rounded-lg shadow-sm border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined">layers</span>
</button>
</div>
</div>
<!-- Simulated Map Container -->
<div class="w-full h-full rounded bg-surface-container-high relative overflow-hidden" data-alt="A highly detailed satellite view map showing a semi-urban landscape with visible roads, vegetation, and building footprints. The color palette features earthy greens, browns, and gray infrastructure. The scene is bright and clear, simulating a high-resolution GIS interface used for cadastral mapping. The aesthetic is clean, technical, and professional, characteristic of modern governmental land administration tools." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDkVBwYRY6kWbobYDQ6F0DvjxxMuONpN-zDAL7t0xrXDdWRuuBIXug9Erzp0ufbEtuOKuqbovEo35gbR4ryTux1xXaNNQvcqVNjdqRQfJcAgyonLlqpSHRkqHVFuU5KeFlLv000AovVche-KN8rXOehTYi0R78fM_3JngM4oG-WrJM_Rn6TuC-j2OJdfqt-NCTzluUhK6ynenPpCgWme7Y0_fPh-eGVdgZBy-kVroDl33TvIFYqinjvIsCdj3_dmWkUkIguAGhHBQoP'); background-size: cover; background-position: center;">
<!-- Overlay to make it look more like a UI map -->
<div class="absolute inset-0 bg-primary/5 mix-blend-multiply"></div>
<!-- Plot Boundary Polygon SVG Overlay -->
<svg class="absolute inset-0 w-full h-full pointer-events-none" preserveaspectratio="none" viewbox="0 0 100 100">
<!-- Simulated glowing blue polygon for the plot -->
<polygon class="animate-pulse" fill="rgba(46, 117, 182, 0.2)" points="35,40 60,35 70,60 40,65" stroke="#2E75B6" stroke-width="0.5"></polygon>
</svg>
<!-- Red Pin Marker -->
<div class="absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-full flex flex-col items-center">
<span class="material-symbols-outlined text-[#EF4444] text-[40px] drop-shadow-md" style="font-variation-settings: 'FILL' 1;">location_on</span>
<!-- Shadow under pin -->
<div class="w-4 h-1 bg-black/30 rounded-full blur-[2px] mt-[-5px]"></div>
</div>
<!-- Plot Coordinates Card (Bottom overlay) -->
<div class="absolute bottom-4 left-4 right-4 z-10 pointer-events-none flex justify-center">
<div class="bg-white/95 backdrop-blur-md p-3 rounded-lg shadow-md border border-outline-variant pointer-events-auto flex items-center gap-4 w-fit max-w-full overflow-hidden">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container text-[20px]">explore</span>
<div>
<p class="font-label-sm text-label-sm text-outline text-[10px]">Coordonnées (Centre)</p>
<p class="font-label-md text-label-md text-on-surface font-mono text-sm">6.3667° N, 2.4333° E</p>
</div>
</div>
<div class="w-px h-8 bg-outline-variant hidden sm:block"></div>
<div class="hidden sm:flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container text-[20px]">square_foot</span>
<div>
<p class="font-label-sm text-label-sm text-outline text-[10px]">Périmètre</p>
<p class="font-label-md text-label-md text-on-surface font-mono text-sm">85.4 m</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
</body></html>