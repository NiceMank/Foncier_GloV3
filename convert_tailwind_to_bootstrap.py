#!/usr/bin/env python3
"""
Tailwind CSS to Bootstrap 5 Conversion Script
Converts 14 Tailwind CSS markdown files to Bootstrap 5 PHP files
"""

import os
import re
from pathlib import Path

# Tailwind to Bootstrap CSS class mapping
TAILWIND_TO_BOOTSTRAP = {
    # Layout
    r'\bflex\b': 'd-flex',
    r'\bflex-col\b': 'flex-column',
    r'\bflex-row\b': 'flex-row',
    r'\bitems-center\b': 'align-items-center',
    r'\bitem-start\b': 'align-items-start',
    r'\bjustify-between\b': 'justify-content-between',
    r'\bjustify-center\b': 'justify-content-center',
    r'\bjustify-start\b': 'justify-content-start',
    r'\bjustify-end\b': 'justify-content-end',
    r'\bgap-\d+\b': lambda m: f"gap-{m.group()[4:]}",
    r'\bgap-gutter\b': 'gap-4',
    r'\bgap-sm\b': 'gap-1',
    r'\bgap-md\b': 'gap-2',
    r'\bgap-lg\b': 'gap-3',
    r'\bgap-xl\b': 'gap-4',
    r'\bgap-[0-9.]+': lambda m: f"gap-{int(float(m.group()[4:-1]) * 4)}",
    
    # Grid
    r'\bgrid\b': 'row',
    r'\bgrid-cols-1\b': 'row',
    r'\bgrid-cols-2\b': 'row',
    r'\bgrid-cols-3\b': 'row',
    r'\bgrid-cols-4\b': 'row',
    r'\bgrid-cols-12\b': 'row',
    
    # Width
    r'\bw-full\b': 'w-100',
    r'\bw-1/4\b': '',  # Will be handled by col-3
    r'\bw-1/3\b': '',  # Will be handled by col-4
    r'\bw-1/2\b': '',  # Will be handled by col-6
    r'\bw-2/3\b': '',  # Will be handled by col-8
    r'\bw-3/4\b': '',  # Will be handled by col-9
    r'\bw-screen\b': 'w-100',
    r'\bw-\d+\b': lambda m: f"width: {m.group()[2:]}rem",
    r'\bmin-w-\d+\b': lambda m: f"min-width: {m.group()[6:]}rem",
    r'\bmax-w-\d+\b': lambda m: f"max-width: {m.group()[6:]}rem",
    r'\bmax-w-full\b': 'mw-100',
    r'\bmax-w-none\b': 'mw-none',
    
    # Height
    r'\bh-full\b': 'h-100',
    r'\bh-screen\b': 'vh-100',
    r'\bmin-h-screen\b': 'min-vh-100',
    
    # Padding
    r'\bp-\d+\b': lambda m: f"p-{m.group()[2:]}",
    r'\bpx-\d+\b': lambda m: f"px-{m.group()[3:]}",
    r'\bpy-\d+\b': lambda m: f"py-{m.group()[3:]}",
    r'\bpt-\d+\b': lambda m: f"pt-{m.group()[3:]}",
    r'\bpb-\d+\b': lambda m: f"pb-{m.group()[3:]}",
    r'\bpl-\d+\b': lambda m: f"ps-{m.group()[3:]}",
    r'\bpr-\d+\b': lambda m: f"pe-{m.group()[3:]}",
    
    # Margin
    r'\bm-\d+\b': lambda m: f"m-{m.group()[2:]}",
    r'\bmx-\d+\b': lambda m: f"mx-{m.group()[3:]}",
    r'\bmy-\d+\b': lambda m: f"my-{m.group()[3:]}",
    r'\bmt-\d+\b': lambda m: f"mt-{m.group()[3:]}",
    r'\bmb-\d+\b': lambda m: f"mb-{m.group()[3:]}",
    r'\bml-\d+\b': lambda m: f"ms-{m.group()[3:]}",
    r'\bmr-\d+\b': lambda m: f"me-{m.group()[3:]}",
    r'\bmx-auto\b': 'mx-auto',
    
    # Border
    r'\bborder\b': 'border',
    r'\bborder-\d+\b': 'border',
    r'\bborder-t\b': 'border-top',
    r'\bborder-b\b': 'border-bottom',
    r'\bborder-l\b': 'border-start',
    r'\bborder-r\b': 'border-end',
    r'\bborder-outline-variant\b': 'border-secondary',
    r'\bborder-outline\b': 'border-secondary',
    r'\bborder-primary\b': 'border-primary',
    r'\bborder-secondary\b': 'border-info',
    r'\bborder-error\b': 'border-danger',
    r'\bborder-\d+-\w+\b': lambda m: '',  # Custom border colors
    
    # Rounded corners
    r'\brounded-full\b': 'rounded-pill',
    r'\brounded-lg\b': 'rounded',
    r'\brounded-xl\b': 'rounded',
    r'\brounded\b': 'rounded',
    r'\brounded-none\b': 'rounded-0',
    
    # Shadows
    r'\bshadow-sm\b': 'shadow-sm',
    r'\bshadow-md\b': 'shadow',
    r'\bshadow-lg\b': 'shadow-lg',
    r'\bshadow-\[\d+px[^]]+\]\b': 'shadow',
    
    # Text
    r'\btext-on-surface\b': 'text-dark',
    r'\btext-on-surface-variant\b': 'text-muted',
    r'\btext-primary\b': 'text-primary',
    r'\btext-secondary\b': 'text-info',
    r'\btext-error\b': 'text-danger',
    r'\btext-white\b': 'text-white',
    r'\btext-on-primary\b': 'text-white',
    r'\btext-on-secondary\b': 'text-white',
    r'\btext-\d+\b': lambda m: f"fs-{m.group()[5:]}",
    
    # Font weight
    r'\bfont-bold\b': 'fw-bold',
    r'\bfont-semibold\b': 'fw-bold',
    r'\bfont-extrabold\b': 'fw-bold',
    r'\bfont-\w+\b': 'fw-normal',
    
    # Background
    r'\bbg-surface\b': 'bg-light',
    r'\bbg-surface-container-lowest\b': 'bg-white',
    r'\bbg-surface-container-low\b': 'bg-light',
    r'\bbg-surface-container\b': 'bg-light',
    r'\bbg-surface-container-high\b': 'bg-light',
    r'\bbg-surface-container-highest\b': 'bg-light',
    r'\bbg-primary\b': 'bg-primary',
    r'\bbg-primary-container\b': 'bg-light',
    r'\bbg-secondary\b': 'bg-info',
    r'\bbg-secondary-container\b': 'bg-light',
    r'\bbg-error\b': 'bg-danger',
    r'\bbg-error-container\b': 'bg-danger-light',
    r'\bbg-white\b': 'bg-white',
    r'\bbg-outline-variant\b': 'bg-secondary',
    r'\bbg-\w+-?\d*(?:\s*\/\s*\d+)?\b': 'bg-light',
    
    # Opacity
    r'\bopacity-\d+\b': lambda m: f"opacity-{m.group()[8:]}",
    
    # Display & Visibility
    r'\bhidden\b': 'd-none',
    r'\bblock\b': 'd-block',
    r'\binline\b': 'd-inline',
    r'\binline-block\b': 'd-inline-block',
    r'\binline-flex\b': 'd-inline-flex',
    r'\bflex-grow\b': 'flex-grow-1',
    r'\bflex-shrink\b': 'flex-shrink-1',
    
    # Position
    r'\bfixed\b': 'fixed-top',
    r'\bsticky\b': 'sticky-top',
    r'\brelative\b': 'position-relative',
    r'\babsolute\b': 'position-absolute',
    
    # Overflow
    r'\boverflow-hidden\b': 'overflow-hidden',
    r'\boverflow-auto\b': 'overflow-auto',
    r'\boverflow-y-auto\b': 'overflow-y-auto',
    r'\boverflow-x-auto\b': 'overflow-x-auto',
    
    # Transition
    r'\btransition-\w+\b': 'transition',
    r'\btransition\b': 'transition',
    
    # Z-index
    r'\bz-\d+\b': lambda m: f"z-index: {m.group()[2:]}",
    
    # Responsive
    r'\bmd:\b': 'd-md-',
    r'\blg:\b': 'd-lg-',
    r'\bsm:\b': 'd-sm-',
    r'\bxl:\b': 'd-xl-',
}

