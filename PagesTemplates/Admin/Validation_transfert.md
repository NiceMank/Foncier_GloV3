<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Portail Foncier - Validation de Transfert</title>
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Config injected from Style Guidance -->
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed": "#001d35",
                        "surface-container": "#e5eeff",
                        "on-error": "#ffffff",
                        "on-error-container": "#93000a",
                        "surface-dim": "#cbdbf5",
                        "outline": "#72777f",
                        "on-tertiary-container": "#c7b0ff",
                        "surface-variant": "#d3e4fe",
                        "surface-container-lowest": "#ffffff",
                        "surface-bright": "#f8f9ff",
                        "primary": "#00375e",
                        "secondary-fixed-dim": "#9ecaff",
                        "tertiary": "#41009d",
                        "on-primary-container": "#95bff1",
                        "outline-variant": "#c2c7d0",
                        "primary-fixed": "#d1e4ff",
                        "primary-container": "#1f4e79",
                        "on-secondary-fixed": "#001d36",
                        "surface-container-low": "#eff4ff",
                        "secondary-container": "#7cbaff",
                        "tertiary-fixed-dim": "#d0bcff",
                        "surface": "#f8f9ff",
                        "tertiary-container": "#5a20c3",
                        "on-surface": "#0b1c30",
                        "tertiary-fixed": "#e9ddff",
                        "secondary-fixed": "#d1e4ff",
                        "inverse-surface": "#213145",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed-variant": "#00497c",
                        "on-surface-variant": "#42474f",
                        "on-primary-fixed-variant": "#184974",
                        "surface-container-high": "#dce9ff",
                        "secondary": "#0b61a1",
                        "error-container": "#ffdad6",
                        "primary-fixed-dim": "#a0cafc",
                        "background": "#f8f9ff",
                        "on-tertiary-fixed": "#23005c",
                        "on-primary": "#ffffff",
                        "on-background": "#0b1c30",
                        "surface-container-highest": "#d3e4fe",
                        "on-tertiary-fixed-variant": "#5516be",
                        "on-secondary-container": "#004a7d",
                        "inverse-primary": "#a0cafc",
                        "error": "#ba1a1a",
                        "surface-tint": "#35618d",
                        "on-tertiary": "#ffffff",
                        "inverse-on-surface": "#eaf1ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "1rem",
                        "xl": "3rem",
                        "base": "4px",
                        "margin-desktop": "40px",
                        "xs": "0.5rem",
                        "gutter": "24px",
                        "md": "1.5rem",
                        "lg": "2rem",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "title-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "display-lg": ["48px", { "lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }]
                    }
                },
            }
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md h-screen overflow-hidden flex">
<!-- SideNavBar -->
<nav class="bg-primary-container dark:bg-on-primary-fixed h-screen w-64 fixed left-0 top-0 shadow-md flex flex-col py-md px-sm z-50">
<div class="mb-xl">
<div class="flex items-center gap-3">
<img alt="Armoiries du Bénin" class="h-10 w-10 rounded-full bg-surface-container" data-alt="A small, high-quality circular avatar image showing the official coat of arms of Benin, rendered in rich, accurate colors. The image is set against a clean, light surface background, suitable for a professional government software interface. The lighting is bright and even, highlighting the details of the emblem." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4TsuB-St8k_sO1STl3usg38pRrcnRUMJ-bWt0HqQOdem3LHEhhVbA5doIeHYoSIhr6q_u16a07tPxRwmPpikk5OcnP5KY4IdSqg8t4T4tiwoSywE9X5vNAS1RhRVporg_rAemk8hw5tb9A72H3XSUWDv5N4hVn3sG2FWKRSUlbP2bv3zm5JraUBNHRAAAqn1O7aSJP-nBnhB2VREAUPUsbI2Ekqnb3hlDLvtNqShc1rTQff7GpbmgYEawEl7f3FOmRToDU86pzSkO"/>
<div>
<h1 class="font-headline-md text-headline-md font-bold text-surface-bright">Cadastre National</h1>
<p class="font-label-sm text-label-sm text-primary-fixed opacity-80">République du Bénin</p>
</div>
</div>
</div>
<div class="flex-1 space-y-2">
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-primary-fixed opacity-80 hover:opacity-100 hover:bg-secondary-container hover:text-on-secondary-container transition-colors" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Tableau de bord</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-primary-fixed opacity-80 hover:opacity-100 hover:bg-secondary-container hover:text-on-secondary-container transition-colors" href="#">
<span class="material-symbols-outlined">map</span>
<span class="font-label-md text-label-md">Cadastre</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-primary-fixed opacity-80 hover:opacity-100 hover:bg-secondary-container hover:text-on-secondary-container transition-colors" href="#">
<span class="material-symbols-outlined">description</span>
<span class="font-label-md text-label-md">Titres fonciers</span>
</a>
<!-- Active Tab -->
<a class="flex items-center gap-3 px-3 py-2 bg-secondary text-on-secondary rounded-lg font-bold shadow-sm transition-transform active:scale-95 duration-150" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">swap_horiz</span>
<span class="font-label-md text-label-md">Transferts</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-primary-fixed opacity-80 hover:opacity-100 hover:bg-secondary-container hover:text-on-secondary-container transition-colors" href="#">
<span class="material-symbols-outlined">gavel</span>
<span class="font-label-md text-label-md">Litiges</span>
</a>
</div>
<div class="mt-auto space-y-2 pt-4 border-t border-primary-fixed/20">
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-primary-fixed opacity-80 hover:opacity-100 hover:bg-secondary-container hover:text-on-secondary-container transition-colors" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="font-label-md text-label-md">Paramètres</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-primary-fixed opacity-80 hover:opacity-100 hover:bg-secondary-container hover:text-on-secondary-container transition-colors" href="#">
<span class="material-symbols-outlined">help</span>
<span class="font-label-md text-label-md">Aide</span>
</a>
</div>
<button class="mt-4 w-full bg-surface-bright text-primary-container font-label-md text-label-md font-bold py-2 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
            Nouvelle Demande
        </button>
