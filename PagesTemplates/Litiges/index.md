<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Système Foncier Glo - Gestion des Litiges</title>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "tertiary-fixed": "#e9ddff",
                        "surface-variant": "#d3e4fe",
                        "primary-fixed-dim": "#a0cafc",
                        "on-surface-variant": "#42474f",
                        "on-tertiary-fixed-variant": "#5516be",
                        "inverse-on-surface": "#eaf1ff",
                        "secondary-fixed": "#d1e4ff",
                        "tertiary-fixed-dim": "#d0bcff",
                        "surface-tint": "#35618d",
                        "surface-container": "#e5eeff",
                        "on-primary": "#ffffff",
                        "inverse-primary": "#a0cafc",
                        "surface-container-lowest": "#ffffff",
                        "primary-container": "#1f4e79",
                        "on-error": "#ffffff",
                        "primary-fixed": "#d1e4ff",
                        "surface-dim": "#cbdbf5",
                        "secondary-container": "#7cbaff",
                        "primary": "#00375e",
                        "on-tertiary-fixed": "#23005c",
                        "on-primary-fixed-variant": "#184974",
                        "secondary": "#0b61a1",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed": "#001d35",
                        "outline-variant": "#c2c7d0",
                        "surface-container-high": "#dce9ff",
                        "on-secondary-container": "#004a7d",
                        "inverse-surface": "#213145",
                        "on-primary-container": "#95bff1",
                        "surface": "#f8f9ff",
                        "surface-bright": "#f8f9ff",
                        "on-tertiary-container": "#c7b0ff",
                        "outline": "#72777f",
                        "error-container": "#ffdad6",
                        "tertiary-container": "#5a20c3",
                        "surface-container-highest": "#d3e4fe",
                        "on-surface": "#0b1c30",
                        "on-secondary-fixed-variant": "#00497c",
                        "on-secondary-fixed": "#001d36",
                        "on-error-container": "#93000a",
                        "surface-container-low": "#eff4ff",
                        "secondary-fixed-dim": "#9ecaff",
                        "tertiary": "#41009d",
                        "on-background": "#0b1c30",
                        "error": "#ba1a1a",
                        "background": "#f8f9ff",
                        "on-secondary": "#ffffff"
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
                        "lg": "2rem",
                        "gutter": "24px",
                        "md": "1.5rem",
                        "margin-desktop": "40px",
                        "base": "4px",
                        "xs": "0.5rem",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg-mobile": ["Plus Jakarta Sans", "sans-serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "label-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "display-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "title-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "label-md": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}]
                    }
                }
            }
        }
    </script>
<style>
        /* Google Fonts Import for Plus Jakarta Sans */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
    </style>
