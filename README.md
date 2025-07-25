# 🚀 Web Learning Hub

A modern programming tutorial website built with Laravel 12, Inertia.js, and Vue.js 3. Featuring comprehensive content management, dark mode support, and role-based administration.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Inertia.js](https://img.shields.io/badge/Inertia.js-9553E9?style=for-the-badge&logo=inertiajs&logoColor=white)

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Screenshots](#-screenshots)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Database](#-database)
- [Authentication](#-authentication)
- [Admin Panel](#-admin-panel)
- [API Documentation](#-api-documentation)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

### 🎯 Core Features
- **📚 Content Management** - Full CRUD operations for articles, categories, and tutorials
- **🏷️ Tag System** - Comprehensive tagging with many-to-many relationships
- **🔍 Search & Filter** - Advanced content discovery capabilities
- **📱 Responsive Design** - Mobile-first approach with Tailwind CSS
- **🌙 Dark Mode** - System preference detection with manual toggle
- **👥 User Roles** - Admin, Editor, and User role management
- **🔐 Authentication** - Laravel Breeze with enhanced UI/UX

### 🚀 Advanced Features
- **📊 Analytics Dashboard** - View counts and content statistics
- **🎨 Theme System** - Persistent dark/light mode with smooth transitions
- **📝 Rich Content** - HTML content support with code syntax highlighting
- **🔗 SEO Optimized** - Friendly URLs, meta tags, and structured data
- **⚡ Performance** - Optimized build system with Vite
- **🔒 Security** - Role-based access control and middleware protection

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **ORM**: Eloquent with relationships and scopes
- **Authentication**: Laravel Breeze
- **API**: RESTful API design

### Frontend
- **Framework**: Vue.js 3 (Composition API)
- **Build Tool**: Vite 6
- **Styling**: Tailwind CSS 4
- **SPA**: Inertia.js for seamless navigation
- **Type Safety**: TypeScript
- **Icons**: Lucide Vue Next

### Development Tools
- **Package Manager**: Composer & NPM
- **Code Quality**: ESLint, Prettier
- **Version Control**: Git
- **Environment**: Laravel Sail (Docker) support

## 📸 Screenshots

### Home Page
- Hero section with authentication CTAs
- Programming categories showcase
- Latest articles with dark mode support

### Admin Dashboard
- Role-based content management
- Statistics and analytics
- CRUD operations for all content types

### Article Management
- Rich text editor for content creation
- Tag management and categorization
- Publication workflow

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ and NPM
- SQLite (or MySQL/PostgreSQL)

### Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/haryk13/web-semester-3.git
   cd web-semester-3
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see the application.

## ⚙️ Configuration

### Environment Variables

```env
# Application
APP_NAME="Web Learning Hub"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite

# For MySQL/PostgreSQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=web_learning_hub
# DB_USERNAME=root
# DB_PASSWORD=

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
```

### Vite Configuration

The project uses Vite for asset compilation with Hot Module Replacement (HMR) support. Configuration is in `vite.config.ts`.

## 📖 Usage

### User Roles

#### 👤 Regular User
- Browse articles and tutorials
- View programming categories
- Access dark mode toggle
- Register and login functionality

#### ✏️ Editor
- All user permissions
- Create and edit articles
- Manage tags and categories
- Access to content dashboard

#### 👑 Admin
- All editor permissions
- User management
- System configuration
- Full admin panel access

### Content Management

#### Creating Articles
1. Login as Admin/Editor
2. Navigate to Admin Dashboard
3. Go to Articles → Create New
4. Fill in title, content, category, and tags
5. Set publication status and date
6. Save and publish

#### Managing Categories
- Create programming categories with colors and icons
- Organize content by topic (Web, Mobile, Data Science, etc.)
- Set display order and active status

#### Tag System
- 25+ predefined programming tags
- Flexible tagging for content organization
- Tag-based filtering and search

## 💾 Database

### Schema Overview

```
users
├── id, name, email, password
├── email_verified_at, remember_token
├── role (admin|editor|user)
└── timestamps

categories
├── id, name, slug, description
├── color, icon, is_active, sort_order
└── timestamps

articles
├── id, title, slug, excerpt, content
├── image, category_id, user_id
├── author_name, reading_time
├── is_published, published_at, views_count
└── timestamps

tutorials
├── id, name, slug, description
├── color, language, tutorial_count
├── is_active, sort_order
└── timestamps

tags
├── id, name, slug, color, is_active
└── timestamps

article_tag (pivot)
├── id, article_id, tag_id
└── timestamps
```

### Sample Data

The seeders provide:
- **6 Programming Categories** (Web, Mobile, Game Dev, Data Science, DevOps, Basic Programming)
- **25+ Technology Tags** (Laravel, PHP, JavaScript, React, Python, etc.)
- **6 Tutorial Languages** (C, JavaScript, Java, PHP, Python, C++)
- **6 Sample Articles** with rich content and proper relationships
- **3 User Accounts** (Admin, Editor, User) for testing

## 🔐 Authentication

### Default Accounts

| Role | Email | Password | Access Level |
|------|--------|----------|--------------|
| Admin | admin@weblearning.com | password | Full admin access |
| Editor | editor@weblearning.com | password | Content management |
| User | user@weblearning.com | password | Basic user access |

### Features
- Laravel Breeze authentication
- Email verification support
- Password reset functionality
- Remember me option
- Role-based authorization
- Enhanced login/register UI

## 🎛️ Admin Panel

### Dashboard Features
- **Content Statistics** - Articles, categories, tags count
- **Recent Activity** - Latest articles and user actions
- **Quick Actions** - Fast access to common tasks
- **Role Management** - User role assignments

### Content Management
- **Articles CRUD** - Full article lifecycle management
- **Category Management** - Organize content topics
- **Tag Management** - Flexible content tagging
- **User Management** - Role-based user administration

### Settings
- **Dark Mode Integration** - Admin panel supports theming
- **Responsive Design** - Mobile-friendly admin interface
- **Security** - Protected routes with middleware

## 📡 API Documentation

### Public Endpoints

```
GET  /                    # Home page
GET  /artikel             # Articles listing
GET  /artikel/{slug}      # Single article
GET  /tutorial            # Tutorials listing
GET  /kategori            # Categories listing
GET  /kategori/{slug}     # Category articles
```

### Authentication Endpoints

```
GET  /login               # Login form
POST /login               # Login process
GET  /register            # Register form
POST /register            # Register process
POST /logout              # Logout
GET  /dashboard           # User dashboard
```

### Admin Endpoints (Protected)

```
GET  /admin               # Admin dashboard
GET  /admin/articles      # Articles management
GET  /admin/categories    # Categories management
GET  /admin/tags          # Tags management
```

## 🤝 Contributing

### Development Workflow

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Make your changes**
4. **Run tests**
   ```bash
   php artisan test
   npm run test
   ```
5. **Commit your changes**
   ```bash
   git commit -m 'Add amazing feature'
   ```
6. **Push to the branch**
   ```bash
   git push origin feature/amazing-feature
   ```
7. **Open a Pull Request**

### Code Standards
- Follow PSR-12 for PHP code
- Use ESLint and Prettier for JavaScript/TypeScript
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

### Development Commands

```bash
# Development server with HMR
npm run dev

# Build for production
npm run build

# Run PHP tests
php artisan test

# Run static analysis
vendor/bin/phpstan analyse

# Format code
npm run format
```

## 🔧 Troubleshooting

### Common Issues

#### Build Errors
```bash
# Clear cache and rebuild
npm run build
php artisan config:clear
php artisan cache:clear
```

#### Database Issues
```bash
# Reset database
php artisan migrate:fresh --seed
```

#### Permission Issues
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
```

## 📝 Changelog

### Version 1.0.0 (2025-07-25)
- ✨ Initial release
- 🚀 Complete Laravel 12 + Inertia.js + Vue.js 3 setup
- 🎨 Full dark mode implementation
- 👥 Role-based user management
- 📚 Content management system
- 🔐 Enhanced authentication UI
- 📱 Responsive design
- 🛠️ Production-ready build system

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🙏 Acknowledgments

- **Laravel Team** - For the amazing PHP framework
- **Vue.js Team** - For the progressive JavaScript framework
- **Inertia.js** - For seamless SPA experience
- **Tailwind CSS** - For utility-first CSS framework
- **Community** - For inspiration and feedback

## 📞 Support

- **Documentation**: Check this README and inline comments
- **Issues**: [GitHub Issues](https://github.com/haryk13/web-semester-3/issues)
- **Discussions**: [GitHub Discussions](https://github.com/haryk13/web-semester-3/discussions)

---

<div align="center">

**[⬆ Back to Top](#-web-learning-hub)**

</div>