</nav>
<!-- Main Content Area -->
<div class="flex-1 ml-64 flex flex-col h-screen">
<!-- TopNavBar -->
<header class="bg-surface dark:bg-inverse-surface shadow-sm h-16 flex items-center justify-between px-gutter w-full sticky top-0 z-40 border-b border-outline-variant">
<div class="flex items-center gap-4">
<h2 class="font-title-lg text-title-lg font-extrabold text-primary dark:text-inverse-primary">Portail Foncier</h2>
<div class="hidden md:flex items-center gap-6 ml-8">
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-all" href="#">Documents</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-all" href="#">Statistiques</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-all" href="#">Rapports</a>
</div>
</div>
<div class="flex items-center gap-4">
<button class="text-on-surface-variant hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-low">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="text-on-surface-variant hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-low">
<span class="material-symbols-outlined">history</span>
</button>
<div class="h-8 w-8 rounded-full overflow-hidden border border-outline-variant cursor-pointer ml-2">
<img alt="Profil Administrateur" class="h-full w-full object-cover" data-alt="A professional headshot of a government administrator, male, wearing a crisp suit and tie. He has a serious, trustworthy expression. The background is a plain, neutral grey, typical of corporate or official portraits. The lighting is even and professional, emphasizing a clean, modern aesthetic suitable for a high-security government platform." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQGXJ3A2nXZrMaDUVjE5iIuU_voYf2Y_iGd2daeMwGKkQ-uT4jcpUEus1ciaZfduur3ADJU3NsQOc-aI7H8TbivRuk2SoIL-qgtT584wH7Q5FvdUrBrlc0OghORCtqVAazL29Sl4hNZm9MdXDMpfw23dgNUa34QUct0v5eopdelfwjZK4itVVunP_zpcPr86RX-zRENQJPDsu_M9M59P1g3KwZppcCl9uxY1lWMlqCIWitiQVn5AQmM1sb2LX3_nibkap9qz8PawDV"/>
</div>
</div>
</header>
<!-- Split Screen View -->
<main class="flex-1 overflow-hidden flex flex-row p-gutter gap-gutter bg-surface-container-low">
<!-- Left Pane: Dossier Summary (3 columns equivalent) -->
<section class="w-1/4 min-w-[300px] flex flex-col gap-md h-full overflow-y-auto pr-2">
<div class="bg-surface-container-lowest rounded-lg border border-outline-variant p-md shadow-sm">
<div class="flex items-center justify-between mb-4 border-b border-outline-variant pb-2">
<h3 class="font-title-lg text-title-lg text-primary">Vendeur</h3>
<span class="material-symbols-outlined text-outline">person</span>
</div>
<div class="space-y-4">
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nom complet</p>
<p class="font-body-md text-body-md text-on-surface font-medium">Jean-Paul Dossou</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">NPI / IFU</p>
<p class="font-body-md text-body-md text-on-surface font-mono bg-surface-container-low p-1 rounded inline-block mt-1">1029384756 / 32019485729</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Téléphone</p>
<p class="font-body-md text-body-md text-on-surface">+229 97 00 11 22</p>
</div>
</div>
</div>
<div class="bg-surface-container-lowest rounded-lg border border-outline-variant p-md shadow-sm">
<div class="flex items-center justify-between mb-4 border-b border-outline-variant pb-2">
<h3 class="font-title-lg text-title-lg text-primary">Acquéreur</h3>
<span class="material-symbols-outlined text-outline">person_add</span>
</div>
<div class="space-y-4">
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nom complet</p>
<p class="font-body-md text-body-md text-on-surface font-medium">Marie-Claire Afiwa</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">NPI / IFU</p>
<p class="font-body-md text-body-md text-on-surface font-mono bg-surface-container-low p-1 rounded inline-block mt-1">5647382910 / 92857410234</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Téléphone</p>
<p class="font-body-md text-body-md text-on-surface">+229 95 33 44 55</p>
</div>
</div>
</div>
<div class="bg-surface-container-lowest rounded-lg border border-outline-variant p-md shadow-sm mt-auto">
<h4 class="font-label-md text-label-md text-primary mb-2">Statut du Dossier</h4>
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#5a20c3]/10 text-tertiary-container border border-[#5a20c3]/20">
<span class="material-symbols-outlined text-sm">pending_actions</span>
<span class="font-label-md text-label-md">En cours de vérification</span>
</div>
</div>
</section>
<!-- Center Pane: Document Preview (6 columns equivalent) -->
<section class="flex-1 bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm flex flex-col h-full relative overflow-hidden">
<div class="bg-surface border-b border-outline-variant p-sm flex justify-between items-center z-10 shadow-sm">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">description</span>
<h3 class="font-title-lg text-title-lg text-primary">Acte de Vente - TF_4958.pdf</h3>
</div>
<div class="flex gap-2">
<button class="p-1.5 rounded hover:bg-surface-container text-on-surface-variant transition-colors" title="Zoom In"><span class="material-symbols-outlined">zoom_in</span></button>
<button class="p-1.5 rounded hover:bg-surface-container text-on-surface-variant transition-colors" title="Zoom Out"><span class="material-symbols-outlined">zoom_out</span></button>
</div>
</div>
<div class="flex-1 bg-[#E2E8F0] p-md overflow-y-auto flex justify-center relative">
<!-- Simulated PDF Document -->
<div class="bg-white w-full max-w-2xl min-h-[800px] shadow-md p-8 border border-outline-variant relative">
<!-- Verification Checkmarks (Absolute positioning over document) -->
<div class="absolute top-20 right-8 text-emerald-600 bg-emerald-50 rounded-full p-1 border border-emerald-200 shadow-sm flex items-center justify-center" title="Identité Vendeur Vérifiée">
<span class="material-symbols-outlined text-lg">check_circle</span>
</div>
<div class="absolute top-40 right-8 text-emerald-600 bg-emerald-50 rounded-full p-1 border border-emerald-200 shadow-sm flex items-center justify-center" title="Identité Acquéreur Vérifiée">
<span class="material-symbols-outlined text-lg">check_circle</span>
</div>
<div class="absolute top-80 right-8 text-emerald-600 bg-emerald-50 rounded-full p-1 border border-emerald-200 shadow-sm flex items-center justify-center" title="Montant Vérifié">
<span class="material-symbols-outlined text-lg">check_circle</span>
</div>
<!-- Document Placeholder Content -->
<div class="text-center mb-8 pb-4 border-b-2 border-on-surface">
<h1 class="text-2xl font-serif font-bold text-on-surface uppercase tracking-widest">Acte de Vente</h1>
<p class="text-sm font-serif text-on-surface-variant mt-2">République du Bénin - Notariat de Cotonou</p>
</div>
<div class="space-y-6 font-serif text-on-surface-variant text-justify leading-relaxed">
<p>Par devant Maître Alexandre ZINZINDOHOUE, Notaire à la résidence de Cotonou, soussigné.</p>
<h2 class="font-bold text-on-surface uppercase text-sm bg-surface-container-low p-2 rounded">Ont Comparu :</h2>
<p><strong>Monsieur Jean-Paul DOSSOU</strong>, né le 12/04/1975 à Porto-Novo, profession Commerçant, domicilié à Cotonou, quartier Haie Vive. Agissant en son nom personnel.<br/>
                            Ci-après dénommé <em>"LE VENDEUR"</em>.</p>
