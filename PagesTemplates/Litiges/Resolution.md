<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Land Dispute Resolution Workspace</title>
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
                      "outline-variant": "#c2c7d0",
                      "on-tertiary-fixed": "#23005c",
                      "primary-container": "#1f4e79",
                      "surface-dim": "#cbdbf5",
                      "surface-container-low": "#eff4ff",
                      "on-primary-container": "#95bff1",
                      "tertiary-fixed-dim": "#d0bcff",
                      "surface-container-high": "#dce9ff",
                      "on-primary-fixed": "#001d35",
                      "on-error": "#ffffff",
                      "outline": "#72777f",
                      "error": "#ba1a1a",
                      "surface-container": "#e5eeff",
                      "inverse-primary": "#a0cafc",
                      "surface-variant": "#d3e4fe",
                      "secondary-fixed": "#d1e4ff",
                      "on-secondary": "#ffffff",
                      "on-secondary-fixed-variant": "#00497c",
                      "secondary": "#0b61a1",
                      "tertiary": "#41009d",
                      "primary": "#00375e",
                      "on-tertiary-fixed-variant": "#5516be",
                      "background": "#f8f9ff",
                      "tertiary-fixed": "#e9ddff",
                      "tertiary-container": "#5a20c3",
                      "inverse-on-surface": "#eaf1ff",
                      "surface-container-lowest": "#ffffff",
                      "primary-fixed-dim": "#a0cafc",
                      "on-tertiary": "#ffffff",
                      "on-error-container": "#93000a",
                      "on-tertiary-container": "#c7b0ff",
                      "inverse-surface": "#213145",
                      "error-container": "#ffdad6",
                      "secondary-container": "#7cbaff",
                      "surface": "#f8f9ff",
                      "surface-tint": "#35618d",
                      "surface-bright": "#f8f9ff",
                      "primary-fixed": "#d1e4ff",
                      "on-primary-fixed-variant": "#184974",
                      "on-primary": "#ffffff",
                      "on-secondary-container": "#004a7d",
                      "surface-container-highest": "#d3e4fe",
                      "secondary-fixed-dim": "#9ecaff",
                      "on-surface": "#0b1c30",
                      "on-surface-variant": "#42474f",
                      "on-background": "#0b1c30",
                      "on-secondary-fixed": "#001d36"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "margin-mobile": "16px",
                      "xs": "0.5rem",
                      "gutter": "24px",
                      "sm": "1rem",
                      "margin-desktop": "40px",
                      "xl": "3rem",
                      "md": "1.5rem",
                      "lg": "2rem",
                      "base": "4px"
              },
              "fontFamily": {
                      "label-md": ["Plus Jakarta Sans"],
                      "headline-md": ["Plus Jakarta Sans"],
                      "title-lg": ["Plus Jakarta Sans"],
                      "body-lg": ["Plus Jakarta Sans"],
                      "label-sm": ["Plus Jakarta Sans"],
                      "headline-lg": ["Plus Jakarta Sans"],
                      "display-lg": ["Plus Jakarta Sans"],
                      "headline-lg-mobile": ["Plus Jakarta Sans"],
                      "body-md": ["Plus Jakarta Sans"]
              },
              "fontSize": {
                      "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                      "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                      "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                      "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                      "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                      "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                      "display-lg": ["48px", {"lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                      "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
              }
            }
          }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1;
        }
        
        /* Subtle scrollbar for modern feel */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #c2c7d0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #72777f; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex antialiased">