</head>
<body class="bg-background text-on-background font-body-md h-screen flex overflow-hidden">
<!-- SideNavBar (from JSON) -->
<nav class="bg-primary dark:bg-primary-container h-screen w-72 flex-shrink-0 shadow-md fixed inset-y-0 left-0 flex flex-col p-md hidden md:flex z-50">
<!-- Header -->
<div class="mb-xl flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center overflow-hidden">
<img alt="Armoiries du Bénin" class="w-full h-full object-cover" data-alt="A stylized, modern geometric shield emblem reflecting institutional authority, set against a pristine white background. The emblem incorporates subtle gold and green accents in a corporate modern style, perfectly balanced and highly detailed to evoke trust and security." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNs_uR8qMuebmNaMGW8uERshXGTK56HmEJy-MOIAPQLK09quP41epTd1TJBHkG_smLpYaYndFIlgqCrn7JsL_RA508x8dk7x3vdE8OjZ6ZRSn2XWY4kF6WQqG5Mhp6d6MdIKM4UrrS7pbWx_hHdkWYx2TTHuGwRwDrR-Xef2yc1m7bxXzosfEnd50UysmhYdfauKQj2TzC57Az_lPgovpejNscGAD3D2A_rcMTuC48BJtSNVFYHsme1j8iJ0DAiGp-82J_t90GjIMY"/>
</div>
<div>
<h1 class="font-headline-md text-headline-md font-bold text-surface-container-lowest">Système Foncier Glo</h1>
<p class="font-label-sm text-label-sm text-secondary-fixed opacity-80">Administration Territoriale</p>
</div>
</div>
<!-- Navigation Links -->
<div class="flex-1 space-y-2 overflow-y-auto pr-2">
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors hover:bg-on-primary-fixed-variant transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-label-md text-label-md">Tableau de bord</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors hover:bg-on-primary-fixed-variant transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined" data-icon="map">map</span>
<span class="font-label-md text-label-md">Cadastre</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors hover:bg-on-primary-fixed-variant transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined" data-icon="description">description</span>
<span class="font-label-md text-label-md">Titres Fonciers</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-secondary-container text-on-secondary-container rounded-lg transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined" data-icon="gavel" data-weight="fill" style="font-variation-settings: 'FILL' 1;">gavel</span>
<span class="font-label-md text-label-md font-bold">Litiges</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors hover:bg-on-primary-fixed-variant transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
<span class="font-label-md text-label-md">Archives</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors hover:bg-on-primary-fixed-variant transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label-md text-label-md">Paramètres</span>
</a>
</div>
</nav>
<!-- Main Content Area -->
<main class="flex-1 md:ml-72 flex flex-col h-screen overflow-hidden">
<!-- TopAppBar (from JSON - Modified for Desktop to act as top header over content, hiding duplicate nav) -->
<header class="w-full h-16 bg-surface-container-lowest dark:bg-inverse-surface border-b border-outline-variant flex items-center justify-between px-margin-desktop sticky top-0 z-40">
<div class="flex items-center md:hidden">
<span class="font-headline-md text-headline-md font-bold text-primary">Système Foncier Glo</span>
</div>
<div class="hidden md:flex items-center bg-surface-container-low rounded-full px-4 py-2 border border-outline-variant focus-within:border-primary focus-within:ring-1 focus-within:ring-primary w-96 transition-all duration-200">
<span class="material-symbols-outlined text-outline mr-2" data-icon="search">search</span>
<input class="bg-transparent border-none focus:ring-0 w-full font-body-md text-on-surface p-0 placeholder-outline" placeholder="Rechercher référence, nom..." type="text"/>
</div>
<div class="flex items-center gap-4">
<button class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer relative">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-0 right-0 w-2 h-2 bg-error rounded-full"></span>
</button>
<button class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
</button>
<div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant ml-2">
<img alt="Profil Administrateur" class="w-full h-full object-cover" data-alt="A professional headshot of an African man in a modern business environment. He is wearing a sharp navy suit and looking confidently towards the right. The lighting is crisp and clean, reflecting a corporate, trustworthy aesthetic suitable for a government or high-end enterprise portal." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjhQsnDEk7on44Q7e1oHhtyyGTSGnVuOS0qqRA1afnM00eebpEWtKVu-jROSqaihgefJscvLrMbAOahXOImMai2xfLWfGbK8JVEoEi0TF2NTtRdU6FhJ0_DPebHMgqJ2D04JkEuvb22a99M36F6MEBNuGUD80WEYsJOG3dOtjiHYjpY_TI6-RUVeuzjbXuiTT1oXRI9D4PCXJa8Ui3rCqAxndij_wQj2rPoDiSbXKcIMN1Bz-eUq1UcN8DwJG_5og2IGV6UvrDkQ4w"/>
</div>
</div>
</header>
<!-- Page Content Scrollable Area -->
<div class="flex-1 overflow-y-auto p-margin-mobile md:p-margin-desktop bg-background">
<!-- Page Header Section -->
<div class="flex flex-col md:flex-row md:items-center justify-between mb-lg gap-4">
<div>
<nav aria-label="Breadcrumb" class="flex text-on-surface-variant font-label-sm text-label-sm mb-2">
<ol class="inline-flex items-center gap-2">
<li class="inline-flex items-center">
<a class="hover:text-primary transition-colors" href="#">Tableau de bord</a>
</li>
<li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
<li aria-current="page" class="text-on-surface font-semibold">Litiges</li>
</ol>
</nav>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Gestion des Litiges</h2>
</div>
<button class="bg-[#2E75B6] hover:bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md text-label-md flex items-center justify-center gap-2 transition-all duration-200 shadow-[0_4px_12px_rgba(31,78,121,0.15)] hover:shadow-[0_8px_20px_rgba(31,78,121,0.25)]">
<span class="material-symbols-outlined" data-icon="add">add</span>
                    Nouveau Litige
                </button>