<p><strong>Madame Marie-Claire AFIWA</strong>, née le 05/09/1982 à Ouidah, profession Enseignante, domiciliée à Abomey-Calavi, quartier Zoca. Agissant en son nom personnel.<br/>
                            Ci-après dénommée <em>"L'ACQUÉREUR"</em>.</p>
<h2 class="font-bold text-on-surface uppercase text-sm bg-surface-container-low p-2 rounded mt-6">Objet de la Vente :</h2>
<p>Le VENDEUR vend, cède et transporte, sous les garanties ordinaires et de droit en pareille matière, à L'ACQUÉREUR qui accepte, l'immeuble dont la désignation suit :</p>
<p class="bg-gray-50 p-4 border-l-4 border-primary italic">Une parcelle de terrain bâtie, sise à Cotonou, quartier Fidjrossè, d'une superficie de cinq cent mètres carrés (500 m²), faisant l'objet du Titre Foncier numéro 4958 de la circonscription foncière de Cotonou.</p>
</div>
</div>
</div>
</section>
<!-- Right Pane: Decision Panel (3 columns equivalent) -->
<section class="w-1/4 min-w-[320px] bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm p-md flex flex-col h-full overflow-y-auto">
<div class="border-b border-outline-variant pb-4 mb-6">
<h2 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
<span class="material-symbols-outlined">gavel</span>
                        Validation Finale
                    </h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Étape 4/4 : Décision du Chef de Service</p>