# Custom color mappings
COLOR_MAP = {
    'primary': '#00375e',
    'secondary': '#0b61a1',
    'tertiary': '#41009d',
    'surface': '#f8f9ff',
    'surface-container': '#e5eeff',
    'error': '#ba1a1a',
    'outline': '#72777f',
    'outline-variant': '#c2c7d0',
}

def extract_html_from_markdown(markdown_content):
    """Extract HTML content from markdown file"""
    # Find the HTML content (between <!DOCTYPE and </html>)
    match = re.search(r'<!DOCTYPE.*?</html>', markdown_content, re.DOTALL)
    if match:
        return match.group(0)
    return markdown_content

def clean_tailwind_classes(class_string):
    """Clean and convert Tailwind classes to Bootstrap"""
    if not class_string:
        return ''
    
    classes = class_string.split()
    bootstrap_classes = []
    
    for cls in classes:
        # Skip Tailwind-only classes
        if any(x in cls for x in ['dark:', 'light:', 'hover:', 'focus:', 'active:', 'group', 'peer', 'before:', 'after:', 'md:', 'lg:', 'sm:', 'xl:']):
            continue
        
        converted = False
        
        # Try direct matching
        for pattern, replacement in TAILWIND_TO_BOOTSTRAP.items():
            if isinstance(replacement, str):
                if re.match(f'^{pattern}$', cls):
                    if replacement:
                        bootstrap_classes.append(replacement)
                    converted = True
                    break
            elif callable(replacement):
                match = re.match(f'^{pattern}$', cls)
                if match:
                    result = replacement(match)
                    if result:
                        bootstrap_classes.append(result)
                    converted = True
                    break
        
        # If not converted, add as-is if it's not a Tailwind-specific pattern
        if not converted and cls and not any(x in cls for x in ['hover:', 'focus:', 'active:', 'dark:', 'light:', 'before:', 'after:']):
            if not re.match(r'^(md|lg|sm|xl|2xl):', cls):
                bootstrap_classes.append(cls)
    
    return ' '.join(bootstrap_classes)

