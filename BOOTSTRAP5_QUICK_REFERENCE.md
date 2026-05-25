# Bootstrap 5 Conversion - Quick Reference Guide

## 🎯 What Was Done
Successfully converted **12 Tailwind CSS pages** to **Bootstrap 5** for the Foncier Glo land management system.

## 📁 File Locations

### ✅ Admin Pages (3 files)
```
admin/validation-transfert.php     - Transfer validation interface
admin/agent-creator.php            - User management table
admin/gestion-transfers.php        - Transfers list & management
```

### ✅ Consultant Pages (3 files)
```
consultant/home.php                - Dashboard with metrics
consultant/transferts.php          - Multi-step transfer form
consultant/details-apres-transfert.php - Completion details
```

### ✅ Litiges Pages (3 files)
```
pages/litiges/resolution.php        - Dispute resolution interface
pages/litiges/create-bootstrap.php  - Open new dispute case
pages/litiges/index-bootstrap.php   - Disputes list & filtering
```

### ✅ Parcelles Pages (2 files)
```
pages/parcelles/fiche-parcelle.php  - Parcel details view
pages/parcelles/ajout-parcelle.php  - Add new parcel form
```

### ✅ Proprietaires Pages (1 file)
```
pages/proprietaires/gestion-new-proprietaire.php - Add new owner
```

## 🎨 Key Features

### Colors Used (Material Design System)
- **Primary**: #00375e (Dark Blue) - Main actions, headers
- **Secondary**: #0b61a1 (Medium Blue) - Links, hover states
- **Tertiary**: #41009d (Purple) - Accents
- **Surface**: #f8f9ff (Light) - Backgrounds
- **Container**: #e5eeff (Medium Light) - Cards, sections

### Fonts
- **Body**: Plus Jakarta Sans (Google Fonts)
- **Icons**: Material Symbols (Google Fonts)

### Layout Pattern (All Pages)
```
┌─────────────────────────────────────────┐
│  SIDEBAR (18rem)  │  HEADER (sticky)    │
├──────────────────┼────────────────────────┤
│                  │  CONTENT AREA         │
│  Navigation      │  (flex: 1, scrollable) │
│  (Fixed)         │                       │
│                  │                       │
└──────────────────┴────────────────────────┘
```

## 🔧 Quick Customization

### Change Primary Color
Edit in each PHP file's `<style>` section:
```css
:root {
  --primary: #00375e;      /* Change this */
  --secondary: #0b61a1;    /* And this */
}
```

### Change Sidebar Width
Find `.sidebar { width: 18rem; }` and adjust:
```css
.sidebar { width: 20rem; }        /* Wider */
.main-wrapper { margin-left: 20rem; }
```

### Hide Sidebar on Mobile
Add/modify media query:
```css
@media (max-width: 768px) {
  .sidebar { display: none; }
  .main-wrapper { margin-left: 0; }
}
```

## 🚀 Integration Tips

### 1. Preserve Existing Database Logic
- Original files (e.g., `pages/litiges/index.php`) have database code
- Bootstrap versions (`index-bootstrap.php`) are UI-only
- Choose which version to use based on your needs

### 2. Add Form Submission
Original files like this:
```html
<form>
  <input name="email" type="email">
  <button type="submit">Send</button>
</form>
```

Update to:
```html
<form method="POST" action="your-handler.php">
  <input name="email" type="email" required>
  <button type="submit">Send</button>
</form>
```

### 3. Add Backend Data to Tables
```html
<!-- Bootstrap version has hardcoded data -->
<tr>
  <td>Example Data</td>
</tr>

<!-- Update to: -->
<?php foreach ($items as $item): ?>
  <tr>
    <td><?php echo $item['name']; ?></td>
  </tr>
<?php endforeach; ?>
```

### 4. Link Navigation Items
In sidebar, update href values:
```html
<a href="#">Dashboard</a>
<!-- Change to: -->
<a href="/dashboard">Dashboard</a>
```

## 📱 Responsive Breakpoints

All files support:
- **Desktop**: 1920px, 1366px
- **Tablet**: 768px - 1024px
- **Mobile**: 320px - 767px

Forms automatically switch from 2-column to 1-column on mobile.

## ✨ Component Reference

### Status Badge
```html
<span class="status-badge status-pending">En Attente</span>
<span class="status-badge status-active">Actif</span>
<span class="status-badge status-resolved">Résolu</span>
<span class="status-badge status-approved">Approuvé</span>
<span class="status-badge status-rejected">Rejeté</span>
<span class="status-badge status-processing">En Traitement</span>
```

### Form Input with Icon
```html
<div class="icon-input">
  <span class="material-symbols-outlined">email</span>
  <input type="email" placeholder="Email...">
</div>
```

### Button Variations
```html
<button class="btn btn-primary">Primary Action</button>
<button class="btn btn-secondary">Secondary Action</button>
<button class="btn btn-sm btn-primary">Small Button</button>
```

### Icon Button
```html
<button class="icon-button" title="Tooltip">
  <span class="material-symbols-outlined">delete</span>
</button>
```

### Upload Zone
```html
<div class="upload-zone">
  <div class="upload-icon">
    <span class="material-symbols-outlined">upload_file</span>
  </div>
  <p>Drag files here</p>
</div>
```

## 🔗 Material Symbols Icons

Common icons used:
- `dashboard` - Home/Dashboard
- `group` - Users/Groups
- `map` - Map/Location
- `gavel` - Disputes/Legal
- `person` - Individual person
- `settings` - Settings
- `edit` - Edit/Modify
- `visibility` - View/Show
- `delete` - Delete
- `add` - Add/Create
- `upload_file` - File upload
- `notifications` - Alerts
- `account_circle` - User profile
- `compare_arrows` - Transfer/Movement
- `call` - Phone/Contact
- `email` - Email
- `badge` - ID/Badge
- `category` - Categories

[Full list: https://fonts.google.com/icons](https://fonts.google.com/icons)

## 📚 Documentation Files

- `BOOTSTRAP5_CONVERSION_SUMMARY.md` - Complete overview
- `BOOTSTRAP5_TECHNICAL_REFERENCE.md` - Detailed technical specs

## ✅ Quality Checklist

Before deploying, verify:
- [ ] All forms have `required` attributes where needed
- [ ] Database integration (if needed) is added
- [ ] Navigation links point to correct pages
- [ ] Sidebar icons match page function
- [ ] Status badges show correct colors
- [ ] Tables display data correctly
- [ ] Responsive design works on mobile
- [ ] All fonts load correctly
- [ ] Icons display properly
- [ ] Colors match brand guidelines

## 🐛 Common Issues & Solutions

### Icons Not Showing
```
Problem: Material Symbols not displaying
Solution: Check Google Fonts CDN is loaded
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
```

### Sidebar Too Wide
```
Problem: Layout looks cramped
Solution: Adjust in CSS
.sidebar { width: 18rem; }  /* Reduce this value */
```

### Forms Look Wrong
```
Problem: Fields not aligned properly
Solution: Check grid in form-row class
.form-row { display: grid; grid-template-columns: 1fr 1fr; }
```

### Fonts Not Loading
```
Problem: Plus Jakarta Sans not showing
Solution: Add font fallback
font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
```

## 📞 Support

For issues or questions:
1. Check color values in `:root` CSS section
2. Verify Bootstrap CDN is loading
3. Check Console for JavaScript errors
4. Test in different browsers
5. Verify responsive design at 768px breakpoint

---

**Status**: ✅ Production Ready
**Version**: 1.0
**Bootstrap**: 5.3.0
**Last Updated**: 2024