<!-- SideNavBar (Suppressed due to task focus, but included structurally for the layout requirement) -->
<nav class="h-screen w-72 flex-col fixed left-0 top-0 bg-primary shadow-md hidden md:flex z-40">
<div class="flex flex-col h-full py-md">
<div class="px-gutter mb-lg flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center shrink-0 overflow-hidden">
<img alt="Benin Republic Coat of Arms" class="w-full h-full object-cover" data-alt="A macro photograph of an official government seal featuring a coat of arms. The seal is intricately detailed, showcasing panthers, a palm tree, and a ship. The lighting is studio quality, highlighting the textures of the metal and enamel. The style is formal, institutional, and highly professional, fitting for a top-tier government land management platform." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQT85LVEgSM0_9_SzE_tTn-MlFtkhvyG0eea-zexpbOi5sy1XAO5Xk1V2ce3kBIi0cifMZar6dE5zUnpzu35gQzmrtvlMU6-phNwTBqbNYed5MzDPngdaNovego29wOSgSTMney0DoJgR25acq2QRpCX8Pbp9FsE2MFH_ID16fghNGJ2Bv2D3r5l8x5SrgdYNwJdruCdTs__2Vb0VxH7evfVzmTS3XPxDIJo7Z9RAks9ECm43X9RZ4ydfZ6aFzMB1Or4eCafP8sM6S"/>
</div>
<div>
<h1 class="font-headline-md text-headline-md font-bold text-surface-lowest text-white">Cadastre Bénin</h1>
<p class="font-label-sm text-label-sm text-primary-fixed-dim">Land Administration</p>
</div>
</div>
<div class="px-sm mb-md">
<button class="w-full bg-surface-container-lowest text-primary py-2 px-4 rounded-lg font-label-md text-label-md font-bold flex items-center justify-center gap-2 hover:bg-surface-variant transition-colors shadow-sm">
<span class="material-symbols-outlined">add</span> New Registration
                </button>
</div>
<div class="flex-1 overflow-y-auto space-y-1">
<a class="flex items-center gap-3 text-primary-fixed-dim hover:bg-on-primary-fixed-variant rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span> Dashboard
                </a>
<a class="flex items-center gap-3 text-on-primary-fixed bg-primary-container rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md font-bold transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="account_balance">account_balance</span> Land Records
                </a>
<a class="flex items-center gap-3 text-primary-fixed-dim hover:bg-on-primary-fixed-variant rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="assignment">assignment</span> Applications
                </a>
<a class="flex items-center gap-3 text-primary-fixed-dim hover:bg-on-primary-fixed-variant rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="map">map</span> Cadastral Map
                </a>
<a class="flex items-center gap-3 text-primary-fixed-dim hover:bg-on-primary-fixed-variant rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="analytics">analytics</span> Reports
                </a>
</div>
<div class="mt-auto space-y-1 pt-md border-t border-on-primary-fixed-variant">
<a class="flex items-center gap-3 text-primary-fixed-dim hover:bg-on-primary-fixed-variant rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span> Settings
                </a>
<a class="flex items-center gap-3 text-primary-fixed-dim hover:bg-on-primary-fixed-variant rounded-lg mx-2 my-1 px-4 py-3 font-label-md text-label-md transition-colors duration-200" href="#">
<span class="material-symbols-outlined" data-icon="help">help</span> Support
                </a>
