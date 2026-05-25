<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Système Foncier Glo - Gestion des Utilisateurs</title>
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
                        "primary-fixed": "#d1e4ff",
                        "surface-bright": "#f8f9ff",
                        "on-background": "#0b1c30",
                        "secondary-container": "#7cbaff",
                        "on-tertiary-container": "#c7b0ff",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed-dim": "#d0bcff",
                        "on-error-container": "#93000a",
                        "on-surface-variant": "#42474f",
                        "tertiary-container": "#5a20c3",
                        "on-tertiary-fixed": "#23005c",
                        "secondary": "#0b61a1",
                        "on-secondary-fixed-variant": "#00497c",
                        "error-container": "#ffdad6",
                        "tertiary": "#41009d",
                        "surface": "#f8f9ff",
                        "on-secondary-container": "#004a7d",
                        "on-primary-fixed": "#001d35",
                        "on-surface": "#0b1c30",
                        "secondary-fixed-dim": "#9ecaff",
                        "outline-variant": "#c2c7d0",
                        "background": "#f8f9ff",
                        "inverse-surface": "#213145",
                        "outline": "#72777f",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-container-highest": "#d3e4fe",
                        "on-primary": "#ffffff",
                        "surface-variant": "#d3e4fe",
                        "inverse-primary": "#a0cafc",
                        "primary": "#00375e",
                        "primary-container": "#1f4e79",
                        "surface-tint": "#35618d",
                        "surface-dim": "#cbdbf5",
                        "surface-container-high": "#dce9ff",
                        "on-secondary-fixed": "#001d36",
                        "tertiary-fixed": "#e9ddff",
                        "primary-fixed-dim": "#a0cafc",
                        "error": "#ba1a1a",
                        "surface-container": "#e5eeff",
                        "on-primary-container": "#95bff1",
                        "on-tertiary-fixed-variant": "#5516be",
                        "on-primary-fixed-variant": "#184974",
                        "secondary-fixed": "#d1e4ff",
                        "surface-container-low": "#eff4ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "1rem",
                        "margin-desktop": "40px",
                        "md": "1.5rem",
                        "gutter": "24px",
                        "xl": "3rem",
                        "base": "4px",
                        "margin-mobile": "16px",
                        "xs": "0.5rem",
                        "lg": "2rem"
                    },
                    "fontFamily": {
                        "title-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1; }
        /* Custom Scrollbar for Audit Log */
        .audit-scroll::-webkit-scrollbar { width: 6px; }
        .audit-scroll::-webkit-scrollbar-track { background: transparent; }
        .audit-scroll::-webkit-scrollbar-thumb { background-color: #c2c7d0; border-radius: 20px; }
    </style>
</head>
<body class="bg-background text-on-background antialiased flex h-screen overflow-hidden">
<!-- SideNavBar -->
<nav class="bg-primary dark:bg-primary-container h-screen w-72 flex-shrink-0 shadow-md fixed inset-y-0 left-0 flex flex-col p-md hidden md:flex z-50">
<div class="flex items-center gap-3 mb-10">
<div class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center overflow-hidden">
<img alt="Armoiries du Bénin" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDwgH8C9OO2eLKx5T9SfenwIoIqqTeNTiE272Nxgv5QXBOJdp5ZOldOcWkTQZqMtdfmqRmBMPyOMl1vlRrQzNLSMG51tryNKR8S8MQC6JFP4gmju6Zw0pFZnhfYQWtH01Fry5X_2DcoaUnCm_cvAwKB_ULlz8CyBNylX_7gnL4F95q71EVh-IRxkSCDRpz5fa126GLwNQjw0U4dSgJBDIfwh9O6PB-VGSLC3RKMQB6Zyejr3nklL9bC0fhWDhMDrs9z8K5IKHioIVFo"/>
</div>
<div>
<h1 class="font-headline-md text-headline-md font-bold text-surface-container-lowest">Système Foncier Glo</h1>
<p class="font-label-sm text-label-sm text-secondary-fixed opacity-80">Administration Territoriale</p>
</div>
</div>
<ul class="flex flex-col gap-2 flex-grow">
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Tableau de bord</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">map</span>
<span class="font-label-md text-label-md">Cadastre</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">description</span>
<span class="font-label-md text-label-md">Titres Fonciers</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">gavel</span>
<span class="font-label-md text-label-md">Litiges</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">inventory_2</span>
<span class="font-label-md text-label-md">Archives</span>
</a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 bg-secondary-container text-on-secondary-container rounded-lg transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined fill">settings</span>
<span class="font-label-md text-label-md">Paramètres</span>
</a>
</li>
</ul>
</nav>
<!-- Main Content Wrapper -->
<div class="flex-1 flex flex-col md:ml-72 h-screen overflow-hidden bg-background">
<!-- TopAppBar -->
<header class="w-full h-16 border-b border-outline-variant flex items-center justify-between px-margin-desktop sticky top-0 z-40 bg-surface-container-lowest">
<div class="flex items-center gap-4">
<h2 class="font-headline-md text-headline-md font-bold text-primary md:hidden">Système Foncier Glo</h2>
<!-- Active Breadcrumb/Section indicator for Desktop -->
<div class="hidden md:flex items-center gap-2 text-on-surface-variant">
<span class="font-label-md text-label-md">Paramètres</span>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="font-label-md text-label-md font-bold text-primary">Gestion des Utilisateurs</span>
</div>
</div>
<div class="flex items-center gap-4">
<div class="relative hidden sm:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="pl-10 pr-4 py-2 border border-outline-variant rounded-full bg-surface-bright focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm w-64 transition-all" placeholder="Rechercher..." type="text"/>
</div>
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors cursor-pointer rounded-full hover:bg-surface-container">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors cursor-pointer rounded-full hover:bg-surface-container">
<span class="material-symbols-outlined">help_outline</span>
</button>
<div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant cursor-pointer ml-2">
<img alt="Profil Administrateur" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9vHSlUL6VpznaXc3BbPl7eglEnaL8Er7cJW7HKUYKeoxTMi5aGARSc9ezpgCHN-Mz3iMr4Nm7_7W8-PBjDEaHVC852XUxP4c8cQCYT-jxMnkeHYH9NMzz21C3tqGq9vLo23wPwp2utSjr7axa1yCEMrqPXlhpwzWTtmQ_SkTc_tRACtCIW0LYSJGE2jtcFLenGB-Yf-osMAsDjNrBPBt8anV037yZVZ9gIdLlASRJsxRXqJlyiN05xmViFbW28UaSa3YLHjI4eeW9"/>
</div>
</div>
</header>
<!-- Main Canvas -->
<main class="flex-1 overflow-y-auto p-md md:p-margin-desktop">
<div class="max-w-7xl mx-auto">
<div class="flex justify-between items-end mb-gutter">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-background mb-2">Gestion des Utilisateurs</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Gérez les accès, les rôles et surveillez l'activité du système.</p>
</div>
<button class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-primary-container transition-colors shadow-[0_4px_12px_rgba(31,78,121,0.15)] hover:shadow-[0_8px_20px_rgba(31,78,121,0.25)]">
<span class="material-symbols-outlined text-[20px]">add</span>
                        Nouvel Agent
                    </button>
</div>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-gutter">
<!-- Users Matrix Table (Spans 8 cols) -->
<div class="xl:col-span-8 bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_4px_12px_rgba(31,78,121,0.05)] overflow-hidden flex flex-col h-[600px]">
<div class="px-6 py-4 border-b border-outline-variant bg-surface-bright flex justify-between items-center">
<h3 class="font-title-lg text-title-lg text-on-background flex items-center gap-2">
<span class="material-symbols-outlined text-primary">group</span>
                                Personnel Autorisé
                            </h3>
<div class="flex gap-2">
<button class="p-1.5 text-on-surface-variant hover:text-primary rounded-md hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[20px]">filter_list</span>
</button>
<button class="p-1.5 text-on-surface-variant hover:text-primary rounded-md hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[20px]">download</span>
</button>
</div>
</div>
<div class="flex-1 overflow-auto">
<table class="w-full text-left border-collapse">
<thead class="bg-surface-container-low sticky top-0 z-10">
<tr>
<th class="px-6 py-3 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nom de l'agent</th>
<th class="px-6 py-3 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Email</th>
<th class="px-6 py-3 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Date de création</th>
<th class="px-6 py-3 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Rôle</th>
<th class="px-6 py-3 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Statut</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low transition-colors group relative">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-label-sm font-bold">JD</div>
<span class="font-label-md text-label-md text-on-background font-semibold">Jean Dupont</span>
</div>
</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">j.dupont@foncier.bj</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">12 Oct 2023</td>
<td class="px-6 py-4">
<select class="block w-full rounded-md border-outline-variant py-1.5 pl-3 pr-8 text-sm focus:border-primary focus:ring-primary bg-surface-bright text-on-background font-label-md">
<option selected="">Admin</option>
<option>Chef de Service</option>
<option>Agent</option>
</select>
</td>
<td class="px-6 py-4 text-right">
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
</label>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low transition-colors group relative bg-surface-bright">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-tertiary-container text-on-tertiary flex items-center justify-center font-label-sm font-bold">MA</div>
<span class="font-label-md text-label-md text-on-background font-semibold">Marie Assogba</span>
</div>
</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">m.assogba@foncier.bj</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">05 Nov 2023</td>
<td class="px-6 py-4">
<select class="block w-full rounded-md border-outline-variant py-1.5 pl-3 pr-8 text-sm focus:border-primary focus:ring-primary bg-surface-bright text-on-background font-label-md">
<option>Admin</option>
<option selected="">Chef de Service</option>
<option>Agent</option>
</select>
</td>
<td class="px-6 py-4 text-right">
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
</label>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low transition-colors group relative">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-dim text-on-surface flex items-center justify-center font-label-sm font-bold">PL</div>
<span class="font-label-md text-label-md text-on-background font-semibold">Paul Lokossou</span>
</div>
</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">p.lokossou@foncier.bj</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">22 Jan 2024</td>
<td class="px-6 py-4">
<select class="block w-full rounded-md border-outline-variant py-1.5 pl-3 pr-8 text-sm focus:border-primary focus:ring-primary bg-surface-bright text-on-background font-label-md">
<option>Admin</option>
<option>Chef de Service</option>
<option selected="">Agent</option>
</select>
</td>
<td class="px-6 py-4 text-right">
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
</label>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-low transition-colors group relative bg-surface-bright">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-surface-dim text-on-surface flex items-center justify-center font-label-sm font-bold">FK</div>
<span class="font-label-md text-label-md text-on-background font-semibold">Fatima Kaba</span>
</div>
</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">f.kaba@foncier.bj</td>
<td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant text-sm">14 Fev 2024</td>
<td class="px-6 py-4">
<select class="block w-full rounded-md border-outline-variant py-1.5 pl-3 pr-8 text-sm focus:border-primary focus:ring-primary bg-surface-bright text-on-background font-label-md">
<option>Admin</option>
<option>Chef de Service</option>
<option selected="">Agent</option>
</select>
</td>
<td class="px-6 py-4 text-right">
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
</label>
</td>
</tr>
</tbody>
</table>
</div>
<div class="px-6 py-3 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between">
<span class="font-body-md text-body-md text-on-surface-variant text-sm">Affichage de 1 à 4 sur 24 agents</span>
<div class="flex gap-1">
<button class="px-2 py-1 border border-outline-variant rounded bg-surface-bright text-on-surface-variant text-sm hover:bg-surface-container disabled:opacity-50" disabled="">Préc</button>
<button class="px-2 py-1 border border-primary rounded bg-primary text-on-primary text-sm">1</button>
<button class="px-2 py-1 border border-outline-variant rounded bg-surface-bright text-on-surface-variant text-sm hover:bg-surface-container">2</button>
<button class="px-2 py-1 border border-outline-variant rounded bg-surface-bright text-on-surface-variant text-sm hover:bg-surface-container">3</button>
<button class="px-2 py-1 border border-outline-variant rounded bg-surface-bright text-on-surface-variant text-sm hover:bg-surface-container">Suiv</button>
</div>
</div>
</div>
<!-- Audit Log (Spans 4 cols) -->
<div class="xl:col-span-4 bg-inverse-surface rounded-xl border border-outline-variant shadow-[0_4px_12px_rgba(31,78,121,0.1)] overflow-hidden flex flex-col h-[600px]">
<div class="px-6 py-4 border-b border-outline-variant/30 flex justify-between items-center bg-inverse-surface">
<h3 class="font-title-lg text-title-lg text-inverse-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary-fixed-dim">history</span>
                                Journal d'Audit
                            </h3>
<span class="relative flex h-3 w-3">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
<span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
</span>
</div>
<div class="flex-1 p-4 overflow-y-auto audit-scroll bg-[#1a2636]">
<div class="relative border-l border-outline-variant/30 ml-3 space-y-6 pb-4">
<!-- Log Item 1 -->
<div class="relative pl-6">
<div class="absolute w-3 h-3 bg-emerald-500 rounded-full -left-[6.5px] top-1.5 border-2 border-[#1a2636]"></div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline-variant mb-1">Aujourd'hui, 14:32</span>
<p class="font-body-md text-body-md text-inverse-on-surface text-sm">
<span class="font-semibold text-white">Connexion réussie</span> - Admin (Jean Dupont)
                                        </p>
<span class="font-label-sm text-label-sm text-outline-variant/60 mt-1">IP: 192.168.1.45</span>
</div>
</div>
<!-- Log Item 2 -->
<div class="relative pl-6">
<div class="absolute w-3 h-3 bg-secondary-container rounded-full -left-[6.5px] top-1.5 border-2 border-[#1a2636]"></div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline-variant mb-1">Aujourd'hui, 13:15</span>
<p class="font-body-md text-body-md text-inverse-on-surface text-sm">
<span class="font-semibold text-white">Modification parcelle REF-882</span> - Agent (Fatima Kaba)
                                        </p>
<span class="font-label-sm text-label-sm text-outline-variant/60 mt-1">Mise à jour des coordonnées GPS</span>
</div>
</div>
<!-- Log Item 3 -->
<div class="relative pl-6">
<div class="absolute w-3 h-3 bg-error rounded-full -left-[6.5px] top-1.5 border-2 border-[#1a2636]"></div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline-variant mb-1">Aujourd'hui, 11:40</span>
<p class="font-body-md text-body-md text-inverse-on-surface text-sm">
<span class="font-semibold text-error-container">Échec d'authentification</span> - Tentative inconnue
                                        </p>
<span class="font-label-sm text-label-sm text-outline-variant/60 mt-1">IP: 105.112.44.12</span>
</div>
</div>
<!-- Log Item 4 -->
<div class="relative pl-6">
<div class="absolute w-3 h-3 bg-tertiary-fixed-dim rounded-full -left-[6.5px] top-1.5 border-2 border-[#1a2636]"></div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline-variant mb-1">Hier, 16:55</span>
<p class="font-body-md text-body-md text-inverse-on-surface text-sm">
<span class="font-semibold text-white">Création Titre Foncier #TF-9901</span> - Chef de Service (Marie Assogba)
                                        </p>
<span class="font-label-sm text-label-sm text-outline-variant/60 mt-1">Approbation finale requise</span>
</div>
</div>
<!-- Log Item 5 -->
<div class="relative pl-6">
<div class="absolute w-3 h-3 bg-emerald-500 rounded-full -left-[6.5px] top-1.5 border-2 border-[#1a2636]"></div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-outline-variant mb-1">Hier, 09:00</span>
<p class="font-body-md text-body-md text-inverse-on-surface text-sm">
<span class="font-semibold text-white">Connexion réussie</span> - Agent (Paul Lokossou)
                                        </p>
</div>
</div>
</div>
</div>
<div class="px-6 py-3 border-t border-outline-variant/30 bg-inverse-surface text-center">
<button class="font-label-md text-label-md text-secondary-fixed hover:text-white transition-colors">
                                Voir tout l'historique
                            </button>
</div>
</div>
</div>
</div>
</main>
</div>
</body></html>