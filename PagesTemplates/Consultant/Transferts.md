<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Système Foncier Glo - Transfert de Propriété</title>
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
                      "on-tertiary": "#ffffff",
                      "on-secondary-fixed-variant": "#00497c",
                      "tertiary-fixed-dim": "#d0bcff",
                      "inverse-on-surface": "#eaf1ff",
                      "surface-container-high": "#dce9ff",
                      "on-surface": "#0b1c30",
                      "tertiary": "#41009d",
                      "on-secondary-fixed": "#001d36",
                      "secondary-container": "#7cbaff",
                      "outline-variant": "#c2c7d0",
                      "on-primary": "#ffffff",
                      "outline": "#72777f",
                      "error": "#ba1a1a",
                      "surface-tint": "#35618d",
                      "primary-fixed-dim": "#a0cafc",
                      "surface-variant": "#d3e4fe",
                      "secondary-fixed-dim": "#9ecaff",
                      "inverse-surface": "#213145",
                      "background": "#f8f9ff",
                      "surface-container": "#e5eeff",
                      "surface-container-lowest": "#ffffff",
                      "secondary-fixed": "#d1e4ff",
                      "tertiary-fixed": "#e9ddff",
                      "primary-container": "#1f4e79",
                      "on-background": "#0b1c30",
                      "on-secondary-container": "#004a7d",
                      "surface-container-low": "#eff4ff",
                      "on-tertiary-fixed": "#23005c",
                      "on-surface-variant": "#42474f",
                      "inverse-primary": "#a0cafc",
                      "on-tertiary-container": "#c7b0ff",
                      "on-secondary": "#ffffff",
                      "surface-dim": "#cbdbf5",
                      "on-error-container": "#93000a",
                      "secondary": "#0b61a1",
                      "surface": "#f8f9ff",
                      "tertiary-container": "#5a20c3",
                      "surface-container-highest": "#d3e4fe",
                      "surface-bright": "#f8f9ff",
                      "primary": "#00375e",
                      "on-error": "#ffffff",
                      "error-container": "#ffdad6",
                      "on-primary-fixed-variant": "#184974",
                      "primary-fixed": "#d1e4ff",
                      "on-tertiary-fixed-variant": "#5516be",
                      "on-primary-fixed": "#001d35",
                      "on-primary-container": "#95bff1",
                      "benin-blue": "#2E75B6",
                      "benin-slate": "#1F4E79",
                      "benin-green": "#10B981"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px",
                      "bento": "12px"
              },
              "spacing": {
                      "xl": "3rem",
                      "gutter": "24px",
                      "sm": "1rem",
                      "base": "4px",
                      "xs": "0.5rem",
                      "margin-desktop": "40px",
                      "margin-mobile": "16px",
                      "md": "1.5rem",
                      "lg": "2rem"
              },
              "fontFamily": {
                      "headline-md": [
                              "Plus Jakarta Sans"
                      ],
                      "body-lg": [
                              "Plus Jakarta Sans"
                      ],
                      "headline-lg-mobile": [
                              "Plus Jakarta Sans"
                      ],
                      "label-sm": [
                              "Plus Jakarta Sans"
                      ],
                      "label-md": [
                              "Plus Jakarta Sans"
                      ],
                      "headline-lg": [
                              "Plus Jakarta Sans"
                      ],
                      "title-lg": [
                              "Plus Jakarta Sans"
                      ],
                      "display-lg": [
                              "Plus Jakarta Sans"
                      ],
                      "body-md": [
                              "Plus Jakarta Sans"
                      ]
              },
              "fontSize": {
                      "headline-md": [
                              "24px",
                              {
                                      "lineHeight": "32px",
                                      "fontWeight": "600"
                              }
                      ],
                      "body-lg": [
                              "18px",
                              {
                                      "lineHeight": "28px",
                                      "fontWeight": "400"
                              }
                      ],
                      "headline-lg-mobile": [
                              "24px",
                              {
                                      "lineHeight": "32px",
                                      "fontWeight": "700"
                              }
                      ],
                      "label-sm": [
                              "12px",
                              {
                                      "lineHeight": "16px",
                                      "fontWeight": "600"
                              }
                      ],
                      "label-md": [
                              "14px",
                              {
                                      "lineHeight": "20px",
                                      "letterSpacing": "0.01em",
                                      "fontWeight": "500"
                              }
                      ],
                      "headline-lg": [
                              "32px",
                              {
                                      "lineHeight": "40px",
                                      "letterSpacing": "-0.01em",
                                      "fontWeight": "700"
                              }
                      ],
                      "title-lg": [
                              "20px",
                              {
                                      "lineHeight": "28px",
                                      "fontWeight": "600"
                              }
                      ],
                      "display-lg": [
                              "48px",
                              {
                                      "lineHeight": "60px",
                                      "letterSpacing": "-0.02em",
                                      "fontWeight": "700"
                              }
                      ],
                      "body-md": [
                              "16px",
                              {
                                      "lineHeight": "24px",
                                      "fontWeight": "400"
                              }
                      ]
              },
              "boxShadow": {
                  "level-1": "0 4px 12px rgba(31, 78, 121, 0.05)",
                  "level-2": "0 8px 20px rgba(31, 78, 121, 0.10)",
                  "level-3": "0 16px 32px rgba(31, 78, 121, 0.15)"
              }
            },
          }
        }
    </script>