</div>
</div>
</nav>
<!-- Main Content Area -->
<div class="flex-1 flex flex-col min-w-0 md:ml-72 bg-surface">
<!-- TopNavBar -->
<header class="bg-surface-container-lowest docked full-width top-0 sticky border-b border-outline-variant shadow-sm z-30">
<div class="flex justify-between items-center h-16 px-lg">
<div class="flex items-center gap-md">
<h2 class="font-headline-md text-headline-md font-bold text-primary">Land Management Portal</h2>
</div>
<div class="flex items-center gap-md">
<div class="relative hidden sm:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="pl-10 pr-4 py-2 rounded-full border border-outline-variant bg-surface-bright focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-body-md font-body-md w-64" placeholder="Search records..." type="text"/>
</div>
<button class="w-10 h-10 rounded-full hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="w-10 h-10 rounded-full hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-colors">
<span class="material-symbols-outlined" data-icon="history">history</span>
</button>
<div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant cursor-pointer ml-sm">
<img alt="Administrator Profile" data-alt="A professional headshot of a mature administrator wearing a smart business suit. The background is a clean, neutral gray office environment with subtle, out-of-focus lighting. The lighting on the face is soft and flattering, suggesting competence and authority. The overall aesthetic is corporate, modern, and highly trustworthy, fitting for a government land management system." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBv454JDzTxzzxDAUBYGLwg5AdeZSHYjgFJTWCjz1M0ZfVJLpW3ZyyR5EapuAnjJ1E2gj_r_jqCIUh8v4LkemAIFOI68-dUUOKGIFyIqoeOPF6rLlGekxbgK9NpOyjr5TlrLWZZ7i1ReL-YBjQWaB_bOtcAJzw1KoDHqrIdIoQcsGUV1KfXF-RNs43j5fbBQfoaskzHgrMeR3e7SwHPrsmW8Ewpx_6zx-jcYgxf6FpJbBA_56fKko76KprsFh4HtIuhPRRuO3xWXLK8"/>
</div>
</div>
</div>
</header>
<!-- Workspace Container -->
<main class="flex-1 flex flex-col overflow-hidden pb-24"> <!-- pb-24 to accommodate bottom panel -->
<div class="px-margin-desktop py-gutter flex items-center justify-between border-b border-outline-variant bg-surface-container-lowest">
<div>
<div class="flex items-center gap-2 mb-1">
<span class="font-label-sm text-label-sm text-on-surface-variant tracking-wider uppercase">Dossier de Litige</span>
<span class="material-symbols-outlined text-xs text-outline">chevron_right</span>
<span class="font-label-sm text-label-sm text-primary font-bold">REF-GLO-882</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface">Résolution de Conflit: Glo-Djigbé</h1>
</div>
<div class="flex items-center gap-3">
<span class="px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">warning</span> En Suspens
                    </span>
<button class="flex items-center gap-2 px-4 py-2 bg-surface-container border border-outline-variant rounded-lg text-primary font-label-md text-label-md hover:bg-surface-variant transition-colors shadow-sm">
<span class="material-symbols-outlined text-sm">print</span> Imprimer le dossier
                    </button>
</div>
</div>
<!-- Two Pane Layout -->
<div class="flex-1 flex overflow-hidden">
<!-- Left Pane (40%) -->
<div class="w-2/5 flex flex-col border-r border-outline-variant bg-surface-container-lowest overflow-y-auto">
<div class="p-gutter space-y-lg">
<!-- Timeline Section -->
<section>
<h3 class="font-title-lg text-title-lg text-on-surface flex items-center gap-2 mb-md border-b border-outline-variant pb-2">
<span class="material-symbols-outlined text-primary">history_edu</span> Historique Judiciaire
                            </h3>
<div class="relative pl-6 border-l-2 border-surface-variant space-y-6">
<!-- Timeline Item -->
<div class="relative">
<div class="absolute -left-[31px] w-4 h-4 rounded-full bg-surface-container-lowest border-2 border-primary mt-1"></div>
<div class="font-label-sm text-label-sm text-on-surface-variant mb-1">12 Octobre 2026</div>
<div class="bg-surface p-3 rounded-lg border border-outline-variant shadow-sm">
<h4 class="font-label-md text-label-md text-on-surface font-bold">Ouverture du dossier</h4>
<p class="font-body-md text-body-md text-on-surface-variant text-sm mt-1">Signalement de chevauchement de parcelles par le requérant M. Dossou.</p>
</div>
</div>
<!-- Timeline Item -->
<div class="relative">
<div class="absolute -left-[31px] w-4 h-4 rounded-full bg-surface-container-lowest border-2 border-outline-variant mt-1"></div>
<div class="font-label-sm text-label-sm text-on-surface-variant mb-1">05 Novembre 2026</div>
<div class="bg-surface p-3 rounded-lg border border-outline-variant shadow-sm opacity-75">
<h4 class="font-label-md text-label-md text-on-surface font-bold">Descente sur le terrain</h4>
<p class="font-body-md text-body-md text-on-surface-variant text-sm mt-1">Levé topographique contradictoire réalisé par l'expert géomètre.</p>
</div>
</div>
</div>
</section>
<!-- Comparison Card -->
<section>
<h3 class="font-title-lg text-title-lg text-on-surface flex items-center gap-2 mb-md border-b border-outline-variant pb-2">
<span class="material-symbols-outlined text-primary">balance</span> Analyse des Revendications
                            </h3>
