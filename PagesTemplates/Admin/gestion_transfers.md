<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Système Foncier Glo - Demandes de Transfert</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "surface-container": "#e5eeff",
                      "surface-container-lowest": "#ffffff",
                      "secondary-fixed": "#d1e4ff",
                      "tertiary-fixed": "#e9ddff",
                      "primary-container": "#1f4e79",
                      "on-background": "#0b1c30",
                      "surface-container-low": "#eff4ff",
                      "on-tertiary-fixed": "#23005c",
                      "on-surface-variant": "#42474f",
                      "inverse-primary": "#a0cafc",
                      "on-secondary-container": "#004a7d",
                      "on-error-container": "#93000a",
                      "secondary": "#0b61a1",
                      "on-tertiary-container": "#c7b0ff",
                      "on-secondary": "#ffffff",
                      "surface-dim": "#cbdbf5",
                      "tertiary-container": "#5a20c3",
                      "surface-container-highest": "#d3e4fe",
                      "surface": "#f8f9ff",
                      "error-container": "#ffdad6",
                      "surface-bright": "#f8f9ff",
                      "primary": "#00375e",
                      "on-error": "#ffffff",
                      "on-primary-fixed": "#001d35",
                      "on-primary-container": "#95bff1",
                      "on-primary-fixed-variant": "#184974",
                      "primary-fixed": "#d1e4ff",
                      "on-tertiary-fixed-variant": "#5516be",
                      "on-tertiary": "#ffffff",
                      "on-secondary-fixed-variant": "#00497c",
                      "inverse-on-surface": "#eaf1ff",
                      "surface-container-high": "#dce9ff",
                      "tertiary-fixed-dim": "#d0bcff",
                      "tertiary": "#41009d",
                      "on-surface": "#0b1c30",
                      "outline-variant": "#c2c7d0",
                      "on-secondary-fixed": "#001d36",
                      "secondary-container": "#7cbaff",
                      "error": "#ba1a1a",
                      "on-primary": "#ffffff",
                      "outline": "#72777f",
                      "primary-fixed-dim": "#a0cafc",
                      "surface-tint": "#35618d",
                      "secondary-fixed-dim": "#9ecaff",
                      "inverse-surface": "#213145",
                      "background": "#f8f9ff",
                      "surface-variant": "#d3e4fe"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "md": "1.5rem",
                      "lg": "2rem",
                      "margin-mobile": "16px",
                      "xs": "0.5rem",
                      "margin-desktop": "40px",
                      "sm": "1rem",
                      "base": "4px",
                      "gutter": "24px",
                      "xl": "3rem"
              },
              "fontFamily": {
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
                      ],
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
                      ]
              },
              "fontSize": {
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
                      ],
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
                      ]
              }
      },
          },
        }
    </script>
<style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex antialiased overflow-x-hidden">
<!-- SideNavBar -->
<nav class="fixed inset-y-0 left-0 flex flex-col p-md bg-primary dark:bg-primary-container shadow-md h-screen w-72 flex-shrink-0 z-50">
<div class="mb-lg">
<h1 class="font-headline-md text-headline-md font-bold text-surface-container-lowest">Système Foncier Glo</h1>
<p class="font-label-sm text-label-sm text-secondary-fixed opacity-80">Administration Territoriale</p>
</div>
<ul class="space-y-sm flex-1">
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">dashboard</span>
                    Tableau de bord
                </a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">map</span>
                    Cadastre
                </a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">description</span>
                    Titres Fonciers
                </a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 bg-secondary-container text-on-secondary-container rounded-lg font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95 shadow-sm" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">swap_horiz</span>
                    Transferts
                </a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">gavel</span>
                    Litiges
                </a>
</li>
<li>
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">inventory_2</span>
                    Archives
                </a>
</li>
</ul>
<div class="mt-auto pt-md border-t border-on-primary-fixed-variant">
<a class="flex items-center gap-3 px-4 py-3 text-secondary-fixed hover:bg-on-primary-fixed-variant rounded-lg transition-colors font-label-md text-label-md transition-all duration-200 ease-in-out active:scale-95" href="#">
<span class="material-symbols-outlined">settings</span>
                Paramètres
            </a>
