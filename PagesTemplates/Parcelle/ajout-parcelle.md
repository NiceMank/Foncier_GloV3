<!DOCTYPE html><html class="light" lang="fr" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Ajouter une Nouvelle Parcelle - Système Foncier Glo</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#d0bcff",
                        "on-primary-container": "#95bff1",
                        "on-error": "#ffffff",
                        "on-secondary-container": "#004a7d",
                        "on-primary-fixed": "#001d35",
                        "secondary-fixed": "#d1e4ff",
                        "primary-container": "#1f4e79",
                        "surface-container-highest": "#d3e4fe",
                        "surface-container-high": "#dce9ff",
                        "on-tertiary-fixed-variant": "#5516be",
                        "on-tertiary-fixed": "#23005c",
                        "surface-container-low": "#eff4ff",
                        "on-error-container": "#93000a",
                        "on-primary": "#ffffff",
                        "outline": "#72777f",
                        "surface-dim": "#cbdbf5",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#001d36",
                        "surface-tint": "#35618d",
                        "surface-container": "#e5eeff",
                        "secondary-fixed-dim": "#9ecaff",
                        "on-secondary-fixed-variant": "#00497c",
                        "primary-fixed": "#d1e4ff",
                        "on-surface": "#0b1c30",
                        "error": "#ba1a1a",
                        "tertiary-container": "#5a20c3",
                        "surface": "#f8f9ff",
                        "background": "#f8f9ff",
                        "secondary-container": "#7cbaff",
                        "secondary": "#0b61a1",
                        "tertiary-fixed": "#e9ddff",
                        "on-tertiary-container": "#c7b0ff",
                        "primary-fixed-dim": "#a0cafc",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#c2c7d0",
                        "error-container": "#ffdad6",
                        "on-background": "#0b1c30",
                        "surface-bright": "#f8f9ff",
                        "inverse-primary": "#a0cafc",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed-variant": "#184974",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-variant": "#d3e4fe",
                        "tertiary": "#41009d",
                        "primary": "#00375e",
                        "on-surface-variant": "#42474f",
                        "inverse-surface": "#213145"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "3rem",
                        "lg": "2rem",
                        "base": "4px",
                        "xs": "0.5rem",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px",
                        "sm": "1rem",
                        "gutter": "24px",
                        "md": "1.5rem"
                    },
                    "fontFamily": {
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "title-lg": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
<style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bento-card {
            background-color: #ffffff;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            transition: all 0.3s ease;
        }
        .bento-card:hover {
            box-shadow: 0 8px 20px rgba(31, 78, 121, 0.10);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen">
<!-- SideNavBar Shell -->
<aside class="fixed left-0 top-0 h-full flex flex-col py-6 bg-primary-container dark:bg-inverse-surface border-r border-outline-variant w-64 shadow-md z-50">
<div class="px-6 mb-10">
<h1 class="text-title-lg font-title-lg font-bold text-white">Système Foncier Glo</h1>
<p class="text-label-sm font-label-sm text-on-primary-container opacity-80">Administration Centrale</p>
</div>
<nav class="flex-1 space-y-2 overflow-y-auto">
<a class="flex items-center gap-3 text-white/80 hover:text-white px-4 py-3 mx-2 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="text-label-md font-label-md">Tableau de bord</span>
</a>
<a class="flex items-center gap-3 text-white/80 hover:text-white px-4 py-3 mx-2 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">description</span>
<span class="text-label-md font-label-md">Titres Fonciers</span>
</a>
<!-- Active State: Cadastre -->
<a class="flex items-center gap-3 bg-secondary-container text-on-secondary-container rounded-lg px-4 py-3 mx-2 scale-[0.99] transition-transform" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: &quot;FILL&quot; 1;">map</span>
<span class="text-label-md font-label-md">Cadastre</span>
</a>
<a class="flex items-center gap-3 text-white/80 hover:text-white px-4 py-3 mx-2 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">pending_actions</span>
<span class="text-label-md font-label-md">Demandes</span>
</a>
<a class="flex items-center gap-3 text-white/80 hover:text-white px-4 py-3 mx-2 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="text-label-md font-label-md">Paramètres</span>
</a>
</nav>
<div class="px-4 mt-auto space-y-2">
<button class="w-full py-3 bg-secondary text-white rounded-lg font-label-md flex items-center justify-center gap-2 mb-6 hover:bg-opacity-90 transition-all">
<span class="material-symbols-outlined">add</span>
                Nouvelle Inscription
            </button>
<a class="flex items-center gap-3 text-white/80 hover:text-white px-4 py-2 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">help</span>
<span class="text-label-md font-label-md">Aide</span>
</a>
<a class="flex items-center gap-3 text-white/80 hover:text-white px-4 py-2 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">logout</span>
<span class="text-label-md font-label-md">Déconnexion</span>
</a>
</div>
</aside>
<!-- TopNavBar Shell -->
<header class="flex justify-between items-center w-full pl-72 pr-10 py-4 bg-surface dark:bg-surface-dim border-b border-outline-variant fixed top-0 left-0 z-40 shadow-sm">
<div class="flex items-center flex-1 max-w-xl">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-low rounded-full border-none focus:ring-2 focus:ring-primary/20 outline-none text-label-md font-label-md" placeholder="Rechercher une parcelle, un ID..." type="text">
</div>
</div>
<div class="flex items-center gap-6">
<div class="flex gap-4">
<button class="p-2 text-primary hover:bg-surface-container-low rounded-full transition-all relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
</button>
<button class="p-2 text-primary hover:bg-surface-container-low rounded-full transition-all">
<span class="material-symbols-outlined">history</span>
</button>
</div>
<div class="flex items-center gap-3 border-l border-outline-variant pl-6">
<div class="text-right hidden sm:block">
<p class="text-label-md font-label-md font-bold text-on-surface">Admin Bénin</p>
<p class="text-[10px] text-outline uppercase tracking-wider">Superviseur</p>
</div>
<img alt="Profil Administrateur" class="w-10 h-10 rounded-full border-2 border-primary/20 object-cover" data-alt="A professional close-up portrait of a West African man in a business suit, representing a government official. He has a warm yet serious expression, set against a blurred modern office background with soft natural lighting. The overall aesthetic is clean, professional, and corporate, aligning with a high-trust institutional environment." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDswnnWMWYd0ClivHPUXLF-NFxch7KMmDHiyru7CkRhSSanVpuSXx4SwIGpdZ-rn9ExiDfjhDlObxJ5cRhqGN1IVciD_2Rs0sH_iRzvDItnzmAMeDjNXlwIakpnLUnewbPEeMOdkTMbrd0jHqY9u_UzPatOXySP7Z_ArlQzC9tp0b22DfRNacMPOgsG8lzlKvckNAtnEM4SeWdoNAlMW_-AmX_8X4eahAoTL9FqBJVyCNkY-ikJlvSwNuzmEolzFWYGy5JN8dpfOS9N">
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="pl-72 pr-10 pt-28 pb-10 min-h-screen">
<!-- Header Section -->
<div class="mb-8 flex justify-between items-end">
<div>
<nav class="flex gap-2 text-label-sm font-label-sm text-outline mb-2">
<a class="hover:text-primary" href="#">Cadastre</a>
<span class="">/</span>
<span class="text-primary-container font-bold">Nouvelle Parcelle</span>
</nav>
<h2 class="text-headline-lg font-headline-lg text-primary">Ajouter une Nouvelle Parcelle</h2>
<p class="text-body-md font-body-md text-on-surface-variant max-w-2xl">Enregistrez de nouvelles données cadastrales dans le registre national. Assurez-vous que toutes les coordonnées géographiques sont précises.</p>
</div>
</div>
<!-- Form Grid (Bento) -->
<form class="grid grid-cols-12 gap-gutter">
<!-- Left Column: Geographic Info -->
<div class="col-span-12 lg:col-span-7 space-y-gutter">
<div class="bento-card p-md rounded-xl">
<div class="flex items-center gap-3 mb-6">
<div class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary-container">
<span class="material-symbols-outlined">location_on</span>
</div>
<h3 class="text-title-lg font-title-lg text-on-surface">Informations Géographiques</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="col-span-2">
    <label class="block text-label-md font-label-md text-on-surface mb-2">Propriétaire</label>
    <div class="relative group">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">search</span>
        <button type="button" class="w-full flex items-center justify-between pl-12 pr-4 py-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-body-md text-left">
            <span class="text-outline">Sélectionner un propriétaire (Nom, NPI, IFU)...</span>
            <span class="material-symbols-outlined text-outline">expand_more</span>
        </button>
        <div class="hidden absolute top-full left-0 w-full mt-2 bg-white border border-outline-variant rounded-lg shadow-xl z-10">
            <div class="p-2">
                <input type="text" class="w-full p-2 text-sm bg-surface-container-low border-none rounded-md focus:ring-0" placeholder="Rechercher...">
            </div>
            <ul class="max-h-48 overflow-y-auto py-2">
                <li class="px-4 py-2 hover:bg-primary-container/5 cursor-pointer text-body-md">Koffi Mensah (NPI: 123456789)</li>
                <li class="px-4 py-2 hover:bg-primary-container/5 cursor-pointer text-body-md">Ablavi Dossou (NPI: 987654321)</li>
                <li class="px-4 py-2 hover:bg-primary-container/5 cursor-pointer text-body-md">Jean-Pierre Agossa (NPI: 456789123)</li>
            </ul>
        </div>
    </div>
</div><div class="col-span-2">
<label class="block text-label-md font-label-md text-on-surface mb-2">Référence Cadastrale</label>
<input class="w-full p-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-body-md" placeholder="ex: CAD-2024-001" type="text">
</div>
<div>
<label class="block text-label-md font-label-md text-on-surface mb-2">Superficie (en Hectares)</label>
<div class="relative">
<input class="w-full p-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-body-md" placeholder="0.00" step="0.01" type="number">
<span class="absolute right-4 top-1/2 -translate-y-1/2 text-outline font-label-sm">ha</span>
</div>
</div>
<div>
<label class="block text-label-md font-label-md text-on-surface mb-2">Arrondissement / Localité</label>
<select class="w-full p-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-body-md appearance-none">
<option value="">Sélectionner une localité</option>
<option value="cotonou-1">Cotonou - 1er Arrondissement</option>
<option value="calavi">Abomey-Calavi</option>
<option value="porto-novo">Porto-Novo</option>
<option value="parakou">Parakou</option>
</select>
</div>
<div class="col-span-2 pt-4">
<p class="text-label-sm font-label-sm text-outline uppercase mb-4 tracking-wider">Coordonnées GPS (WGS 84)</p>
<div class="grid grid-cols-2 gap-4">
<div class="relative">
<span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary font-bold">LAT</span>
<input class="w-full pl-14 pr-4 py-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none" placeholder="6.3703" type="text">
</div>
<div class="relative">
<span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary font-bold">LNG</span>
<input class="w-full pl-14 pr-4 py-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none" placeholder="2.3912" type="text">
</div>
</div>
</div>
</div>
</div>
<!-- Preview Map Placeholder -->
<div class="bento-card rounded-xl overflow-hidden relative h-[280px]">
<img alt="Carte de prévisualisation" class="w-full h-full object-cover grayscale-[0.5] opacity-80" data-alt="A high-definition satellite map view of a coastal West African landscape, showing precise cadastral boundary overlays in glowing blue lines. The map features lush green terrain, structured urban planning areas, and clear water bodies. The lighting is bright and clear, emphasizing topographical details with a professional, data-centric GIS visualization aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0_DLhA1_HfXfCrpwNUcoDlf_gvPcLO2gAXhKtKNA54M8VLvvq1-E4l6XaWLa-0qeLD0cp_EGxrCKmqrlvFixbsBlynLkmvUtJTf5O1CsY7ZIr10jQHDPVfIMDq5TCmtAZOBwIboIJOxoC8xeKLlfsqTx1WrCr2Kr7zQXlGf54QM98iZsOJGyeH_4HLqBo65lc6L5jG2agoJEvQQDYymTaD0eirOhi16A3wZ30YSHx-fbA_rs1MWkoDcKAcz6L1fjw9NhO-feNducW">
<div class="absolute inset-0 bg-primary/10 flex items-center justify-center">
<div class="bg-white/90 backdrop-blur px-6 py-3 rounded-full shadow-lg flex items-center gap-3">
<span class="material-symbols-outlined text-primary animate-pulse">location_searching</span>
<span class="text-label-md font-label-md text-primary-container">Génération automatique du périmètre...</span>
</div>
</div>
<div class="absolute top-4 right-4 flex flex-col gap-2">
<button class="bg-white p-2 rounded-lg shadow-md hover:bg-surface-container-low transition-colors" type="button"><span class="material-symbols-outlined">zoom_in</span></button>
<button class="bg-white p-2 rounded-lg shadow-md hover:bg-surface-container-low transition-colors" type="button"><span class="material-symbols-outlined">zoom_out</span></button>
<button class="bg-white p-2 rounded-lg shadow-md hover:bg-surface-container-low transition-colors" type="button"><span class="material-symbols-outlined">layers</span></button>
</div>
</div>
</div>
<!-- Right Column: Details & Documents -->
<div class="col-span-12 lg:col-span-5 space-y-gutter">
<div class="bento-card p-md rounded-xl">
<div class="flex items-center gap-3 mb-6">
<div class="w-10 h-10 rounded-lg bg-secondary-container/10 flex items-center justify-center text-secondary">
<span class="material-symbols-outlined">assignment</span>
</div>
<h3 class="text-title-lg font-title-lg text-on-surface">Détails Administratifs</h3>
</div>
<div class="space-y-6">
<div>
<label class="block text-label-md font-label-md text-on-surface mb-2">Statut Initial</label>
<div class="grid grid-cols-3 gap-2">
<label class="cursor-pointer">
<input checked="" class="peer hidden" name="status" type="radio" value="libre">
<div class="text-center p-3 rounded-lg border border-outline-variant peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-700 transition-all text-label-sm">Libre</div>
</label>
<label class="cursor-pointer">
<input class="peer hidden" name="status" type="radio" value="attribue">
<div class="text-center p-3 rounded-lg border border-outline-variant peer-checked:bg-secondary-container/20 peer-checked:border-secondary peer-checked:text-secondary transition-all text-label-sm">Attribué</div>
</label>
<label class="cursor-pointer">
<input class="peer hidden" name="status" type="radio" value="litige">
<div class="text-center p-3 rounded-lg border border-outline-variant peer-checked:bg-error-container/20 peer-checked:border-error peer-checked:text-error transition-all text-label-sm">Litige</div>
</label>
</div>
</div>
<div>
<label class="block text-label-md font-label-md text-on-surface mb-2">Notes administratives</label>
<textarea class="w-full p-3 bg-surface rounded-lg border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-body-md resize-none" placeholder="Précisez les particularités du terrain ou l'historique juridique..." rows="4"></textarea>
</div>
</div>
</div>
<div class="bento-card p-md rounded-xl border-dashed border-2 border-primary/20 bg-primary/5">
<div class="flex items-center gap-3 mb-6">
<div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center text-white">
<span class="material-symbols-outlined">upload_file</span>
</div>
<h3 class="text-title-lg font-title-lg text-on-surface">Documents Justificatifs</h3>
</div>
<div class="border-2 border-dashed border-outline-variant rounded-xl p-8 text-center bg-white/50 hover:bg-white transition-colors cursor-pointer group">
<span class="material-symbols-outlined text-[48px] text-outline group-hover:text-primary transition-colors mb-4">cloud_upload</span>
<p class="text-body-md font-bold text-on-surface mb-1">Levé Topographique / Titre Foncier</p>
<p class="text-label-sm text-outline mb-4">Glissez-déposez vos fichiers ici ou <span class="text-primary underline">parcourez</span></p>
<p class="text-[10px] text-outline uppercase tracking-widest">PDF, PNG ou JPG (Max 10Mo)</p>
</div>
<div class="mt-6 space-y-3">
<div class="flex items-center justify-between p-3 bg-white rounded-lg border border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-error">picture_as_pdf</span>
<span class="text-label-md text-on-surface truncate max-w-[150px]">plan_cadastre_2024.pdf</span>
</div>
<button class="text-outline hover:text-error transition-colors" type="button">
<span class="material-symbols-outlined">delete</span>
</button>
</div>
</div>
</div>
</div>
</form>
<!-- Action Footer -->
<div class="mt-10 flex justify-end gap-4 items-center pt-8 border-t border-outline-variant">
<p class="text-label-sm text-outline italic mr-auto">Dernière modification par Admin-04 à 14:22</p>
<button class="px-8 py-3 rounded-lg border border-secondary text-secondary font-label-md hover:bg-secondary/5 transition-all" type="button">
                Annuler
            </button>
<button class="px-8 py-3 rounded-lg bg-primary-container text-white font-label-md hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center gap-2" type="submit">
<span class="material-symbols-outlined text-[20px]">save</span>
                Enregistrer la parcelle
            </button>
</div>
</main>
<script>
        // Form interactivity logic
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                // Simulation of saving animation
                const btn = e.target.querySelector('button[type="submit"]');
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Traitement...';
                btn.disabled = true;
                
                setTimeout(() => {
                    btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Enregistré !';
                    btn.classList.replace('bg-primary-container', 'bg-emerald-600');
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.classList.replace('bg-emerald-600', 'bg-primary-container');
                        btn.disabled = false;
                    }, 2000);
                }, 1500);
            });

            // Drag and drop visual feedback
            const dropzone = document.querySelector('.cursor-pointer.group');
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, () => {
                    dropzone.classList.add('border-primary', 'bg-primary/10');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, () => {
                    dropzone.classList.remove('border-primary', 'bg-primary/10');
                }, false);
            });
        });
    </script>


</body></html>