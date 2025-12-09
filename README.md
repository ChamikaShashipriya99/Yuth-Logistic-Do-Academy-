# Youth Logistic WordPress Theme

A custom WordPress theme for Yuth Logistic, converted from static HTML assets. This theme provides a modern, flexible solution for managing logistics company content with custom post types, drag-and-drop ordering, and ACF integration.

## 📋 Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Custom Post Types](#custom-post-types)
- [Theme Features](#theme-features)
- [File Structure](#file-structure)
- [Customization](#customization)
- [Support](#support)

## ✨ Features

- **Custom Post Types**: Services and Why Choose Us statistics cards
- **Drag-and-Drop Ordering**: Intuitive admin interface for reordering content
- **ACF Integration**: Flexible content management with Advanced Custom Fields
- **Responsive Design**: Mobile-friendly navigation and layouts
- **Multiple Navigation Menus**: Primary, mobile, and footer menu support
- **Icon Sprite System**: Efficient icon management with sprite sheets
- **Font Awesome Integration**: Access to Font Awesome 5.15.0 icon library
- **Dynamic Menu Injection**: Services automatically appear as submenu items
- **Custom Logo Support**: Flexible logo dimensions and positioning
- **Post Thumbnails**: Featured image support for posts and pages

## 📦 Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **Recommended Plugins**:
  - Advanced Custom Fields (ACF PRO) - Required for header content and service/stat icon management
  - Contact Form 7 (optional, for contact forms)

## 🚀 Installation

1. **Download or clone the theme**:
   ```bash
   # If using Git
   git clone [repository-url] "Youth Logistic"
   ```

2. **Upload to WordPress**:
   - Navigate to `wp-content/themes/` in your WordPress installation
   - Upload the entire `Youth Logistic` theme folder
   - Ensure the folder name matches exactly: `Youth Logistic`

3. **Activate the theme**:
   - Go to **Appearance → Themes** in WordPress admin
   - Find "Youth Logistic" and click **Activate**

4. **Install required plugins**:
   - Install and activate **Advanced Custom Fields (ACF PRO)**
   - Configure ACF fields as needed (see Configuration section)

## ⚙️ Configuration

### Initial Setup

1. **Configure Menus**:
   - Go to **Appearance → Menus**
   - Create and assign menus to:
     - Primary Menu
     - Mobile Menu
     - Footer Menu
   - **Note**: Services will automatically appear as submenu items under any menu item titled "Services"

2. **Set Header Content** (via ACF):
   - Create a page with template "Header (Navigation)" OR
   - Configure header fields on your Front Page
   - Available fields:
     - Hotline label, text, and link
     - Email label and address
     - Social media links

3. **Upload Logo**:
   - Go to **Appearance → Customize → Site Identity**
   - Upload your custom logo (recommended: 200x80px, flexible dimensions supported)

### ACF PRO Field Setup

The theme expects the following ACF fields:

**For Services (`service` post type)**:
- `service_icon_class` - Icon class name for the sprite icon

**For Why Choose Us Stats (`why_choose_us_stat` post type)**:
- `stat_icon_class` - Icon class name for the sprite icon

**For Header Content**:
- `header_hotline_label` - Hotline label text
- `header_hotline_text` - Hotline display text
- `header_hotline_link` - Hotline link (tel: format)
- `header_email_label` - Email label text
- `header_email_address` - Email address
- Social media link fields (configure as needed)

## 📝 Custom Post Types

### Services

The Services custom post type allows you to manage service offerings displayed in a carousel format.

**Features**:
- Title, content, excerpt, and featured image support
- Custom icon via ACF field `service_icon_class`
- Drag-and-drop ordering via **Services → Order Services**
- Automatically appears in navigation menus under "Services" menu item
- Single service pages available at `/services/[service-slug]`

**Usage**:
1. Go to **Services → Add New Service**
2. Enter title, content, and excerpt
3. Set featured image (optional)
4. Configure icon class via ACF field
5. Use **Services → Order Services** to reorder display

### Why Choose Us Stats

The Why Choose Us Stats custom post type manages the four statistics cards displayed on the homepage.

**Features**:
- Title and content/excerpt support
- Custom icon via ACF field `stat_icon_class`
- Drag-and-drop ordering via **Why Choose Us → Order Stats**
- Displays up to 4 cards (ordered by menu_order)
- AOS (Animate On Scroll) animation support

**Usage**:
1. Go to **Why Choose Us → Add New Card**
2. Enter title and description
3. Configure icon class via ACF field
4. Use **Why Choose Us → Order Stats** to reorder display

## 🎨 Theme Features

### Navigation System

- **Bootstrap-style dropdowns**: Parent menu items with children automatically get dropdown functionality
- **Font Awesome icons**: Dropdown arrows automatically added to parent items
- **Menu fallback**: If no menu is assigned, pages are automatically listed
- **Dynamic service injection**: Services appear as submenu items under "Services" menu item

### Icon System

- Uses sprite sheet located at `/images/icon-sprite.png`
- Icons controlled via CSS classes
- Filter effects available (black-to-red, black-to-white)
- ACF fields allow per-item icon customization

### Template Files

- `front-page.php` - Homepage template
- `header.php` - Header with navigation
- `footer.php` - Footer template
- `single-service.php` - Individual service page
- `page-services.php` - Services archive/listing page
- `page-blog.php` - Blog listing page
- `about-us.php` - About page template
- `contact.php` - Contact page template
- `faq.php` - FAQ page template
- `404.php` - 404 error page

## 📁 File Structure

```
Youth Logistic/
├── admin/                    # Admin interface scripts
│   ├── service-order.js     # Drag-and-drop service ordering
│   └── stat-order.js        # Drag-and-drop stats ordering
├── fonts/                    # Custom fonts
├── images/                   # Theme images and icons
│   ├── icon-sprite.png     # Icon sprite sheet
│   └── [other images]
├── js/                       # JavaScript libraries
│   └── jquery.min.js
├── 404.php                   # 404 error template
├── about-us.php             # About page template
├── contact.php              # Contact page template
├── faq.php                  # FAQ page template
├── footer.php               # Footer template
├── front-page.php           # Homepage template
├── functions.php            # Theme functions and setup
├── header.php               # Header template
├── index.php                # Main template fallback
├── javascript.js            # Main JavaScript bundle
├── page-blog.php           # Blog page template
├── page-services.php       # Services page template
├── screenshot.png          # Theme screenshot
├── single-service.php      # Single service template
├── style.css               # Theme stylesheet (WordPress header)
└── styles.css              # Main stylesheet
```

## 🛠️ Customization

### Changing Colors and Styles

Edit `styles.css` to modify the theme's appearance. The theme uses CSS classes prefixed with `ph-` and `bagels-` for styling.

### Adding Custom JavaScript

Add custom JavaScript to `javascript.js` or enqueue additional scripts in `functions.php` using `wp_enqueue_script()`.

### Modifying Templates

Template files can be edited directly. Always create a child theme for production customization to preserve updates.

### Icon Customization

1. Update `/images/icon-sprite.png` with your icons
2. Update CSS classes in `styles.css` to match your sprite positions
3. Configure icon classes via ACF fields for individual items

## 🔧 Functions Reference

### Main Functions

- `youth_logistic_setup()` - Theme setup (menus, logo, thumbnails)
- `youth_logistic_assets()` - Enqueue styles and scripts
- `services()` - Output service cards HTML
- `why_choose_us()` - Output Why Choose Us stats HTML
- `youth_logistic_add_services_to_menu()` - Inject services into navigation

### Custom Post Types

- `service` - Services post type
- `why_choose_us_stat` - Why Choose Us statistics post type

### Menu Locations

- `primary` - Primary navigation menu
- `mobile` - Mobile navigation menu
- `footer` - Footer navigation menu

## 📞 Support

For theme support, customization requests, or bug reports, please contact the theme developer or refer to the WordPress support forums.

---
Made By Chamika Shashipriya Under DoAcadamy Module 1 of Full-Stack Web Developer Industrial Training Program
