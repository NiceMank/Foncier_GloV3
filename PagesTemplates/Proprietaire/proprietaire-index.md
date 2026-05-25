<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Gestion des Propriétaires - Système Foncier Glo</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-variant": "#d3e4fe",
                    "on-primary-fixed-variant": "#184974",
                    "inverse-on-surface": "#eaf1ff",
                    "surface-container-lowest": "#ffffff",
                    "on-background": "#0b1c30",
                    "surface-bright": "#f8f9ff",
                    "inverse-primary": "#a0cafc",
                    "inverse-surface": "#213145",
                    "on-surface-variant": "#42474f",
                    "tertiary": "#41009d",
                    "primary": "#00375e",
                    "tertiary-fixed": "#e9ddff",
                    "on-tertiary-container": "#c7b0ff",
                    "secondary": "#0b61a1",
                    "background": "#f8f9ff",
                    "secondary-container": "#7cbaff",
                    "error-container": "#ffdad6",
                    "primary-fixed-dim": "#a0cafc",
                    "on-secondary": "#ffffff",
                    "outline-variant": "#c2c7d0",
                    "error": "#ba1a1a",
                    "primary-fixed": "#d1e4ff",
                    "on-surface": "#0b1c30",
                    "surface-container": "#e5eeff",
                    "secondary-fixed-dim": "#9ecaff",
                    "on-secondary-fixed-variant": "#00497c",
                    "surface-tint": "#35618d",
                    "surface": "#f8f9ff",
                    "tertiary-container": "#5a20c3",
                    "surface-container-highest": "#d3e4fe",
                    "surface-container-high": "#dce9ff",
                    "on-tertiary-fixed-variant": "#5516be",
                    "on-tertiary-fixed": "#23005c",
                    "on-secondary-container": "#004a7d",
                    "on-primary-fixed": "#001d35",
                    "secondary-fixed": "#d1e4ff",
                    "primary-container": "#1f4e79",
                    "tertiary-fixed-dim": "#d0bcff",
                    "on-primary-container": "#95bff1",
                    "on-error": "#ffffff",
                    "surface-dim": "#cbdbf5",
                    "on-tertiary": "#ffffff",
                    "on-secondary-fixed": "#001d36",
                    "outline": "#72777f",
                    "on-primary": "#ffffff",
                    "surface-container-low": "#eff4ff",
                    "on-error-container": "#93000a"
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
                    "margin-desktop": "40px",
                    "margin-mobile": "16px",
                    "xs": "0.5rem",
                    "base": "4px",
                    "lg": "2rem",
                    "xl": "3rem"
            },
            "fontFamily": {
                    "headline-lg-mobile": ["Plus Jakarta Sans"],
                    "headline-md": ["Plus Jakarta Sans"],
                    "body-lg": ["Plus Jakarta Sans"],
                    "label-md": ["Plus Jakarta Sans"],
                    "title-lg": ["Plus Jakarta Sans"],
                    "display-lg": ["Plus Jakarta Sans"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "label-sm": ["Plus Jakarta Sans"],
                    "body-md": ["Plus Jakarta Sans"]
            },
            "fontSize": {
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                    "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "display-lg": ["48px", {"lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .bento-card { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05); transition: all 0.2s ease-in-out; }
        .bento-card:hover { box-shadow: 0 8px 20px rgba(31, 78, 121, 0.10); }
        .status-chip-actif { background-color: rgba(16, 185, 129, 0.1); color: #10B981; }
        .status-chip-attente { background-color: rgba(245, 158, 11, 0.1); color: #F59E0B; }
        .table-row-zebra:nth-child(even) { background-color: #f8fafc; }
    </style>
</head>
<body class="text-on-background">
<!-- SideNavBar -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-primary shadow-md flex flex-col py-md z-50">
<div class="px-6 mb-8">
<h1 class="font-headline-md text-headline-md font-bold text-on-primary">ANCFP Benin</h1>
<p class="font-label-md text-label-md text-primary-fixed opacity-70">Land Administration</p>
</div>
<nav class="flex-grow space-y-1">
<a class="flex items-center gap-3 px-4 py-3 text-primary-fixed hover:bg-primary-container hover:text-on-primary-container rounded-lg mx-2 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-primary-fixed hover:bg-primary-container hover:text-on-primary-container rounded-lg mx-2 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="map">map</span>
<span class="font-label-md text-label-md">Parcels</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-secondary-container text-on-secondary-container rounded-lg mx-2" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="font-label-md text-label-md">Owners</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-primary-fixed hover:bg-primary-container hover:text-on-primary-container rounded-lg mx-2 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="swap_horiz">swap_horiz</span>
<span class="font-label-md text-label-md">Transfers</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-primary-fixed hover:bg-primary-container hover:text-on-primary-container rounded-lg mx-2 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="gavel">gavel</span>
<span class="font-label-md text-label-md">Disputes</span>
</a>
</nav>
<div class="mt-auto px-2 space-y-1 border-t border-white/10 pt-4">
<a class="flex items-center gap-3 px-4 py-3 text-primary-fixed hover:bg-primary-container hover:text-on-primary-container rounded-lg transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label-md text-label-md">Settings</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-primary-fixed hover:bg-primary-container hover:text-on-primary-container rounded-lg transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-label-md text-label-md">Support</span>
</a>
</div>
</aside>
<!-- TopNavBar -->
<header class="fixed top-0 right-0 left-64 bg-surface shadow-sm h-16 px-margin-desktop flex justify-between items-center z-40">
<div class="flex items-center gap-4 flex-grow max-w-xl">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
<input class="w-full bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 focus:ring-2 focus:ring-primary font-body-md text-body-md" placeholder="Rechercher par NPI, IFU ou Nom..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4 text-on-surface-variant">
<button class="hover:bg-surface-container-high p-2 rounded-full transition-all">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="hover:bg-surface-container-high p-2 rounded-full transition-all">
<span class="material-symbols-outlined" data-icon="help">help</span>
</button>
</div>
<div class="h-8 w-px bg-outline-variant"></div>
<div class="flex items-center gap-3 cursor-pointer group">
<div class="text-right hidden sm:block">
<p class="font-label-md text-label-md text-on-surface">Jean-Marc Adjahi</p>
<p class="font-label-sm text-label-sm text-outline">Administrateur Senior</p>
</div>
<img alt="User Profile Avatar" class="h-10 w-10 rounded-full border-2 border-primary-container object-cover" data-alt="A professional portrait of a West African government official in a well-lit office setting. He is wearing a crisp white shirt and dark blazer, looking confident and reliable. The lighting is soft and corporate, suggesting a modern and high-integrity government workspace. The background is a clean, minimalist office with subtle blue accents reflecting the ANCFP brand colors." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAnv_9dsO0aO_6CLeK6M3Th-zldf7e7qyXfXtX_xyJYOS8Z4mXOwIOyX7NRQX9La0qKprDPbNn1mlydA6JKJZunbfmImI9vk5z87nvm_0ZrQEA-4RlD-IAZ4no6uQ1OHTzsHn1KrE0HJAkHjCJVDU0ipb9aYH0LPi0lTTmK-9n--D3YThvRPqO65C_gTRcDLIQUQg162l2vh2Y-RM1ZiA8iGwp1iOI70GQk2Ou1w-NDVD4qR55h_5DvmBDUcILtFIKc8nAo5x3_vtI1"/>
</div>
</div>
</header>
<!-- Main Content Area -->
<main class="ml-64 pt-16 min-h-screen px-margin-desktop pb-10">
<!-- Breadcrumbs & Header -->
<div class="mt-8 mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
<div>
<nav class="flex items-center gap-2 text-outline font-label-md text-label-md mb-2">
<span>Tableau de bord</span>
<span class="material-symbols-outlined text-[16px]" data-icon="chevron_right">chevron_right</span>
<span class="text-primary font-semibold">Propriétaires</span>
</nav>
<div class="flex items-center gap-4">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Gestion des Propriétaires</h2>
<span class="px-3 py-1 bg-surface-container-highest text-on-surface-variant rounded-full font-label-md text-label-md">1,284 Total</span>
</div>
</div>
<button class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-lg font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all shadow-md">
<span class="material-symbols-outlined" data-icon="person_add">person_add</span>
                Enregistrer un nouveau propriétaire
            </button>
</div>
<!-- Filter Bar -->
<div class="bento-card p-md flex flex-wrap gap-4 items-center mb-md bg-white">
<div class="flex-grow flex gap-4">
<div class="flex-1 min-w-[200px]">
<label class="block font-label-sm text-label-sm text-outline mb-1.5 ml-1">Recherche globale</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
<input class="w-full border-outline-variant rounded-lg py-2 pl-10 pr-4 focus:border-primary focus:ring-primary font-body-md text-body-md bg-surface-container-low" placeholder="Nom ou NPI..." type="text"/>
</div>
</div>
<div class="w-64">
<label class="block font-label-sm text-label-sm text-outline mb-1.5 ml-1">Arrondissement</label>
<select class="w-full border-outline-variant rounded-lg py-2 px-3 focus:border-primary focus:ring-primary font-body-md text-body-md bg-surface-container-low">
<option>Tous les arrondissements</option>
<option>Cotonou 1</option>
<option>Cotonou 2</option>
<option>Abomey-Calavi</option>
<option>Ouidah</option>
</select>
</div>
<div class="w-56">
<label class="block font-label-sm text-label-sm text-outline mb-1.5 ml-1">Statut du compte</label>
<select class="w-full border-outline-variant rounded-lg py-2 px-3 focus:border-primary focus:ring-primary font-body-md text-body-md bg-surface-container-low">
<option>Tous les statuts</option>
<option>Actif</option>
<option>En attente</option>
<option>Suspendu</option>
</select>
</div>
</div>
<button class="mt-5 flex items-center justify-center gap-2 border border-outline-variant text-on-surface-variant hover:bg-surface-container-low px-4 py-2 rounded-lg font-label-md text-label-md transition-all">
<span class="material-symbols-outlined text-[20px]" data-icon="filter_list">filter_list</span>
                Plus de filtres
            </button>
</div>
<!-- Main Data Table Container -->
<div class="bento-card overflow-hidden bg-white">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead class="bg-surface-container-low border-b border-outline-variant">
<tr>
<th class="px-6 py-4 font-label-md text-label-md text-outline">Propriétaire</th>
<th class="px-6 py-4 font-label-md text-label-md text-outline">Identifiant (NPI/IFU)</th>
<th class="px-6 py-4 font-label-md text-label-md text-outline">Téléphone</th>
<th class="px-6 py-4 font-label-md text-label-md text-outline">Localité</th>
<th class="px-6 py-4 font-label-md text-label-md text-outline">Parcelles</th>
<th class="px-6 py-4 font-label-md text-label-md text-outline">Statut</th>
<th class="px-6 py-4 font-label-md text-label-md text-outline text-right">Actions</th>
</tr>
</thead>
<tbody class="font-body-md text-body-md">
<!-- Table Row 1 -->
<tr class="table-row-zebra border-b border-outline-variant/30 hover:bg-surface-container transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<img alt="Profile" class="h-10 w-10 rounded-full object-cover" data-alt="A professional-looking headshot of a middle-aged man in a traditional West African attire. He is smiling warmly in a bright, modern studio setting with a clean, light-colored background. The image evokes a sense of trustworthy citizenship and administrative clarity in a GovTech context." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqB4g8OpuTNuB2rUsNl4Np2HYkaHzbZ_4mGJ2jWAR07KZsG8BVgVPxYKdI3O-W2WL9-FjfimWDwJOdyMANHJkVKOZI7bVvF7UPm23W0wMBsKjaG_gzuYDSUlpX5vs1I-3pECOQZzK3TZs9YKcoAW-kHwLXgKAF6Xl3qwt0GyiKbJsXuCIqo5SzuSM_tCeIt-TsN1vu9d3IOuJYaaFMIG56ufYIrMgiRrgblkMtmaTN5snJLkuJ07Di8JIqa32QAYdjaiZfgX6euw_1"/>
<div>
<p class="font-semibold text-on-surface">Koffi Mensah</p>
<p class="text-label-sm font-normal text-outline">k.mensah@email.bj</p>
</div>
</div>
</td>
<td class="px-6 py-4 font-mono text-label-md">2010928347120</td>
<td class="px-6 py-4">+229 97 12 34 56</td>
<td class="px-6 py-4">
<p class="text-on-surface">Cotonou 2</p>
<p class="text-label-sm text-outline">Fidjrossè</p>
</td>
<td class="px-6 py-4">
<span class="bg-primary-fixed text-on-primary-fixed-variant px-2 py-0.5 rounded text-label-sm">4 parcelles</span>
</td>
<td class="px-6 py-4">
<span class="status-chip-actif px-3 py-1 rounded-full text-label-sm font-semibold">Actif</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 hover:bg-primary-fixed rounded-full text-primary transition-colors">
<span class="material-symbols-outlined" data-icon="visibility">visibility</span>
</button>
<button class="p-2 hover:bg-secondary-fixed rounded-full text-secondary transition-colors">
<span class="material-symbols-outlined" data-icon="edit">edit</span>
</button>
</div>
</td>
</tr>
<!-- Table Row 2 -->
<tr class="table-row-zebra border-b border-outline-variant/30 hover:bg-surface-container transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="h-10 w-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold">AS</div>
<div>
<p class="font-semibold text-on-surface">Amina Soglo</p>
<p class="text-label-sm font-normal text-outline">amina.s@work.com</p>
</div>
</div>
</td>
<td class="px-6 py-4 font-mono text-label-md">1198273645009</td>
<td class="px-6 py-4">+229 61 88 99 00</td>
<td class="px-6 py-4">
<p class="text-on-surface">Abomey-Calavi</p>
<p class="text-label-sm text-outline">Zogbadjè</p>
</td>
<td class="px-6 py-4">
<span class="bg-primary-fixed text-on-primary-fixed-variant px-2 py-0.5 rounded text-label-sm">1 parcelle</span>
</td>
<td class="px-6 py-4">
<span class="status-chip-attente px-3 py-1 rounded-full text-label-sm font-semibold">En attente</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 hover:bg-primary-fixed rounded-full text-primary transition-colors">
<span class="material-symbols-outlined" data-icon="visibility">visibility</span>
</button>
<button class="p-2 hover:bg-secondary-fixed rounded-full text-secondary transition-colors">
<span class="material-symbols-outlined" data-icon="edit">edit</span>
</button>
</div>
</td>
</tr>
<!-- Table Row 3 -->
<tr class="table-row-zebra border-b border-outline-variant/30 hover:bg-surface-container transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<img alt="Profile" class="h-10 w-10 rounded-full object-cover" data-alt="A detailed portrait of a young African woman with a professional hairstyle, wearing business attire. She has a focused yet friendly expression. The lighting is high-key with soft gradients, creating a premium and modern feel consistent with a digital government platform's user base. The background is a soft, out-of-focus modern office interior." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9DDJynK8C0hAoNRBcSauRsWd0FzzpV_g1T2rddSB1z99jM89EeSXxKMgVBg46iOTbyQVYK4CfEOLLe5cXNkvkykUxQDg1G2gPY4C7qhgIrU4snZmajHG2-xAwQ265UrxNg3OXFraFI7eh0zjVAyZukdj04FpUt_XdaQKp4fdKF1ry8do4MXU8dRn1z9df8U3WETyYbiP0vBDbZbFqxH3HnWTyJB3lJPJ9XAuH1QuiTKIux8v89QvIYvCw1bFgJbZJ_UmOSw2dc19A"/>
<div>
<p class="font-semibold text-on-surface">Yasmine Bello</p>
<p class="text-label-sm font-normal text-outline">yasmine.b@domain.bj</p>
</div>
</div>
</td>
<td class="px-6 py-4 font-mono text-label-md">4409823456122</td>
<td class="px-6 py-4">+229 95 00 22 33</td>
<td class="px-6 py-4">
<p class="text-on-surface">Ouidah</p>
<p class="text-label-sm text-outline">Pahou</p>
</td>
<td class="px-6 py-4">
<span class="bg-primary-fixed text-on-primary-fixed-variant px-2 py-0.5 rounded text-label-sm">3 parcelles</span>
</td>
<td class="px-6 py-4">
<span class="status-chip-actif px-3 py-1 rounded-full text-label-sm font-semibold">Actif</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 hover:bg-primary-fixed rounded-full text-primary transition-colors">
<span class="material-symbols-outlined" data-icon="visibility">visibility</span>
</button>
<button class="p-2 hover:bg-secondary-fixed rounded-full text-secondary transition-colors">
<span class="material-symbols-outlined" data-icon="edit">edit</span>
</button>
</div>
</td>
</tr>
<!-- Table Row 4 -->
<tr class="table-row-zebra border-b border-outline-variant/30 hover:bg-surface-container transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="h-10 w-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">TC</div>
<div>
<p class="font-semibold text-on-surface">Tidjani Chabi</p>
<p class="text-label-sm font-normal text-outline">t.chabi@admin.com</p>
</div>
</div>
</td>
<td class="px-6 py-4 font-mono text-label-md">5510293847566</td>
<td class="px-6 py-4">+229 90 44 55 66</td>
<td class="px-6 py-4">
<p class="text-on-surface">Parakou</p>
<p class="text-label-sm text-outline">Tidjani</p>
</td>
<td class="px-6 py-4">
<span class="bg-primary-fixed text-on-primary-fixed-variant px-2 py-0.5 rounded text-label-sm">7 parcelles</span>
</td>
<td class="px-6 py-4">
<span class="status-chip-actif px-3 py-1 rounded-full text-label-sm font-semibold">Actif</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 hover:bg-primary-fixed rounded-full text-primary transition-colors">
<span class="material-symbols-outlined" data-icon="visibility">visibility</span>
</button>
<button class="p-2 hover:bg-secondary-fixed rounded-full text-secondary transition-colors">
<span class="material-symbols-outlined" data-icon="edit">edit</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-6 py-4 flex items-center justify-between border-t border-outline-variant bg-surface-container-low">
<p class="font-label-md text-label-md text-outline">Affichage de 1 à 10 sur 1,284 propriétaires</p>
<div class="flex items-center gap-2">
<button class="p-2 rounded-lg hover:bg-surface-container-high text-outline disabled:opacity-50" disabled="">
<span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-label-md text-label-md">1</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container-high text-on-surface font-label-md text-label-md">2</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container-high text-on-surface font-label-md text-label-md">3</button>
<span class="text-outline">...</span>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container-high text-on-surface font-label-md text-label-md">129</button>
<button class="p-2 rounded-lg hover:bg-surface-container-high text-outline">
<span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Visual Context: Quick Summary Cards (Bento Influence) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-md mt-md">
<div class="bento-card p-md border-l-4 border-l-primary flex items-start justify-between">
<div>
<p class="text-outline font-label-md text-label-md mb-1">Nouveaux ce mois</p>
<h3 class="text-display-lg font-display-lg text-on-surface leading-none">+42</h3>
<p class="text-emerald-500 font-label-sm text-label-sm flex items-center gap-1 mt-2">
<span class="material-symbols-outlined text-[14px]" data-icon="trending_up">trending_up</span>
                        12% d'augmentation
                    </p>
</div>
<div class="p-3 bg-primary-fixed rounded-xl text-on-primary-fixed-variant">
<span class="material-symbols-outlined text-[32px]" data-icon="person_add">person_add</span>
</div>
</div>
<div class="bento-card p-md border-l-4 border-l-secondary flex items-start justify-between">
<div>
<p class="text-outline font-label-md text-label-md mb-1">Dossiers en attente</p>
<h3 class="text-display-lg font-display-lg text-on-surface leading-none">18</h3>
<p class="text-outline font-label-sm text-label-sm mt-2">Nécessite une vérification IFU</p>
</div>
<div class="p-3 bg-secondary-fixed rounded-xl text-on-secondary-fixed-variant">
<span class="material-symbols-outlined text-[32px]" data-icon="pending_actions">pending_actions</span>
</div>
</div>
<div class="bento-card p-md border-l-4 border-l-tertiary flex items-start justify-between">
<div>
<p class="text-outline font-label-md text-label-md mb-1">Total Parcelles</p>
<h3 class="text-display-lg font-display-lg text-on-surface leading-none">4,892</h3>
<p class="text-outline font-label-sm text-label-sm mt-2">Moyenne de 3.8/propriétaire</p>
</div>
<div class="p-3 bg-tertiary-fixed rounded-xl text-on-tertiary-fixed-variant">
<span class="material-symbols-outlined text-[32px]" data-icon="real_estate_agent">real_estate_agent</span>
</div>
</div>
</div>
</main>
<script>
        // Simple micro-interaction for active row highlight
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.transform = 'translateX(4px)';
            });
            row.addEventListener('mouseleave', () => {
                row.style.transform = 'translateX(0)';
            });
        });

        // Search bar focus effect
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('ring-2', 'ring-primary/20');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('ring-2', 'ring-primary/20');
        });
    </script>
</body></html>