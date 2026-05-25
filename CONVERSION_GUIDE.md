# 📋 GUIDE DE CONVERSION TAILWIND → BOOTSTRAP 5

## 🎯 Correspondances Principales

### **Layout & Spacing**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `w-full` | `w-100` | Largeur 100% |
| `h-screen` | `vh-100` | Hauteur de l'écran |
| `flex` | `d-flex` | Flexbox |
| `flex-col` | `flex-column` | Direction colonne |
| `items-center` | `align-items-center` | Align items |
| `justify-between` | `justify-content-between` | Justify content |
| `gap-3` | `gap-3` (var CSS) | Écart entre éléments |
| `p-4` | `p-3` | Padding |
| `px-6` | `px-4` | Padding horizontal |
| `py-3` | `py-2` | Padding vertical |
| `m-0` | `m-0` | Margin |
| `mt-auto` | `mt-auto` | Margin top auto |
| `space-y-sm` | `gap-1` | Espacement vertical |

### **Colors & Backgrounds**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `bg-primary` | `bg-primary` | Fond primaire |
| `bg-gray-50` | `bg-light` | Fond clair |
| `bg-white` | `bg-white` | Fond blanc |
| `text-white` | `text-white` | Texte blanc |
| `text-gray-800` | `text-dark` | Texte foncé |
| `text-primary` | `text-primary` | Texte primaire |
| `text-secondary-fixed` | Couleur personnalisée | CSS custom |
| `opacity-80` | `opacity-80` (var CSS) | Opacité |
| `hover:bg-gray-100` | `hover:bg-light` | Hover state |

### **Typography**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `text-sm` | `fs-6` (12px) | Petite taille |
| `text-lg` | `fs-5` (18px) | Grande taille |
| `text-2xl` | `fs-3` (24px) | Très grande |
| `font-bold` | `fw-bold` | Gras |
| `font-semibold` | `fw-600` | Semi-gras |
| `font-medium` | `fw-500` | Moyen |
| `font-headline-md` | Classe custom | Font personnalisée |

### **Borders & Shadows**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `border` | `border` | Bordure |
| `border-gray-200` | `border-light` | Bordure claire |
| `rounded-lg` | `rounded-2` | Coins arrondis |
| `rounded-full` | `rounded-pill` | Entièrement arrondi |
| `shadow-md` | `shadow-sm` | Ombre |
| `shadow-lg` | `shadow` | Grande ombre |

### **Positioning**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `fixed` | `position-fixed` | Position fixe |
| `sticky` | `position-sticky` | Position sticky |
| `inset-y-0` | CSS custom | Haut et bas 0 |
| `inset-0` | CSS custom | Tous côtés 0 |
| `z-50` | `z-index: 50` | Index de pile |

### **Responsive**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `md:w-1/2` | `col-md-6` | 50% sur md |
| `lg:grid-cols-4` | `col-lg-3` | 25% sur lg |
| `hidden md:block` | `d-none d-md-block` | Caché sauf md |

### **Forms & Buttons**

| Tailwind | Bootstrap | Notes |
|----------|-----------|-------|
| `border rounded px-4 py-2` | `form-control` | Input |
| `bg-blue-600 text-white` | `btn btn-primary` | Bouton |
| `bg-blue-600 hover:bg-blue-700` | `btn-primary:hover` | Hover bouton |
| `border border-gray-300` | `form-control` | Entrée |

---

## 🔄 PROCESSUS DE CONVERSION

### Étape 1: Extraire le HTML
Copier le contenu entre `<body>` et `</body>`

### Étape 2: Remplacer les classes
Utiliser find/replace intelligents pour les patterns

### Étape 3: Ajouter Bootstrap CSS
```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
```

### Étape 4: Créer CSS custom
Pour les couleurs Material Design custom:
```css
:root {
  --bs-primary: #00375e;
  --bs-secondary: #0b61a1;
  /* etc */
}
```

### Étape 5: Tester et valider
Vérifier la responsivité et les interactions

---

## ⚡ EXEMPLES DE CONVERSION

### Exemple 1: Card

**AVANT (Tailwind):**
```html
<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
    <h3 class="text-lg font-bold text-gray-800">Titre</h3>
    <p class="text-gray-600 text-sm">Description</p>
</div>
```

**APRÈS (Bootstrap):**
```html
<div class="card">
    <div class="card-body">
        <h3 class="card-title fw-bold">Titre</h3>
        <p class="card-text text-muted fs-6">Description</p>
    </div>
</div>
```

### Exemple 2: Navbar

**AVANT (Tailwind):**
```html
<nav class="bg-white shadow-md sticky top-0">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
        <h1 class="text-2xl font-bold">Logo</h1>
        <button>Menu</button>
    </div>
</nav>
```

**APRÈS (Bootstrap):**
```html
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container-lg">
        <span class="navbar-brand fs-4 fw-bold">Logo</span>
        <button class="navbar-toggler">Menu</button>
    </div>
</nav>
```

### Exemple 3: Grid/Layout

**AVANT (Tailwind):**
```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg p-4">Item 1</div>
    <div class="bg-white rounded-lg p-4">Item 2</div>
</div>
```

**APRÈS (Bootstrap):**
```html
<div class="row g-3">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card">Item 1</div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card">Item 2</div>
    </div>
</div>
```

---

## 📦 FICHIERS À CRÉER

- `assets/css/bootstrap-custom.css` - Couleurs Material Design
- Pages converties dans `/admin/`, `/consultant/`, etc.
- Composants réutilisables

---

**🚀 Prêt pour la conversion!**

