<!DOCTYPE html><html class="light" lang="fr"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Enregistrement d'un Nouveau Propriétaire - Système Foncier Glo</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Configuration (Provided) -->
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container": "#e5eeff",
                    "surface-container-low": "#eff4ff",
                    "on-tertiary": "#ffffff",
                    "background": "#f8f9ff",
                    "on-error": "#ffffff",
                    "tertiary-container": "#5a20c3",
                    "surface-bright": "#f8f9ff",
                    "on-tertiary-container": "#c7b0ff",
                    "on-tertiary-fixed-variant": "#5516be",
                    "tertiary-fixed-dim": "#d0bcff",
                    "on-surface-variant": "#42474f",
                    "on-primary-container": "#95bff1",
                    "inverse-on-surface": "#eaf1ff",
                    "secondary-container": "#7cbaff",
                    "primary-fixed-dim": "#a0cafc",
                    "tertiary-fixed": "#e9ddff",
                    "surface-container-highest": "#d3e4fe",
                    "surface-container-lowest": "#ffffff",
                    "secondary-fixed-dim": "#9ecaff",
                    "on-primary-fixed-variant": "#184974",
                    "surface-variant": "#d3e4fe",
                    "surface-dim": "#cbdbf5",
                    "error": "#ba1a1a",
                    "on-secondary-fixed-variant": "#00497c",
                    "inverse-primary": "#a0cafc",
                    "inverse-surface": "#213145",
                    "surface-tint": "#35618d",
                    "on-surface": "#0b1c30",
                    "error-container": "#ffdad6",
                    "primary-container": "#1f4e79",
                    "secondary": "#0b61a1",
                    "outline": "#72777f",
                    "primary-fixed": "#d1e4ff",
                    "on-background": "#0b1c30",
                    "on-primary-fixed": "#001d35",
                    "secondary-fixed": "#d1e4ff",
                    "on-tertiary-fixed": "#23005c",
                    "surface": "#f8f9ff",
                    "tertiary": "#41009d",
                    "on-error-container": "#93000a",
                    "on-primary": "#ffffff",
                    "surface-container-high": "#dce9ff",
                    "on-secondary-container": "#004a7d",
                    "outline-variant": "#c2c7d0",
                    "primary": "#00375e",
                    "on-secondary": "#ffffff",
                    "on-secondary-fixed": "#001d36"
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
                    "margin-mobile": "16px",
                    "gutter": "24px",
                    "base": "4px",
                    "sm": "1rem",
                    "margin-desktop": "40px",
                    "md": "1.5rem",
                    "xs": "0.5rem"
            },
            "fontFamily": {
                    "display-lg": ["Plus Jakarta Sans"],
                    "label-md": ["Plus Jakarta Sans"],
                    "title-lg": ["Plus Jakarta Sans"],
                    "body-md": ["Plus Jakarta Sans"],
                    "headline-lg-mobile": ["Plus Jakarta Sans"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "body-lg": ["Plus Jakarta Sans"],
                    "label-sm": ["Plus Jakarta Sans"],
                    "headline-md": ["Plus Jakarta Sans"]
            },
            "fontSize": {
                    "display-lg": ["48px", {"lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                    "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Custom scrollbar for webkit */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f8f9ff;
        }
        ::-webkit-scrollbar-thumb {
            background: #c2c7d0;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #72777f;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex font-body-md">
<!-- SideNavBar (from JSON) -->
<aside class="h-full w-64 fixed left-0 top-0 bg-primary dark:bg-primary-container shadow-md flex flex-col z-50">
<!-- Brand / Header -->
<div class="px-4 py-6 border-b border-primary-fixed-dim/20 mb-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shrink-0">
<img alt="Armoiries du Bénin" class="h-6 object-contain" data-alt="The coat of arms of Benin, a national emblem featuring two leopards holding a shield, set against a pristine white background. The image is rendered clearly and serves as a formal institutional crest." src="https://lh3.googleusercontent.com/aida-public/AB6AXuApyhmlTzwYL2VA_zc5Mk1fYNPsZ_RGAq_Mg-AUVm4ZUtI8ByXydQIxAtbK8m5QSanf45ESGGSSLDaxMRw1mYFOyagq0H_aajoiwajs-44sGrey_8lV97sYO81mX6il0MHft3GPrQa4B2DHs4dmL4Er5Ein7bJqSr3VHRpp9-btVCM7JMADqRO76g5kOLG6_sqBf9U-wKrCpOVBJ9sJqaMdqD5AkiTEPo7Pk2pwjW55wfZ-GUwNyls6ZQfgg_kOzQqIO9tLJEPcDknI">
</div>
<div>
<h1 class="font-headline-md text-headline-md font-bold text-on-primary dark:text-on-primary-container leading-tight">Cadastre National</h1>
<p class="font-label-sm text-label-sm text-primary-fixed-dim mt-1">Administration Foncière</p>
</div>
</div>
</div>
<!-- Navigation Tabs -->
<nav class="flex-1 px-2 space-y-2 font-label-md text-label-md overflow-y-auto"><!-- Navigation Tabs -->
<a class="flex items-center gap-3 px-4 py-3 bg-secondary-container text-on-secondary-container rounded-lg font-bold Active: scale-[0.98] transition-transform" href="#">
    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
    Tableau de bord
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-primary/80 hover:text-on-primary transition-colors hover:bg-primary-fixed-dim/10 rounded-lg" href="#">
    <span class="material-symbols-outlined">map</span>
    Parcelles
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-primary/80 hover:text-on-primary transition-colors hover:bg-primary-fixed-dim/10 rounded-lg" href="#">
    <span class="material-symbols-outlined">group</span>
    Propriétaires
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-primary/80 hover:text-on-primary transition-colors hover:bg-primary-fixed-dim/10 rounded-lg" href="#">
    <span class="material-symbols-outlined">swap_horiz</span>
    Transferts
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-primary/80 hover:text-on-primary transition-colors hover:bg-primary-fixed-dim/10 rounded-lg" href="#">
    <span class="material-symbols-outlined">gavel</span>
    Litiges
</a></nav>
</aside>
<!-- Main Content Wrapper -->
<div class="flex-1 ml-64 flex flex-col min-h-screen">
<!-- TopNavBar (from JSON) -->
<header class="docked full-width top-0 sticky z-40 bg-surface-container-lowest dark:bg-surface-dim border-b border-outline-variant shadow-sm px-xl py-xs flex justify-between items-center w-full">
<div class="flex items-center gap-4">
<h2 class="font-title-lg text-title-lg font-extrabold text-primary">Portail d'Administration</h2>
</div>
<div class="flex items-center gap-6">
<!-- Trailing Actions -->
<div class="flex gap-2">
<button class="p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high/50 dark:hover:bg-surface-container-highest/50 rounded-full transition-colors focus-within:ring-2 focus-within:ring-primary">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high/50 dark:hover:bg-surface-container-highest/50 rounded-full transition-colors focus-within:ring-2 focus-within:ring-primary">
<span class="material-symbols-outlined">settings</span>
</button>
</div>
<div class="h-8 w-px bg-outline-variant/50"></div>
<button class="font-label-md text-label-md text-primary font-bold hover:bg-primary/5 px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                    Déconnexion
                    <span class="material-symbols-outlined text-[20px]">logout</span>
</button>
</div>
</header>
<!-- Main Canvas -->
<main class="flex-1 p-margin-desktop bg-background flex flex-col items-center">
<!-- Breadcrumb -->
<div class="w-full max-w-4xl mb-6 flex items-center gap-2 font-label-md text-label-md text-on-surface-variant">
<a class="hover:text-primary transition-colors flex items-center gap-1" href="#"><span class="material-symbols-outlined text-[18px]">home</span> Accueil</a>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
<a class="hover:text-primary transition-colors" href="#">Propriétaires</a>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
<span class="text-on-surface font-semibold">Nouveau Propriétaire</span>
</div>
<!-- Bento Module: Main Form Card -->
<div class="w-full max-w-4xl bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_12px_rgba(31,78,121,0.05)] hover:shadow-[0_8px_20px_rgba(31,78,121,0.10)] transition-shadow duration-300 overflow-hidden flex flex-col">
<!-- Card Header -->
<div class="px-8 py-6 border-b border-outline-variant bg-surface-container-lowest flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center text-primary-container">
<span class="material-symbols-outlined text-[24px]">person_add</span>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface">Enregistrement d'un Nouveau Propriétaire</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Veuillez saisir les informations civiles pour créer un nouveau dossier foncier.</p>
</div>
</div>
<!-- Form Content -->
<form class="flex-1 flex flex-col">
<div class="p-8 space-y-8 flex-1">
<!-- Section 1: Civil Information Form -->
<div>
<h3 class="font-title-lg text-title-lg text-primary-container mb-6 flex items-center gap-2">
<span class="material-symbols-outlined text-[20px]">badge</span>
                                Informations Civiles
                            </h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Nom -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="nom">Nom <span class="text-error">*</span></label>
<input class="px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder-outline" id="nom" name="nom" placeholder="Ex: KOFFI" required="" type="text">
</div>
<!-- Prénom -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="prenom">Prénom <span class="text-error">*</span></label>
<input class="px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder-outline" id="prenom" name="prenom" placeholder="Ex: Jean" required="" type="text">
</div>
<!-- Numéro NPI/IFU (Full Width via col-span) -->
<div class="col-span-1 md:col-span-2 flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="npi">Numéro NPI/IFU <span class="text-error">*</span></label>
<input class="px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder-outline" id="npi" name="npi" placeholder="Saisir le numéro d'identification unique" required="" type="text">
</div>
<!-- Téléphone -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="telephone">Téléphone</label>
<div class="relative">
<span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">+229</span>
<input class="pl-14 pr-4 py-3 w-full bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder-outline" id="telephone" name="telephone" placeholder="00 00 00 00" type="tel">
</div>
</div>
<!-- Adresse Email -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="email_civil">Adresse Email</label>
<input class="px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder-outline" id="email_civil" name="email_civil" placeholder="jean.koffi@exemple.com" type="email">
</div>
<!-- Adresse Physique -->
<div class="col-span-1 md:col-span-2 flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface" for="adresse">Adresse Physique</label>
<textarea class="px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder-outline resize-none" id="adresse" name="adresse" placeholder="Précisez le quartier, la rue, le lot..." rows="3"></textarea>
</div>
</div>
</div>
<!-- Divider -->
<div class="h-px w-full bg-outline-variant/30"></div>
<!-- Section 2: Account Generation Section (Highlighted) -->
<div class="bg-surface-container p-6 rounded-xl border border-primary-fixed/50">
<h3 class="font-title-lg text-title-lg text-on-surface mb-2 flex items-center gap-2">
<span class="material-symbols-outlined text-[20px] text-primary">account_circle</span>
                                Génération automatique du Compte Consultant
                            </h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">Les identifiants ci-dessous permettront au propriétaire de consulter ses parcelles en ligne.</p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
<!-- Auto-generated Email -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="email_connexion">Email de connexion</label>
<div class="relative flex items-center">
<span class="absolute left-4 text-on-surface-variant material-symbols-outlined text-[20px]">mail</span>
<input class="pl-12 pr-4 py-3 w-full bg-surface-container-lowest/50 border border-outline-variant/50 rounded-lg font-body-md text-body-md text-on-surface focus:outline-none cursor-not-allowed" id="email_connexion" readonly="" type="text" value="koffi.j@citoyen.bj">
</div>
</div>
<!-- Auto-generated Password -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="password_temp">Mot de passe temporaire</label>
<div class="relative flex items-center group">
<span class="absolute left-4 text-on-surface-variant material-symbols-outlined text-[20px]">key</span>
<input class="pl-12 pr-12 py-3 w-full bg-surface-container-lowest/50 border border-outline-variant/50 rounded-lg font-body-md text-body-md text-on-surface focus:outline-none cursor-not-allowed tracking-widest" id="password_temp" readonly="" type="password" value="X9mP#kL2">
<button class="absolute right-4 text-on-surface-variant hover:text-primary transition-colors focus:outline-none" onclick="togglePasswordVisibility()" type="button">
<span class="material-symbols-outlined text-[20px]" id="visibility_icon">visibility</span>
</button>
</div>
</div>
</div>
<!-- Checkbox -->
<label class="flex items-center gap-3 cursor-pointer group w-fit">
<div class="relative flex items-center justify-center">
<input class="peer appearance-none w-5 h-5 border-2 border-outline-variant rounded bg-surface-container-lowest checked:bg-primary checked:border-primary transition-colors cursor-pointer focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-surface-container" id="activer_compte" type="checkbox">
<span class="material-symbols-outlined text-white text-[16px] absolute opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" style="font-variation-settings: &quot;FILL&quot; 1;">check</span>
</div>
<span class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">Activer le compte immédiatement</span>
</label>
</div>
</div>
<!-- Footer / Actions -->
<div class="px-8 py-5 border-t border-outline-variant bg-surface-container-lowest flex justify-end gap-4 rounded-b-xl">
<button class="px-6 py-2.5 rounded-lg border border-primary-container text-primary-container font-label-md text-label-md hover:bg-primary-container/5 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-container focus:ring-offset-2" type="button">
                            Annuler
                        </button>
<button class="px-6 py-2.5 rounded-lg bg-[#1F4E79] text-white font-label-md text-label-md hover:bg-opacity-90 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-[#1F4E79] focus:ring-offset-2 flex items-center gap-2" type="submit">
<span class="material-symbols-outlined text-[20px]">save</span>
                            Enregistrer le Propriétaire
                        </button>
</div>
</form>
</div>
</main>
</div>
<!-- Minimal script for password toggle interaction -->
<script>
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password_temp');
            const icon = document.getElementById('visibility_icon');
            
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                pwdInput.classList.remove('tracking-widest');
                icon.textContent = 'visibility_off';
            } else {
                pwdInput.type = 'password';
                pwdInput.classList.add('tracking-widest');
                icon.textContent = 'visibility';
            }
        }
    </script>


</body></html>