def convert_html_to_bootstrap(html_content, page_role='admin'):
    """Convert HTML from Tailwind to Bootstrap 5"""
    # Remove Tailwind CSS script and config
    html_content = re.sub(r'<script src="https://cdn\.tailwindcss\.com[^"]*"><\/script>', '', html_content)
    html_content = re.sub(r'<script id="tailwind-config">.*?<\/script>', '', html_content, flags=re.DOTALL)
    
    # Convert class attributes
    def convert_class_attr(match):
        class_str = match.group(1)
        converted = clean_tailwind_classes(class_str)
        return f'class="{converted}"' if converted else ''
    
    html_content = re.sub(r'class="([^"]*)"', convert_class_attr, html_content)
    
    # Remove empty class attributes
    html_content = re.sub(r'\s+class=""', '', html_content)
    
    # Replace style attributes with inline styles where needed
    html_content = re.sub(r'style="[^"]*font-variation-settings[^"]*"', '', html_content)
    
    return html_content

def create_php_wrapper(html_content, page_title, page_role):
    """Create PHP wrapper with includes and proper structure"""
    
    php_header = f'''<?php
/**
 * Page: {page_title}
 * Role: {page_role}
 * Converted from Tailwind CSS to Bootstrap 5
 */

// Include necessary files
// require_once __DIR__ . '/../../includes/header.php';
// session_start();

?>
'''
    
    php_footer = '''
<?php
// Include footer if needed
// require_once __DIR__ . '/../../includes/footer.php';
?>
'''
    
    # Extract and wrap the body content
    body_match = re.search(r'<body[^>]*>(.*?)</body>', html_content, re.DOTALL)
    if body_match:
        body_content = body_match.group(1)
    else:
        body_content = html_content
    
    # Extract head content for CSS
    head_content = ''
    head_match = re.search(r'<head[^>]*>(.*?)</head>', html_content, re.DOTALL)
    if head_match:
        head_content = head_match.group(1)
    
    # Build the full PHP content
    php_content = php_header
    
    # Add HTML doctype and head
    php_content += '?>\n'
    php_content += '''<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
'''
    
    # Extract title if exists
    title_match = re.search(r'<title>([^<]+)</title>', html_content)
    if title_match:
        php_content += f"    <title>{title_match.group(1)}</title>\n"
    else:
        php_content += f"    <title>{page_title}</title>\n"
    
    # Add Bootstrap and supporting CSS
    php_content += '''
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Material Symbols Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Plus Jakarta Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Material Design Colors -->
    <link href="/foncier_gloV3/assets/css/bootstrap-custom.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #00375e;
            --secondary: #0b61a1;
            --tertiary: #41009d;
            --surface: #f8f9ff;
            --surface-container: #e5eeff;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--surface);
            color: #0b1c30;
        }
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 18rem;
            background-color: var(--primary);
            color: white;
            padding: 1.5rem;
            z-index: 1050;
            overflow-y: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .main-wrapper {
            margin-left: 18rem;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .top-app-bar {
            position: sticky;
            top: 0;
            z-index: 40;
            background-color: white;
            border-bottom: 1px solid #c2c7d0;
            padding: 1rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 4rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .content-area {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
        }
        
        .bento-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 12px rgba(31, 78, 121, 0.05);
            border-radius: 12px;
        }
    </style>
</head>
<body>

'''
    
    # Add the converted body content
    php_content += body_content
    
    # Add Bootstrap JS and closing tags
    php_content += '''

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
'''
    php_content += php_footer
    
    return php_content