</div>
</nav>
<!-- Main Content Wrapper -->
<div class="flex-1 ml-72 flex flex-col min-h-screen">
<!-- TopAppBar -->
<header class="flex items-center justify-between px-margin-desktop sticky top-0 z-40 bg-surface-container-lowest w-full h-16 border-b border-outline-variant">
<div class="flex items-center gap-4">
<h2 class="font-title-lg text-title-lg text-primary dark:text-primary-fixed">Gestion des Transferts</h2>
</div>
<div class="flex items-center gap-md">
<button class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
<span class="material-symbols-outlined">help_outline</span>
</button>
<div class="w-8 h-8 rounded-full bg-primary-fixed overflow-hidden flex items-center justify-center border border-outline-variant cursor-pointer">
<span class="material-symbols-outlined text-primary text-sm">person</span>
</div>
</div>
</header>
<!-- Canvas -->
<main class="flex-1 p-margin-desktop pt-md overflow-y-auto">
<div class="max-w-[1400px] mx-auto space-y-lg">
<!-- Header Section -->
<div>
<h1 class="font-headline-lg text-headline-lg text-primary mb-2">Demandes de Transfert</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Gérez et validez les dossiers de mutation de propriété immobilière.</p>
</div>
<!-- Filters -->
<div class="flex flex-wrap items-center gap-sm bg-surface-container-lowest p-4 rounded-lg border border-outline-variant shadow-sm">
<button class="px-4 py-2 bg-primary-container text-on-primary rounded-full font-label-md text-label-md transition-colors shadow-sm">
                        Tous
                    </button>
<button class="px-4 py-2 bg-surface text-on-surface-variant border border-outline-variant hover:bg-surface-variant rounded-full font-label-md text-label-md transition-colors flex items-center gap-2">
                        En attente
                        <span class="bg-error-container text-on-error-container text-xs py-0.5 px-2 rounded-full">12</span>
</button>
<button class="px-4 py-2 bg-surface text-on-surface-variant border border-outline-variant hover:bg-surface-variant rounded-full font-label-md text-label-md transition-colors flex items-center gap-2">
                        En vérification
                        <span class="bg-secondary-container text-on-secondary-container text-xs py-0.5 px-2 rounded-full">8</span>
</button>
<button class="px-4 py-2 bg-surface text-on-surface-variant border border-outline-variant hover:bg-surface-variant rounded-full font-label-md text-label-md transition-colors flex items-center gap-2">
                        Validé
                        <span class="bg-surface-container-high text-on-surface text-xs py-0.5 px-2 rounded-full">156</span>
</button>
<div class="ml-auto flex items-center gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="arrondissement-filter">Arrondissement:</label>
<select class="bg-surface border border-outline-variant text-on-surface font-label-md text-label-md rounded-md py-2 px-3 focus:ring-secondary focus:border-secondary outline-none" id="arrondissement-filter">
<option>Tous les arrondissements</option>
<option>Glo-Djigbé</option>
<option>Akassato</option>
<option>Zinvié</option>
</select>
</div>
</div>
<!-- Data Table Module (Bento Style) -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden flex flex-col">
<div class="overflow-x-auto">
<div class="absolute left-0 top-0 bottom-0 w-1 bg-[#4CAF50] hidden group-hover:block"></div><table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
<th class="px-6 py-4 font-medium">Référence Demande</th>
<th class="px-6 py-4 font-medium">Parcelle ID</th>
<th class="px-6 py-4 font-medium">Ancien Propriétaire</th>
<th class="px-6 py-4 font-medium">Nouvel Acquéreur</th>
<th class="px-6 py-4 font-medium">Date de Soumission</th>
<th class="px-6 py-4 font-medium">Statut</th>
<th class="px-6 py-4 font-medium text-right">Actions</th>
</tr>
</thead>
<tbody class="font-body-md text-body-md divide-y divide-outline-variant/30">
<!-- Row 1 -->
<tr class="hover:bg-surface-container transition-colors group">
<td class="px-6 py-4 font-medium text-primary">TR-2023-0891</td>
<td class="px-6 py-4 text-on-surface-variant font-mono text-sm">REF-GLO-882</td>
<td class="px-6 py-4">Jean Dupont</td>
<td class="px-6 py-4">Marie Curie</td>
<td class="px-6 py-4 text-on-surface-variant">24 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#FFF3E0] text-[#E65100] border border-[#FFE0B2]">
                                            En attente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="p-2 text-secondary hover:bg-secondary-fixed rounded-md transition-colors" title="Détails">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container transition-colors group bg-surface-bright/50">