</div>
<div class="flex-1 flex flex-col gap-6">
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="verification_comments">Commentaires de vérification</label>
<textarea class="w-full rounded-lg border border-outline-variant bg-surface-bright p-3 text-on-surface font-body-md focus:border-secondary focus:ring-2 focus:ring-secondary-container/50 transition-all resize-none shadow-inner" id="verification_comments" placeholder="Saisissez vos observations concernant la conformité des documents et l'identité des parties..." rows="6"></textarea>
<p class="font-label-sm text-label-sm text-outline">Ces commentaires seront joints à l'historique du dossier.</p>
</div>
<div class="bg-surface-container-low p-4 rounded-lg border border-outline-variant/50 space-y-3">
<h4 class="font-label-md text-label-md text-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-sm">fact_check</span>
                            Checklist de confirmation
                        </h4>
<label class="flex items-start gap-3 cursor-pointer group">
<input class="mt-1 rounded border-outline text-primary focus:ring-secondary w-4 h-4 transition-colors" type="checkbox"/>
<span class="font-body-md text-body-md text-on-surface-variant group-hover:text-on-surface transition-colors">J'atteste avoir vérifié l'authenticité de l'acte notarié.</span>
</label>
<label class="flex items-start gap-3 cursor-pointer group">
<input class="mt-1 rounded border-outline text-primary focus:ring-secondary w-4 h-4 transition-colors" type="checkbox"/>
<span class="font-body-md text-body-md text-on-surface-variant group-hover:text-on-surface transition-colors">Aucune charge ou opposition n'est inscrite sur ce titre foncier.</span>
</label>
</div>
</div>
<div class="mt-auto pt-6 flex flex-col gap-3">
<button class="w-full py-3 px-4 bg-[#EF4444] hover:bg-[#DC2626] text-white rounded-lg font-label-md text-label-md font-bold shadow-sm flex items-center justify-center gap-2 transition-colors focus:ring-4 focus:ring-red-500/20 active:scale-[0.98]">
<span class="material-symbols-outlined">cancel</span>
                        Rejeter le Dossier
                    </button>
<button class="w-full py-3 px-4 bg-[#059669] hover:bg-[#047857] text-white rounded-lg font-label-md text-label-md font-bold shadow-sm flex items-center justify-center gap-2 transition-colors focus:ring-4 focus:ring-emerald-500/20 active:scale-[0.98] shadow-[inset_0_1px_1px_rgba(255,255,255,0.2)]">
<span class="material-symbols-outlined">edit_document</span>
                        Valider et Signer le Transfert
                    </button>
</div>
</section>
</main>
</div>
</body></html>