<div class="grid grid-cols-2 gap-4">
<div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex items-center gap-2 mb-2 text-primary">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md font-bold">Propriétaire Titulaire</span>
</div>
<p class="font-body-md text-body-md text-sm text-on-surface-variant">S'appuie sur le Titre Foncier n° 4589 délivré en 2018. Revendique les limites originelles du bornage.</p>
</div>
<div class="bg-surface-container p-4 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
<div class="flex items-center gap-2 mb-2 text-secondary">
<span class="material-symbols-outlined">person_alert</span>
<span class="font-label-md text-label-md font-bold">Arguments du Plaignant</span>
</div>
<p class="font-body-md text-body-md text-sm text-on-surface-variant">Conteste la borne Nord-Est, invoquant un acte de donation coutumier datant de 2015.</p>
</div>
</div>
</section>
<!-- Documents Section -->
<section>
<h3 class="font-title-lg text-title-lg text-on-surface flex items-center gap-2 mb-md border-b border-outline-variant pb-2">
<span class="material-symbols-outlined text-primary">folder_open</span> Pièces Jointes
                            </h3>
<div class="space-y-2">
<div class="flex items-center justify-between p-3 bg-surface rounded-lg border border-outline-variant hover:bg-surface-container-low transition-colors group cursor-pointer">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded bg-error/10 flex items-center justify-center text-error">
<span class="material-symbols-outlined">picture_as_pdf</span>
</div>
<div>
<div class="font-label-md text-label-md text-on-surface">Titre Foncier_Original.pdf</div>
<div class="font-label-sm text-label-sm text-on-surface-variant">Ajouté le 12 Oct • 2.4 MB</div>
</div>
</div>
<button class="text-primary opacity-0 group-hover:opacity-100 transition-opacity p-2 rounded-full hover:bg-surface-variant">
<span class="material-symbols-outlined">download</span>
</button>
</div>
<div class="flex items-center justify-between p-3 bg-surface rounded-lg border border-outline-variant hover:bg-surface-container-low transition-colors group cursor-pointer">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded bg-error/10 flex items-center justify-center text-error">
<span class="material-symbols-outlined">picture_as_pdf</span>
</div>
<div>
<div class="font-label-md text-label-md text-on-surface">Rapport_Expert_Geometre.pdf</div>
<div class="font-label-sm text-label-sm text-on-surface-variant">Ajouté le 06 Nov • 5.1 MB</div>
</div>
</div>
<button class="text-primary opacity-0 group-hover:opacity-100 transition-opacity p-2 rounded-full hover:bg-surface-variant">
<span class="material-symbols-outlined">download</span>
</button>
</div>
</div>
</section>
</div>
</div>
<!-- Right Pane (60%) -->
<div class="w-3/5 bg-surface-dim relative flex flex-col">
<!-- Map Header overlay -->
<div class="absolute top-4 left-4 z-10 bg-surface-container-lowest/90 backdrop-blur-md px-4 py-3 rounded-xl shadow-md border border-outline-variant/50 max-w-sm">
<h3 class="font-title-lg text-title-lg text-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-primary">public</span> Aperçu Géographique
                        </h3>