<style>
        body {
            background-color: #F8FAFC;
        }
        .bento-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            border-radius: 12px;
        }
    </style>
</head>
<body class="text-on-background min-h-screen flex flex-col font-body-md text-body-md pb-24">
<!-- TopNavBar (Shared Component Translation) -->
<nav class="bg-surface border-b border-outline-variant shadow-sm flex justify-between items-center w-full px-margin-desktop py-xs sticky top-0 z-50">
<div class="flex items-center gap-xl">
<div class="font-headline-md text-headline-md font-bold text-primary flex items-center gap-2">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance</span>
                Benin Cadastre
            </div>
<!-- Hide nav links on mobile, show on desktop -->
<ul class="hidden md:flex gap-6 items-center">
<li class="text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-colors px-2 py-1 rounded cursor-pointer">Tableau de Bord</li>
<li class="text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-colors px-2 py-1 rounded cursor-pointer">Mes Titres</li>
<!-- Transactions is active as Transfert de Propriété relates to it -->
<li class="text-primary font-bold border-b-2 border-primary pb-1 cursor-pointer">Transactions</li>
<li class="text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-colors px-2 py-1 rounded cursor-pointer">Support</li>
</ul>
</div>
<div class="flex items-center gap-4">
<button class="text-on-surface-variant hover:bg-surface-container-high p-2 rounded-full transition-colors">
<span class="material-symbols-outlined">search</span>
</button>
<button class="text-on-surface-variant hover:bg-surface-container-high p-2 rounded-full transition-colors relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-1 right-1 w-2 h-2 bg-error rounded-full"></span>
</button>
<button class="text-on-surface-variant hover:bg-surface-container-high p-2 rounded-full transition-colors mr-2">
<span class="material-symbols-outlined">settings</span>
</button>
<div class="flex items-center gap-3 pl-4 border-l border-outline-variant cursor-pointer hover:opacity-80 transition-opacity">
<div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold font-label-md text-label-md overflow-hidden">
<img alt="Photo de profil de l'utilisateur" class="w-full h-full object-cover" data-alt="A highly detailed close-up portrait of a professional African man wearing a modern business suit. He is looking directly at the camera with a confident, slight smile. The lighting is bright and studio-quality, emphasizing clarity and trustworthiness suitable for a corporate profile avatar. The background is a soft, blurred neutral tone to ensure focus remains on his face. The overall mood is approachable yet authoritative, aligning with a secure, government-tech aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuARFZdzc9ZoHDQDT0jmzpz4MceVD3aM4tRPu2uyuZR04_5rvpE3wFR0WMXiofnqdrWh4d7PB6AcF9GVGdQJ2HHGpjanhIk_4EV5zifXxFj-Y_zUOXijdPdEETJ5LsWvVnCziyzmnMvVYQXE8tU9Rwjjgq0c8jNsw6Cd_epnsiJDbQqyJKcJckmNTJ4VHBAD1dfxErwed9MlV-8WQij3v3e7d6SzeSb2W3PJPrBAnBH2ESdCIB02H5L8Zzq_DPgeFGZGHEhxQpGVXFKt"/>
</div>
<span class="font-label-md text-label-md font-semibold hidden sm:block">M. Koffi</span>
</div>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="flex-grow container mx-auto px-margin-mobile md:px-margin-desktop py-lg max-w-6xl">
<!-- Page Header -->
<div class="mb-lg">
<h1 class="font-headline-lg text-headline-lg text-primary mb-2">Transfert de Propriété</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Veuillez renseigner les informations nécessaires pour initier le transfert de votre titre foncier.</p>
</div>
<!-- Horizontal Stepper -->
<div class="bento-card p-6 mb-8 w-full overflow-x-auto">
<div class="flex items-center min-w-max md:min-w-0 justify-between relative">
<!-- Line Behind -->
<div class="absolute top-1/2 left-0 right-0 h-[2px] bg-outline-variant -z-10 translate-y-[-50%] ml-8 mr-8"></div>
<!-- Active Line -->
<div class="absolute top-1/2 left-0 w-1/2 h-[2px] bg-benin-blue -z-10 translate-y-[-50%] ml-8"></div>
<!-- Step 1: Success -->
<div class="flex flex-col items-center gap-2 bg-white px-4">
<div class="w-10 h-10 rounded-full bg-benin-green text-white flex items-center justify-center shadow-md">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<span class="font-label-md text-label-md text-on-surface font-semibold">1. Sélection du Terrain</span>
</div>
<!-- Step 2: Active -->
<div class="flex flex-col items-center gap-2 bg-white px-4">
<div class="w-10 h-10 rounded-full bg-benin-blue text-white flex items-center justify-center shadow-md ring-4 ring-surface-container-high">
<span class="font-label-md text-label-md font-bold">2</span>
</div>
<span class="font-label-md text-label-md text-benin-blue font-bold">2. Informations de l'Acquéreur</span>
</div>
<!-- Step 3: Inactive -->
<div class="flex flex-col items-center gap-2 bg-white px-4 opacity-50">
<div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center border-2 border-outline-variant">
<span class="font-label-md text-label-md font-bold">3</span>
</div>
<span class="font-label-md text-label-md text-on-surface-variant">3. Justificatifs de Vente</span>
</div>
</div>
</div>
<!-- Two Column Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Left Column: Form -->
<div class="lg:col-span-7 bento-card p-6 md:p-8">
<div class="flex items-center gap-3 mb-6">
<div class="w-8 h-8 rounded bg-surface-container-low flex items-center justify-center text-primary">
<span class="material-symbols-outlined">person</span>
</div>
<h2 class="font-title-lg text-title-lg text-primary">Détails de l'Acquéreur</h2>
</div>
<form class="space-y-6">
<!-- Input: Nom complet -->
<div class="relative group">
<label class="block font-label-md text-label-md text-on-surface-variant mb-1">Nom complet de l'acquéreur</label>
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 font-body-md text-body-md text-on-surface focus:outline-none focus:border-benin-blue focus:ring-2 focus:ring-surface-container-high transition-all" placeholder="Ex: Jean Dupont" type="text"/>
</div>
<!-- Input: Numéro IFU / CNIB -->
<div class="relative group">
<label class="block font-label-md text-label-md text-on-surface-variant mb-1">Numéro IFU / CNIB</label>
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 font-body-md text-body-md text-on-surface focus:outline-none focus:border-benin-blue focus:ring-2 focus:ring-surface-container-high transition-all" placeholder="Numéro d'identification" type="text"/>
</div>
<!-- Grid for Phone & Email -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Input: Téléphone -->
<div class="relative group">
<label class="block font-label-md text-label-md text-on-surface-variant mb-1">Téléphone</label>
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 font-body-md text-body-md text-on-surface focus:outline-none focus:border-benin-blue focus:ring-2 focus:ring-surface-container-high transition-all" placeholder="+229 ..." type="tel"/>
</div>
<!-- Input: Email -->
<div class="relative group">
<label class="block font-label-md text-label-md text-on-surface-variant mb-1">Adresse Email</label>
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 font-body-md text-body-md text-on-surface focus:outline-none focus:border-benin-blue focus:ring-2 focus:ring-surface-container-high transition-all" placeholder="email@domaine.com" type="email"/>
</div>
</div>
</form>
</div>
<!-- Right Column: Documents -->
<div class="lg:col-span-5 bento-card p-6 md:p-8 flex flex-col">
<div class="flex items-center gap-3 mb-6">
<div class="w-8 h-8 rounded bg-surface-container-low flex items-center justify-center text-primary">
<span class="material-symbols-outlined">upload_file</span>
</div>
<h2 class="font-title-lg text-title-lg text-primary">Pièces Jointes</h2>
</div>
<div class="flex-grow flex flex-col">
<p class="font-body-md text-body-md text-on-surface-variant mb-4">Veuillez fournir une copie numérisée de l'acte de vente signé par les deux parties.</p>
<!-- Drag & Drop Zone -->
<div class="flex-grow border-2 border-dashed border-outline-variant rounded-xl bg-surface-container-low flex flex-col items-center justify-center p-8 hover:bg-surface-container transition-colors hover:border-benin-blue cursor-pointer group">
<div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-4xl text-benin-blue">cloud_upload</span>
</div>
<p class="font-label-md text-label-md text-primary font-semibold text-center mb-1">Glissez-déposez l'acte de vente signé</p>
<p class="font-body-md text-body-md text-on-surface-variant text-center text-sm">(PDF ou PNG, max 10Mo)</p>
<button class="mt-4 px-4 py-2 border border-benin-blue text-benin-blue rounded-lg font-label-md text-label-md hover:bg-surface-container-high transition-colors">
                            Parcourir les fichiers
                        </button>
</div>
</div>
</div>
</div>
</main>
<!-- Bottom Action Bar -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-outline-variant shadow-[0_-4px_12px_rgba(31,78,121,0.05)] px-margin-mobile md:px-margin-desktop py-4 z-40">
<div class="container mx-auto max-w-6xl flex justify-between items-center">
<button class="px-6 py-2.5 rounded-lg font-label-md text-label-md font-semibold text-on-surface-variant bg-surface-container-highest hover:bg-outline-variant transition-colors">
                Annuler
            </button>
<button class="px-6 py-2.5 rounded-lg font-label-md text-label-md font-semibold text-white bg-benin-slate hover:opacity-90 shadow-sm transition-opacity flex items-center gap-2">
                Soumettre le dossier au SADE
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
</div>
</body></html>