</div>
<!-- Content Canvas Grid (Bento Style) -->
<div class="grid grid-cols-12 gap-gutter">
<!-- Filter Bar Module (Spans 12 cols) -->
<div class="col-span-12 bg-surface-container-lowest border border-[#E2E8F0] rounded-xl p-md shadow-[0_4px_12px_rgba(31,78,121,0.05)]">
<div class="flex flex-col md:flex-row gap-4">
<div class="flex-1">
<label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Recherche de dossier</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline" data-icon="search">search</span>
</div>
<input class="block w-full pl-10 pr-3 py-2 border border-[#CBD5E1] rounded-lg text-on-surface font-body-md focus:ring-1 focus:ring-[#2E75B6] focus:border-[#2E75B6] transition-colors" placeholder="Ex: LIT-2023-042" type="text"/>
</div>
</div>
<div class="md:w-48">
<label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Arrondissement</label>
<select class="block w-full py-2 px-3 border border-[#CBD5E1] bg-white rounded-lg text-on-surface font-body-md focus:ring-1 focus:ring-[#2E75B6] focus:border-[#2E75B6] transition-colors appearance-none">
<option>Tous</option>
<option>Glo-Djigbé</option>
<option>Tori-Bossito</option>
</select>
</div>
<div class="md:w-48">
<label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Type de litige</label>
<select class="block w-full py-2 px-3 border border-[#CBD5E1] bg-white rounded-lg text-on-surface font-body-md focus:ring-1 focus:ring-[#2E75B6] focus:border-[#2E75B6] transition-colors appearance-none">
<option>Tous</option>
<option>Double vente</option>
<option>Contestation de limites</option>
<option>Succession</option>
</select>
</div>
<div class="md:w-48">
<label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Statut</label>
<select class="block w-full py-2 px-3 border border-[#CBD5E1] bg-white rounded-lg text-on-surface font-body-md focus:ring-1 focus:ring-[#2E75B6] focus:border-[#2E75B6] transition-colors appearance-none">
<option>Tous</option>
<option>Actif</option>
<option>Urgent/Bloqué</option>
<option>Résolu</option>
</select>
</div>
</div>
</div>
<!-- Data Table Module (Spans 12 cols) -->
<div class="col-span-12 bg-surface-container-lowest border border-[#E2E8F0] rounded-xl shadow-[0_4px_12px_rgba(31,78,121,0.05)] overflow-hidden">
<div class="p-md border-b border-outline-variant flex justify-between items-center bg-surface-bright">
<h3 class="font-title-lg text-title-lg text-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-[#2E75B6]" data-icon="folder_open">folder_open</span>
                            Dossiers en cours
                        </h3>
