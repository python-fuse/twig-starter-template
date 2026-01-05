# Twig Starter Template 🚀

A modern PHP starter template with [Twig](https://twig.symfony.com/) templating engine, [Tailwind CSS v4](https://tailwindcss.com/), and [Preline UI](https://preline.co/) components. Perfect for building fast, maintainable PHP applications with beautiful UI.

**With love from [uCodes](https://github.com/python-fuse)** 💙

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

### 1. **PHP** (>= 7.4)

- **Check if installed:** `php --version`
- **Install:**
  - **Ubuntu/Debian:** `sudo apt update && sudo apt install php php-cli php-mbstring`
  - **macOS:** `brew install php`
  - **Windows:** [Download PHP](https://windows.php.net/download/)

### 2. **Composer** (PHP Dependency Manager)

- **Check if installed:** `composer --version`
- **Install:** [getcomposer.org](https://getcomposer.org/download/)
  ```bash
  # Quick install (Linux/macOS):
  curl -sS https://getcomposer.org/installer | php
  sudo mv composer.phar /usr/local/bin/composer
  ```

### 3. **Node.js & npm** (for Tailwind CSS)

- **Check if installed:** `node --version && npm --version`
- **Install:** [nodejs.org](https://nodejs.org/) (LTS version recommended)
  - **Ubuntu/Debian:** `sudo apt install nodejs npm`
  - **macOS:** `brew install node`

---

## 🚀 Quick Start

### 1. Clone & Install Dependencies

```bash
# Clone the repository (or download ZIP)
git clone <your-repo-url>
cd twig-starter-template

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Build Tailwind CSS

```bash
# One-time build
npm run build:css

# Or watch for changes (recommended during development)
npm run watch:css
```

### 3. Start the PHP Development Server

```bash
# Start server from the src directory
php -S localhost:8000 -t src
```

### 4. Open in Browser

Visit [http://localhost:8000](http://localhost:8000) 🎉

---

## 📁 Project Structure

```
twig-starter-template/
├── src/
│   ├── index.php              # Main router & entry point
│   ├── templates/             # Twig template files
│   │   ├── base.twig          # Base layout (extend this)
│   │   ├── landing.twig       # Landing page example
│   │   ├── dashboard.twig     # Dashboard example
│   │   └── 404.twig           # 404 error page
│   ├── styles/
│   │   ├── tailwind.css       # Tailwind input file (configure here)
│   │   └── out.tailwind.css   # Generated CSS (don't edit)
│   └── js/
│       └── preline.js         # Preline UI JavaScript
├── cache/twig/                # Twig template cache
├── vendor/                    # Composer dependencies
├── composer.json              # PHP dependencies
├── package.json               # Node.js dependencies
├── postcss.config.js          # PostCSS configuration
└── README.md                  # You are here!
```

---

## 🎨 Twig Basics

### What is Twig?

Twig is a modern, flexible, and secure templating engine for PHP. It separates your HTML from PHP logic, making your code cleaner and more maintainable.

**Learn more:** [Twig Documentation](https://twig.symfony.com/doc/3.x/)

### Template Inheritance

**Base Template** (`base.twig`):

```twig
<!DOCTYPE html>
<html>
<head>
    <title>{% block title %}Default Title{% endblock %}</title>
</head>
<body>
    {% block content %}
        <!-- Content goes here -->
    {% endblock %}
</body>
</html>
```

**Child Template** (`landing.twig`):

```twig
{% extends "base.twig" %}

{% block title %}Landing Page{% endblock %}

{% block content %}
    <h1>Welcome!</h1>
{% endblock %}
```

### Common Twig Syntax

```twig
{# This is a comment #}

{# Variables #}
{{ variable }}
{{ user.name }}

{# Control Structures #}
{% if user.isLoggedIn %}
    Welcome back!
{% else %}
    Please log in.
{% endif %}

{# Loops #}
{% for item in items %}
    <li>{{ item.name }}</li>
{% endfor %}

{# Filters #}
{{ name|upper }}
{{ price|number_format(2) }}
{{ content|striptags }}

{# Include another template #}
{% include 'header.twig' %}
```

---

## 🛣️ Adding Routes

Edit `src/index.php` to add new routes:

```php
switch ($path) {
    case '/':
    case '/home':
        echo $twig->render('landing.twig', [
            'title' => 'Landing Page',
            'user' => ['name' => 'John']
        ]);
        break;

    case '/about':
        echo $twig->render('about.twig', [
            'title' => 'About Us'
        ]);
        break;

    default:
        http_response_code(404);
        echo $twig->render('404.twig', [
            'title' => '404 Not Found'
        ]);
        break;
}
```

---

## 🎨 Using Tailwind CSS

This template uses **Tailwind CSS v4** with the new CSS-first configuration approach.

### Adding Classes

Just use Tailwind classes in your `.twig` files:

```twig
<div class="bg-blue-500 text-white p-8 rounded-lg shadow-xl">
    <h1 class="text-4xl font-bold mb-4">Hello World</h1>
    <p class="text-lg">Tailwind CSS is awesome!</p>
</div>
```

### Auto-rebuild on Changes

Run this during development:

```bash
npm run watch:css
```

Now whenever you add/remove Tailwind classes in your `.twig` files, the CSS rebuilds automatically!

**Learn more:** [Tailwind CSS Documentation](https://tailwindcss.com/docs)

---

## 🧩 Using Preline UI

This template includes [Preline UI](https://preline.co/), a collection of prebuilt UI components designed for Tailwind CSS.

### Available Components

Preline UI provides 50+ components including:
- **Navigation:** Dropdowns, Navbars, Menus
- **Overlays:** Modals, Tooltips, Popovers
- **Data Display:** Accordions, Tabs, Carousels
- **Forms:** Selects, Inputs, File Uploads
- **And more!**

### Usage Example

```twig
{# Dropdown Example #}
<div class="hs-dropdown relative inline-flex">
    <button type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
        Actions
        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
    </button>
    <div class="hs-dropdown-menu hidden min-w-60 bg-white shadow-md rounded-lg mt-2 z-10">
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100" href="#">Option 1</a>
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100" href="#">Option 2</a>
    </div>
</div>
```

### How It's Set Up

1. **CSS Variants** - Imported in `src/styles/tailwind.css`:
   ```css
   @import "../../node_modules/preline/variants.css";
   @source "../../node_modules/preline/dist/*.js";
   ```

2. **JavaScript** - Loaded in `src/templates/base.twig`:
   ```html
   <script src="/js/preline.js"></script>
   ```

### Updating Preline JS

If you reinstall `node_modules`, copy the Preline JS file again:

```bash
cp node_modules/preline/dist/preline.js src/js/preline.js
```

**Learn more:** [Preline UI Documentation](https://preline.co/docs)

---

## 🔧 Configuration

### Twig Configuration

Edit `src/index.php`:

```php
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',  // Template cache
    'auto_reload' => true,                   // Auto-refresh in dev
    'debug' => true,                         // Enable debug mode
]);
```

### Tailwind CSS v4 Configuration

Tailwind v4 uses a **CSS-first configuration** approach. All configuration is done in `src/styles/tailwind.css`:

```css
@import "tailwindcss";

/* Preline UI */
@source "../../node_modules/preline/dist/*.js";
@import "../../node_modules/preline/variants.css";

/* Content sources for class detection */
@source "../templates/**/*.twig";
@source "../**/*.php";

/* Plugins */
@plugin "@tailwindcss/forms";

/* Preline UI opinionated styles */
@layer base {
    button:not(:disabled),
    [role="button"]:not(:disabled) {
        cursor: pointer;
    }
}

/* Defaults hover styles on all devices */
@custom-variant hover (&:hover);
```

For more advanced customization, see the [Tailwind CSS v4 Documentation](https://tailwindcss.com/docs/v4-beta).

---

## 📚 Resources

- **Twig Documentation:** [twig.symfony.com/doc](https://twig.symfony.com/doc/3.x/)
- **Tailwind CSS:** [tailwindcss.com/docs](https://tailwindcss.com/docs)
- **Preline UI:** [preline.co/docs](https://preline.co/docs)
- **PHP Manual:** [php.net/manual](https://www.php.net/manual/en/)
- **Composer:** [getcomposer.org](https://getcomposer.org/)

---

## 🤝 Contributing

Feel free to fork this template and make it your own! Pull requests are welcome.

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

**Built with ❤️ by [uCodes](https://github.com/ucodes)**

_Happy coding! 🚀_
