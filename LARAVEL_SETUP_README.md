# DLC Laravel Website - Setup & Documentation

## 🚀 Quick Start

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
php artisan migrate
php artisan db:seed --class=NavigationSeeder
```

### 4. Build Assets
```bash
npm run build
# or for development
npm run dev
```

### 5. Start Server
```bash
php artisan serve
```

## 📁 Project Structure

```
dlc/
├── app/
│   ├── Http/Controllers/
│   │   ├── PageController.php          # Frontend pages
│   │   └── Admin/                      # Admin CRUD controllers
│   │       ├── PageController.php
│   │       ├── NavigationController.php
│   │       ├── ProgramController.php
│   │       ├── TeamController.php
│   │       ├── EventController.php
│   │       └── HeroBannerController.php
│   └── Models/
│       ├── Page.php
│       ├── Navigation.php
│       ├── Program.php
│       ├── TeamMember.php
│       ├── Event.php
│       └── HeroBanner.php
├── database/
│   ├── migrations/                     # All migrations created
│   └── seeders/
│       └── NavigationSeeder.php        # Navigation menu seeder
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php          # Main layout
│   │   ├── components/
│   │   │   ├── header.blade.php       # Header component
│   │   │   └── footer.blade.php      # Footer component (4-column)
│   │   ├── pages/
│   │   │   └── home.blade.php         # Homepage
│   │   └── admin/                     # Admin panel views (to be created)
│   ├── css/
│   │   └── app.css                    # TailwindCSS with custom theme
│   └── js/
│       └── app.js                     # JavaScript
└── routes/
    └── web.php                        # Routes configured
```

## 🎨 Design Features

### TailwindCSS Custom Theme
- **Primary Colors**: Blue palette (#1e3a5f to #0f1f35)
- **Accent Colors**: Gold palette (#d4af37)
- **Typography**: Poppins (headings), Inter (body), Playfair Display (accent)
- **Components**: Buttons, cards, sections with custom classes

### Responsive Design
- Mobile-first approach
- Breakpoints: sm (640px), md (768px), lg (1024px), xl (1280px)
- Fully responsive navigation (mobile hamburger menu)

### Scroll Effects
- Fade-in animations on scroll
- Slide-up animations
- Intersection Observer API for performance

## 📝 Navigation Structure

### Frontend Navigation (Visible)
- Home
- About Us
- Events
- Become a Coach
- Contact

### CMS-Controlled (Hidden from Frontend Nav)
- Life Mastery Bootcamp
- Life Mastery Webinar
- My Account

These are stored in the database but `is_visible` is set to `false` for frontend navigation. They can be managed through the admin panel.

## 🗄️ Database Structure

### Tables Created
1. **pages** - CMS pages
2. **navigations** - Navigation menu items
3. **programs** - Coaching programs
4. **team_members** - Team members
5. **events** - Events/blog posts
6. **hero_banners** - Hero banners for pages

## 🔐 Admin Panel

### Access
- URL: `/admin/dashboard`
- Requires authentication (use Laravel Breeze/Jetstream)

### CRUD Operations Available
- **Pages**: Create/edit pages
- **Navigation**: Manage menu items (order, visibility)
- **Programs**: Manage coaching programs
- **Team**: Manage team members
- **Events**: Manage events/blog posts
- **Hero Banners**: Manage hero banners

## 📄 Pages to Create

### Frontend Pages (Blade Templates)
1. ✅ `pages/home.blade.php` - Homepage
2. ⏳ `pages/about.blade.php` - About page
3. ⏳ `pages/events.blade.php` - Events listing
4. ⏳ `pages/become-a-coach.blade.php` - Become a coach page
5. ⏳ `pages/contact.blade.php` - Contact page
6. ⏳ `pages/programs.blade.php` - Programs listing
7. ⏳ `pages/program-detail.blade.php` - Single program page

### Admin Pages (To Be Created)
1. ⏳ `admin/dashboard.blade.php` - Admin dashboard
2. ⏳ `admin/pages/index.blade.php` - Pages list
3. ⏳ `admin/pages/create.blade.php` - Create page
4. ⏳ `admin/pages/edit.blade.php` - Edit page
5. ⏳ Similar for other resources (navigations, programs, etc.)

## 🎯 Next Steps

### Immediate Tasks
1. **Create Remaining Frontend Pages**
   - Convert HTML from `public/redesign/` to Blade templates
   - Use components for reusable elements

2. **Build Admin Panel**
   - Create admin layout
   - Build CRUD forms for all resources
   - Add image upload functionality

3. **Add Authentication**
   - Install Laravel Breeze or Jetstream
   - Set up admin authentication

4. **Complete Seeders**
   - Add default pages seeder
   - Add default programs seeder
   - Add sample data seeders

5. **Add Image Handling**
   - Set up file storage
   - Add image upload to admin forms
   - Use Laravel Storage for images

### Enhancements
1. **SEO**
   - Add meta tags to all pages
   - Add Open Graph tags
   - Add structured data (JSON-LD)

2. **Performance**
   - Optimize images
   - Add caching
   - Lazy load images

3. **Features**
   - Contact form submission
   - Newsletter signup
   - Event registration
   - Search functionality

## 🛠️ Customization

### Colors
Edit `resources/css/app.css` to change color scheme:
```css
--color-primary-600: #1e3a5f;  /* Change primary color */
--color-accent-500: #d4af37;   /* Change accent color */
```

### Fonts
Update font imports in `resources/views/layouts/app.blade.php`

### Components
All reusable components are in `resources/views/components/`

## 📚 Documentation Files

- `STYLE_GUIDE.md` - Complete style guide
- `DESIGN_DOCUMENTATION.md` - Design rationale
- `WIREFRAMES.md` - Layout descriptions
- `SITE_MAP.md` - Site structure
- `CONTENT_PLACEMENT_GUIDE.md` - Content management guide

## 🔧 Commands

### Development
```bash
npm run dev          # Watch for changes
php artisan serve    # Start dev server
```

### Production
```bash
npm run build        # Build for production
php artisan optimize # Optimize for production
```

### Database
```bash
php artisan migrate          # Run migrations
php artisan migrate:fresh    # Fresh migration
php artisan db:seed          # Seed database
```

## 📞 Support

For questions or issues:
1. Check existing documentation files
2. Review Laravel documentation
3. Check TailwindCSS documentation

---

**Status**: Foundation Complete - Ready for Content & Admin Panel Development  
**Version**: 1.0  
**Last Updated**: 2024