def process_file(input_path, output_path, page_role):
    """Process a single markdown file"""
    print(f"Processing: {input_path}")
    
    try:
        # Read the markdown file
        with open(input_path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Extract HTML
        html_content = extract_html_from_markdown(content)
        
        # Extract page title
        title_match = re.search(r'<title>([^<]+)</title>', html_content)
        page_title = title_match.group(1) if title_match else 'Page'
        
        # Convert Tailwind to Bootstrap
        converted_html = convert_html_to_bootstrap(html_content, page_role)
        
        # Create PHP wrapper
        php_content = create_php_wrapper(converted_html, page_title, page_role)
        
        # Ensure output directory exists
        os.makedirs(os.path.dirname(output_path), exist_ok=True)
        
        # Write the PHP file
        with open(output_path, 'w', encoding='utf-8') as f:
            f.write(php_content)
        
        print(f"✓ Created: {output_path}")
        return True
    
    except Exception as e:
        print(f"✗ Error processing {input_path}: {str(e)}")
        return False

# File mappings
FILES_TO_CONVERT = [
    # Admin (3 files)
    ('PagesTemplates/Admin/Validation_transfert.md', 'admin/validation-transfert.php', 'admin'),
    ('PagesTemplates/Admin/agent-creator.md', 'admin/agent-creator.php', 'admin'),
    ('PagesTemplates/Admin/gestion_transfers.md', 'admin/gestion-transfers.php', 'admin'),
    
    # Consultant (3 files)
    ('PagesTemplates/Consultant/Home.md', 'consultant/home.php', 'consultant'),
    ('PagesTemplates/Consultant/Transferts.md', 'consultant/transferts.php', 'consultant'),
    ('PagesTemplates/Consultant/Details apres Tranfert.md', 'consultant/details-apres-transfert.php', 'consultant'),
    
    # Litiges (3 files)
    ('PagesTemplates/Litiges/Resolution.md', 'pages/litiges/resolution.php', 'litiges'),
    ('PagesTemplates/Litiges/create.md', 'pages/litiges/create.php', 'litiges'),
    ('PagesTemplates/Litiges/index.md', 'pages/litiges/index.php', 'litiges'),
    
    # Parcelle (3 files)
    ('PagesTemplates/Parcelle/Fiche_parcelle.md', 'pages/parcelle/fiche-parcelle.php', 'parcelle'),
    ('PagesTemplates/Parcelle/ajout-parcelle.md', 'pages/parcelle/ajout-parcelle.php', 'parcelle'),
    ('PagesTemplates/Parcelle/parcelle-index.md', 'pages/parcelle/parcelle-index.php', 'parcelle'),
    
    # Proprietaire (2 files)
    ('PagesTemplates/Proprietaire/gestion-new-poprietaire.md', 'pages/proprietaire/gestion-new-proprietaire.php', 'proprietaire'),
    ('PagesTemplates/Proprietaire/proprietaire-index.md', 'pages/proprietaire/proprietaire-index.php', 'proprietaire'),
]

def main():
    """Main conversion process"""
    base_path = r'c:\xampp\htdocs\Foncier_GloV3'
    
    print("=" * 60)
    print("Tailwind CSS to Bootstrap 5 Conversion")
    print("=" * 60)
    
    success_count = 0
    failed_count = 0
    
    for input_file, output_file, role in FILES_TO_CONVERT:
        input_path = os.path.join(base_path, input_file)
        output_path = os.path.join(base_path, output_file)
        
        if os.path.exists(input_path):
            if process_file(input_path, output_path, role):
                success_count += 1
            else:
                failed_count += 1
        else:
            print(f"✗ Input file not found: {input_path}")
            failed_count += 1
    
    print("\n" + "=" * 60)
    print(f"Conversion Summary: {success_count} succeeded, {failed_count} failed")
    print("=" * 60)

if __name__ == '__main__':
    main()
