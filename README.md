#Twig Starter Template 🚀

A modern PHP starter template with [Twig](https://twig.symfony.com/) templating engine and [Tailwind CSS v4](https://tailwindcss.com/) integration. Perfect for building fast, maintainable PHP applications with beautiful UI.

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

###3. **Node.js & npm** (for Tailwind CSS)

- **Check if installed:** `node --version && npm --version`
- **Install:** [nodejs.org](https://nodejs.org/) (LTS version recommended)
  - **Ubuntu/Debian:** `sudo apt install nodejsnpm`
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

#Install Node.js dependencies
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
#Start server from the src directory
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
│   │   ├── base.twig         # Base layout (extend this)
│   │   ├── landing.twig      # Landing page example
│   │   ├──dashboard.twig    # Dashboard example
│   │   └── 404.twig          # 404 error page
│   └── styles/
│       ├── tailwind.css      # Tailwind input file
│       └── output.css        # Generated CSS (don't edit)
├── cache/twig/               # Twig template cache
├── vendor/                   # Composer dependencies
├── composer.json             # PHP dependencies
├── package.json              # Node.js dependencies
├── postcss.config.js         # PostCSS configuration
└── README.md                 # You are here!
```

---

##🎨 Twig Basics

### What is Twig?

Twig is a modern, flexible, and secure templating engine for PHP. It separates your HTML from PHP logic, making your code cleaner and more maintainable.

**Learn more:** [Twig Documentation](https://twig.symfony.com/doc/3.x/)

### TemplateInheritance

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
    <li>{{ item.name}}</li>
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

Edit `src/index.php`to add new routes:

```php
switch($path){
    case '/':
    case '/home':
        echo $twig->render('landing.twig', [
            'title' => "Landing Page",
            'user' => ['name' => 'John']
        ]);
        break;

    case '/about':
       echo $twig->render('about.twig', [
            'title' => "About Us"
        ]);
        break;

    default:
        echo $twig->render('404.twig', [
            'title' => "404 Not Found"
        ]);
}
```

---

## 🎨 Using TailwindCSS

### Adding Classes

Just use Tailwind classes in your `.twig` files:

```twig
<div class="bg-blue-500 text-white p-8 rounded-lg shadow-xl">
    <h1 class="text-4xl font-bold mb-4">Hello World</h1>
    <pclass="text-lg">Tailwind CSS is awesome!</p>
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

## 🧰 Frameworks and Libraries Used

- **PHP** - Server-side scripting language
- **Twig** - Templating engine for PHP
- **Tailwind CSS v4** - Utility-first CSS framework
- **PostCSS** - CSS processing tool
- **Composer** - PHP dependency manager
- **npm** - JavaScript package manager

---

## 🔄 Switching Between React, Vue, and Twig Versions

This project contains three different implementations of the same ticket management application:

1. **React version** (`app/` directory)
2. **Vue version** (`Vue-app/` directory)
3. **Twig version** (`twig-starter-template/` directory)

To switch between versions:

### React Version
```bash
cd app
npm install
npm run dev
```

### Vue Version
```bash
cd Vue-app
npm install
npm run dev
```

### Twig Version
```bash
cd twig-starter-template
composer install
npm install
npm run build:css
php -S localhost:8000 -t src
```

---

## 🧩 Components and UI Features

The application contains the following components and features:

### Public Pages
- **Landing Page** - Hero section with call-to-action buttons and feature highlights
- **Login Page** - Email/password authentication with validation
- **Signup Page** - User registration with password strength indicator

### Protected Pages
- **Dashboard** - Overview with statistics cards and quick actions
-**Ticket Management** - Full CRUD operations for tickets with search functionality

### UI Components
- **Dark Mode Toggle** - Theme switching capability
- **Responsive Navigation** - Adapts to mobile and desktop views
- **Statistics Cards** - Visual display of ticket metrics
- **Ticket Cards** - Display individual ticketswith status and priority indicators
- **Form Validation** - Client and server-side validation
- **Toast Notifications** - User feedback messages

### UI Features
- **Responsive Design** - Works on mobile, tablet, and desktop
- **Dark/Light Theme** - User preference saved in localStorage
- **Interactive Elements** - Hover effects and transitions
- **Accessibility** - Semantic HTML and ARIA attributes

---

## 🗃️ Data Structure

The application uses JSON files for data storage:

### Users (`data/users.json`)
```json
[
  {
    "id": 1,
    "name": "Test User",
"email": "test@example.com",
    "password": "test123",
    "createdAt": "2023-01-01T00:00:00.000Z"
  }
]
```

### Tickets (`data/tickets.json`)
```json
[
  {
    "id": 1,
    "userId": 1,
    "title": "Urgent Bug Fix",
    "description": "Critical bug in production",
    "status": "open",
    "priority": "high",
    "createdAt": "2023-01-01T00:00:00.000Z",
    "updatedAt": "2023-01-01T00:00:00.000Z"
  }
]
```

---

## ♿ Accessibility Features

- Semantic HTML structure
-Proper heading hierarchy (h1-h3)
- ARIA labels for icon-only buttons
- Sufficient color contrast
- Focus indicators for keyboard navigation
- Screen reader-friendly content

---

## ⚠️ Known Issues

1. **Form Validation** - Currently only implemented server-side, client-side validation would improve UX2. **Ticket CRUD Operations** - Creation and editing forms are not fully implemented
3. **Session Management** - Uses basic PHP sessions, not suitable for production
4. **Data Persistence** - Uses JSON files, not a database
5. **Security** - Passwords stored in plain text, no encryption---

## 🔐 Test Credentials

Use the following credentials to test the application:

- **Email:** test@example.com
- **Password:** test123

---

## 🛠️ Setup and Usage

1. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Build CSS:**
   ```bash
   npm run build:css
   ```

3. **Start Development Server:**
   ```bash
   php -S localhost:8000 -t src
   ```

4. **Access Application:**
   Open your browser and navigate to`http://localhost:8000`

5. **Development Workflow:**
   For active development with automatic CSS rebuilding:
   ```bash
   # Terminal 1 - Watch CSS changes
   npm run watch:css
   
   # Terminal 2 - Run PHP server
   php -S localhost:8000 -t src
   ```

## 🗂️ .gitignore Configuration

The .gitignore file is configured to exclude:
- OS-specific files (.DS_Store, Thumbs.db)
- IDE configuration files
- Node.js dependencies (node_modules)
- PHP dependencies (vendor)
- Environment files (.env)
- Cache directories
- Log files
- Data files (data/*.json)
- Build artifacts

This ensures that only the source code and configuration files are committed to version control, while generated and environment-specific files are ignored.

---

## 🔧 Configuration

### Twig Configuration

Edit `src/index.php`:

```php$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',  // Template cache
    'auto_reload' => true,                   // Auto-refresh in dev
    'debug' => true,                         // Enable debug mode
]);
```

### Tailwind Configuration

For advanced customization, create `tailwind.config.js`:

```javascript
export default {
  content: ["./src/templates/**/*.twig", "./src/**/*.php"],
  theme: {
    extend: {
      colors: {
        brand: "#3b82f6",
      },
    },
  },
};
```

---

## 📚 Resources

- **Twig Documentation:** [twig.symfony.com/doc](https://twig.symfony.com/doc/3.x/)
- **Tailwind CSS:** [tailwindcss.com/docs](https://tailwindcss.com/docs)
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

#TicketManagement Application - Twig Starter Template

This is the basic PHP/Twig implementation of the ticket management application. It features a modern UI with responsive design, dark mode support, and full CRUD operations for tickets.

## 🧰 Frameworks and Libraries Used

- **PHP** - Server-side scripting language
- **Twig**- Templating engine for PHP
- **Tailwind CSS v4** - Utility-first CSS framework
- **PostCSS** - CSS processing tool
- **Composer** - PHP dependency manager
- **npm** - JavaScript package manager (for Tailwind CSS)

## 🚀 Quick Start

1. Install PHP dependencies:
   ```bash
   composer install
   ```

2. Install Node.js dependencies:
   ```bash
   npm install
   ```

3. Build CSS:
   ```bash
   npm run build:css
   ```

4. Start the development server:
   ```bash
   php -S localhost:8000 -t src
   ```

## 🧩 Components and UI Features

### Public Pages
- **Landing Page** - Hero section with call-to-action buttons and feature highlights
- **Login Page**- Email/password authentication with validation
- **Signup Page** - User registration with password strength indicator

### Protected Pages
- **Dashboard** - Overview with statistics cards and quick actions
- **Ticket Management** - Full CRUD operations for tickets with search functionality

### UI Components
- **Dark Mode Toggle** - Theme switchingcapability
- **Responsive Navigation** - Adapts to mobile and desktop views
- **Statistics Cards** - Visual display of ticket metrics
- **Ticket Cards** - Display individual tickets with status and priority indicators
- **Form Validation** - Server-side validation
- **Toast Notifications** - User feedback messages

### UI Features
- **Responsive Design** - Works on mobile, tablet, and desktop
- **Dark/Light Theme** - User preference saved in localStorage
- **Interactive Elements** - Hover effects and transitions
- **Accessibility** - Semantic HTML andARIA attributes

##🗃️ State Structure

The application uses file-based storage for data persistence:

### Users (`data/users.json`)
```json
[
  {
    "id": 1,
    "name": "Test User",
    "email": "test@example.com",
    "password": "test123",
   "createdAt": "2023-01-01T00:00:00.000Z"
  }
]
```

### Tickets (`data/tickets.json`)
```json
[
  {
    "id": 1,
    "userId": 1,
    "title": "Urgent Bug Fix",
    "description": "Critical bug in production",
    "status": "open",
    "priority": "high",
    "createdAt": "2023-01-01T00:00:00.000Z",
    "updatedAt": "2023-01-01T00:00:00.000Z"
  }
]
```

##♿ Accessibility Features

- Semantic HTML structure
- Proper heading hierarchy (h1-h3)
- ARIA labels for icon-only buttons
- Sufficient color contrast
- Focus indicators for keyboard navigation
- Screen reader-friendly content

## ⚠️ Known Issues

1. **Form Validation** - Currently onlyimplemented server-side
2. **Ticket CRUD Operations** - Creation and editing forms are not fully implemented
3. **Session Management** - Uses basic PHP sessions, not suitable for production
4. **Data Persistence** - Uses JSON files, not a database
5. **Security** - Passwords stored in plain text, no encryption

##🔐 Test Credentials

Use the following credentials to test the application:

- **Email:** test@example.com
- **Password:** test123

## 🔧 Setup and Usage

1. **Install PHP Dependencies:**
   ```bash
   composer install
   ```

2. **Install Node.js Dependencies:**
   ```bash
   npm install
   ```

3. **Build CSS:**
   ```bash
   npm run build:css
   ```

4. **Start Development Server:**
   ```bash
   php -S localhost:8000 -t src
   ```

## 🔄Switching Between Versions

This project contains three different implementations of the same ticket management application:

1. **React version** (`app/` directory)
2. **Vue version** (`Vue-app/` directory)
3. **Twig version** (`twig-starter-template/` directory)

To switch between versions, navigate tothe respective directory and follow the setup instructions in each README.

## 📁 Project Structure

```
twig-starter-template/
├── src/
│   ├── index.php            # Main router & entry point
│   ├── templates/           # Twig template files
│   │   ├── base.twig        # Base layout(extend this)
│   │   ├── landing.twig     # Landing page example
│   │   ├── dashboard.twig   # Dashboard example
│   │   └── 404.twig         # 404 error page
│   └── styles/
│       ├── tailwind.css     #Tailwind input file
│       └── output.css       # Generated CSS (don't edit)
├── data/                    # Data storage (JSON files)
├── cache/twig/              # Twig template cache
├── vendor/                  # Composer dependencies
├── package.json             # Node.js dependencies
└── README.md                # This file