<div class="flex gap-2">
<button class="p-2 text-on-surface-variant hover:bg-surface-variant rounded-md transition-colors">
<span class="material-symbols-outlined" data-icon="filter_list">filter_list</span>
</button>
<button class="p-2 text-on-surface-variant hover:bg-surface-variant rounded-md transition-colors">
<span class="material-symbols-outlined" data-icon="more_vert">more_vert</span>
</button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="border-b border-[#CBD5E1] bg-surface-container-low">
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant">ID Litige</th>
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant">Réf. Parcelle</th>
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant">Type</th>
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant">Plaignant</th>
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant">Ouverture</th>
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant">Statut</th>
<th class="py-3 px-4 font-label-md text-label-md text-on-surface-variant text-right">Actions</th>
</tr>
</thead>
<tbody class="font-body-md text-on-surface">
<!-- Row 1 - Urgent -->
<tr class="border-b border-[#E2E8F0] hover:bg-surface-variant/30 transition-colors group relative">
<td class="absolute left-0 top-0 bottom-0 w-1 bg-[#EF4444]"></td>
<td class="py-4 px-4 font-medium">LIT-2023-042</td>
<td class="py-4 px-4 text-on-surface-variant">REF-GLO-882</td>
<td class="py-4 px-4">Double vente</td>
<td class="py-4 px-4">M. Koffi Dossou</td>
<td class="py-4 px-4 text-on-surface-variant">24 Oct 2023</td>
<td class="py-4 px-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-[#EF4444]/10 text-[#EF4444] border border-[#EF4444]/20">
                                            Urgent/Bloqué
                                        </span>
</td>
<td class="py-4 px-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="text-on-surface-variant hover:text-[#2E75B6]" title="Voir détails"><span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span></button>
<button class="text-on-surface-variant hover:text-[#2E75B6]" title="Modifier"><span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span></button>
</div>
</td>
</tr>
<!-- Row 2 - Actif -->
<tr class="border-b border-[#E2E8F0] hover:bg-surface-variant/30 transition-colors group bg-surface-bright/50">
<td class="py-4 px-4 font-medium">LIT-2023-045</td>
<td class="py-4 px-4 text-on-surface-variant">REF-TOR-104</td>
<td class="py-4 px-4">Contestation de limites</td>
<td class="py-4 px-4">Héritiers Awa</td>
<td class="py-4 px-4 text-on-surface-variant">02 Nov 2023</td>
<td class="py-4 px-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-[#F59E0B]/10 text-[#D97706] border border-[#F59E0B]/20">
                                            Actif
                                        </span>
</td>
<td class="py-4 px-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="text-on-surface-variant hover:text-[#2E75B6]"><span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span></button>
<button class="text-on-surface-variant hover:text-[#2E75B6]"><span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span></button>
</div>
</td>
</tr>
<!-- Row 3 - Résolu -->
<tr class="border-b border-[#E2E8F0] hover:bg-surface-variant/30 transition-colors group">
<td class="py-4 px-4 font-medium">LIT-2023-038</td>
<td class="py-4 px-4 text-on-surface-variant">REF-GLO-551</td>
<td class="py-4 px-4">Succession</td>
<td class="py-4 px-4">Famille Zogo</td>
<td class="py-4 px-4 text-on-surface-variant">15 Sep 2023</td>
<td class="py-4 px-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-[#10B981]/10 text-[#059669] border border-[#10B981]/20">
                                            Résolu
                                        </span>
</td>
<td class="py-4 px-4 text-right">
<div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="text-on-surface-variant hover:text-[#2E75B6]"><span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span></button>
<button class="text-on-surface-variant hover:text-[#2E75B6]"><span class="material-symbols-outlined text-[20px]" data-icon="folder_zip">folder_zip</span></button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="p-4 border-t border-[#E2E8F0] flex items-center justify-between bg-surface-bright">
<span class="font-body-md text-sm text-on-surface-variant">Affichage 1 - 3 sur 12</span>
<div class="flex gap-1">
<button class="p-1 text-outline hover:text-on-surface transition-colors disabled:opacity-50"><span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span></button>
<button class="w-8 h-8 rounded-md bg-[#2E75B6] text-white font-label-sm flex items-center justify-center">1</button>
<button class="w-8 h-8 rounded-md hover:bg-surface-variant text-on-surface font-label-sm flex items-center justify-center transition-colors">2</button>
<button class="p-1 text-on-surface-variant hover:text-on-surface transition-colors"><span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span></button>
</div>
</div>
</div>
</div>
</div>
</main>
</body></html>