<td class="px-6 py-4 font-medium text-primary">TR-2023-0890</td>
<td class="px-6 py-4 text-on-surface-variant font-mono text-sm">REF-GLO-415</td>
<td class="px-6 py-4">Kossi Mensah</td>
<td class="px-6 py-4">Société Immobilière BÉNIN</td>
<td class="px-6 py-4 text-on-surface-variant">22 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#E3F2FD] text-[#1565C0] border border-[#BBDEFB]">
                                            En vérification
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="p-2 text-secondary hover:bg-secondary-fixed rounded-md transition-colors" title="Détails">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container transition-colors group relative">
<td class="px-6 py-4 font-medium text-primary">TR-2023-0885</td>
<td class="px-6 py-4 text-on-surface-variant font-mono text-sm">REF-GLO-901</td>
<td class="px-6 py-4">Amadou Diallo</td>
<td class="px-6 py-4">Fatou N'Diaye</td>
<td class="px-6 py-4 text-on-surface-variant">15 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#E8F5E9] text-[#2E7D32] border border-[#C8E6C9]">
                                            Validé
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="p-2 text-secondary hover:bg-secondary-fixed rounded-md transition-colors" title="Détails">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container transition-colors group bg-surface-bright/50">
<td class="px-6 py-4 font-medium text-primary">TR-2023-0884</td>
<td class="px-6 py-4 text-on-surface-variant font-mono text-sm">REF-GLO-223</td>
<td class="px-6 py-4">Héritiers Sossou</td>
<td class="px-6 py-4">Gouvernement Local</td>
<td class="px-6 py-4 text-on-surface-variant">12 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#FFF3E0] text-[#E65100] border border-[#FFE0B2]">
                                            En attente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="p-2 text-secondary hover:bg-secondary-fixed rounded-md transition-colors" title="Détails">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container transition-colors group relative border-l-4 border-error">
<td class="px-6 py-4 font-medium text-primary">TR-2023-0880</td>
<td class="px-6 py-4 text-on-surface-variant font-mono text-sm">REF-GLO-114</td>
<td class="px-6 py-4">Moussa Traoré</td>
<td class="px-6 py-4">Entreprise ABC</td>
<td class="px-6 py-4 text-on-surface-variant">10 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-error-container/30 text-error border border-error/30">
                                            Litige
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="p-2 text-secondary hover:bg-secondary-fixed rounded-md transition-colors" title="Détails">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-6 py-4 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between">
<p class="font-body-md text-sm text-on-surface-variant">
                            Affichage de <span class="font-medium text-on-surface">1</span> à <span class="font-medium text-on-surface">5</span> sur <span class="font-medium text-on-surface">176</span> résultats
                        </p>
<nav aria-label="Pagination" class="flex gap-1">
<button class="px-3 py-1 rounded border border-outline-variant text-on-surface-variant hover:bg-surface-variant font-label-md text-sm disabled:opacity-50 disabled:cursor-not-allowed">Précédent</button>
<button class="px-3 py-1 rounded border border-primary bg-primary-container text-on-primary-container font-label-md text-sm font-bold">1</button>
<button class="px-3 py-1 rounded border border-outline-variant text-on-surface-variant hover:bg-surface-variant font-label-md text-sm">2</button>
<button class="px-3 py-1 rounded border border-outline-variant text-on-surface-variant hover:bg-surface-variant font-label-md text-sm">3</button>
<span class="px-2 py-1 text-on-surface-variant">...</span>
<button class="px-3 py-1 rounded border border-outline-variant text-on-surface-variant hover:bg-surface-variant font-label-md text-sm">Suivant</button>
</nav>
</div>
</div>
</div>
</main>
</div>
</body></html>