<p class="font-body-md text-body-md text-sm text-on-surface-variant mt-1">Zone Industrielle de Glo-Djigbé, Secteur C</p>
</div>
<!-- Map Container (Simulated) -->
<div class="flex-1 relative w-full h-full bg-[url('https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&amp;auto=format&amp;fit=crop&amp;w=2000&amp;q=80')] bg-cover bg-center" data-alt="An aerial, top-down satellite view of an industrial landscape representing a cadastral map. The terrain features a mix of plotted land parcels, subtle roads, and varying textures of earth and sparse vegetation. The color palette is muted, with dusty greens, earthy browns, and industrial grays. The image looks like a professional, high-resolution geographic information system (GIS) base map layer, perfect for overlaying digital land records.">
<!-- Map Overlay Tint -->
<div class="absolute inset-0 bg-surface-tint/10 mix-blend-multiply"></div>
<!-- Disputed Area Highlight -->
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-48 border-2 border-error bg-error/20 flex items-center justify-center backdrop-blur-[2px] transition-all hover:bg-error/30 cursor-pointer group">
<div class="bg-surface-container-lowest px-3 py-1.5 rounded shadow-lg flex items-center gap-2 opacity-90 group-hover:opacity-100 transform -translate-y-6">
<span class="material-symbols-outlined text-error text-sm">warning</span>
<span class="font-label-md text-label-md text-on-surface font-bold">Zone de Litige (450m²)</span>
</div>
<!-- Crosshair anchor -->
<div class="absolute w-4 h-4 border border-error/50 rounded-full flex items-center justify-center">
<div class="w-1 h-1 bg-error rounded-full"></div>
</div>
</div>
<!-- Floating Legend -->
<div class="absolute bottom-6 right-6 z-10 bg-surface-container-lowest p-4 rounded-xl shadow-lg border border-outline-variant min-w-[200px]">
<h4 class="font-label-md text-label-md font-bold text-on-surface mb-3 border-b border-outline-variant pb-1">Légende</h4>
<div class="space-y-2">
<div class="flex items-center gap-2">
<div class="w-4 h-4 border border-outline bg-surface-container-low"></div>
<span class="font-body-md text-body-md text-sm text-on-surface-variant">Parcelles Valides</span>
</div>
<div class="flex items-center gap-2">
<div class="w-4 h-4 border-2 border-error bg-error/20"></div>
<span class="font-body-md text-body-md text-sm text-on-surface-variant">Zone Contestée</span>
</div>
<div class="flex items-center gap-2">
<div class="w-4 h-0.5 bg-primary"></div>
<span class="font-body-md text-body-md text-sm text-on-surface-variant">Limites Officielles</span>
</div>
</div>
</div>
<!-- Map Controls -->
<div class="absolute top-4 right-4 z-10 flex flex-col gap-2">
<button class="w-10 h-10 bg-surface-container-lowest rounded-lg shadow-md border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-variant transition-colors">
<span class="material-symbols-outlined">add</span>
</button>
<button class="w-10 h-10 bg-surface-container-lowest rounded-lg shadow-md border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-variant transition-colors">
<span class="material-symbols-outlined">remove</span>
</button>
<button class="w-10 h-10 bg-surface-container-lowest rounded-lg shadow-md border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-variant transition-colors mt-2">
<span class="material-symbols-outlined">my_location</span>
</button>
</div>
</div>
</div>
</div>
</main>
<!-- Bottom Action Panel (Fixed) -->
<div class="fixed bottom-0 right-0 w-[calc(100%-18rem)] bg-surface-container border-t border-outline-variant shadow-[0_-4px_12px_rgba(31,78,121,0.05)] p-4 z-40">
<div class="max-w-6xl mx-auto flex items-end gap-6">
<div class="flex-1">
<label class="font-label-md text-label-md text-on-surface font-bold flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-primary text-sm">gavel</span> Résolution Administrative
                    </label>
<div class="relative">
<textarea class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest p-3 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none resize-none" placeholder="Saisir le rapport de résolution final et les conditions de déblocage..." rows="2"></textarea>
</div>
</div>
<div class="flex flex-col gap-3 shrink-0">
<div class="flex items-center gap-3">
<button class="flex items-center justify-center gap-2 px-4 py-2 bg-surface-container-lowest border border-primary text-primary rounded-lg font-label-md text-label-md hover:bg-surface-variant transition-colors shadow-sm h-[42px]">
<span class="material-symbols-outlined text-sm">upload_file</span> Joindre le jugement final
                        </button>
<!-- Utilizing inline style to enforce the requested emerald green, falling back to primary design principles for structure -->
<button class="flex items-center justify-center gap-2 px-6 py-2 rounded-lg font-label-md text-label-md font-bold text-white transition-all shadow-sm hover:shadow-md h-[42px] active:scale-95" style="background-color: #10B981;">
<span class="material-symbols-outlined text-sm">check_circle</span> Clôturer le litige (Débloquer la parcelle)
                        </button>
</div>
</div>
</div>
</div>
</div>
</body></html>