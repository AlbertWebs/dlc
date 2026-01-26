# DLC Website Redesign

A modern, responsive redesign of the DLC (Destiny Life Coaching) website, featuring improved UX, accessibility, and performance.

## 📁 Project Structure

```
public/redesign/
├── index.html          # Homepage
├── about.html          # About Us page
├── team.html           # Team page
├── programs.html       # Programs page
├── events.html         # Events & Blog page
├── contact.html        # Contact page
├── css/
│   └── styles.css      # Main stylesheet
├── js/
│   └── main.js         # JavaScript functionality
└── README.md           # This file
```

## 🚀 Quick Start

1. **Open the website**: Simply open `index.html` in a web browser
2. **Local Server** (recommended): Use a local server to avoid CORS issues
   ```bash
   # Using Python
   python -m http.server 8000
   
   # Using PHP
   php -S localhost:8000
   
   # Using Node.js (http-server)
   npx http-server
   ```
3. **Access**: Navigate to `http://localhost:8000/public/redesign/`

## 🎨 Design Features

### Modern Design
- Clean, professional aesthetic
- Consistent branding throughout
- Balanced whitespace and visual hierarchy
- Polished color palette (Primary Blue + Accent Gold)

### Responsive & Mobile-First
- Fully responsive across all devices
- Mobile-first approach
- Touch-friendly navigation
- Optimized for performance

### User Experience
- Clear call-to-action buttons
- Intuitive navigation
- Improved readability
- Fast access to key information
- Smooth animations and interactions

### Accessibility
- Semantic HTML5
- WCAG AA compliant contrast ratios
- Keyboard navigation support
- Screen reader friendly
- Focus indicators on all interactive elements

### SEO Optimized
- Proper meta tags
- Semantic structure
- Alt text for images
- Fast load times
- Clean URL structure

## 📱 Pages Overview

### Homepage (`index.html`)
- Hero section with value proposition
- About preview
- Programs showcase
- Why choose us section
- Testimonials
- Events preview
- CTA sections

### About Us (`about.html`)
- Mission and values
- Company story
- Why choose us highlights

### Team (`team.html`)
- Leadership team
- Certified coaches
- Team member profiles

### Programs (`programs.html`)
- Detailed program information
- Career Coaching
- Life Coaching
- Certification Programs
- Corporate Coaching

### Events (`events.html`)
- Upcoming events
- Event registration
- Blog posts and insights

### Contact (`contact.html`)
- Contact form
- Contact information
- Office hours
- FAQ section

## 🎯 Key Improvements

### Design
- ✅ Modern, clean interface
- ✅ Professional color scheme
- ✅ Improved typography
- ✅ Better visual hierarchy
- ✅ Consistent spacing

### Functionality
- ✅ Mobile-responsive navigation
- ✅ Smooth scrolling
- ✅ Form validation
- ✅ Interactive elements
- ✅ Scroll animations

### Performance
- ✅ Optimized CSS
- ✅ Efficient JavaScript
- ✅ Fast load times
- ✅ Lazy loading ready

### Accessibility
- ✅ Semantic HTML
- ✅ ARIA labels where needed
- ✅ Keyboard navigation
- ✅ Screen reader support
- ✅ High contrast ratios

## 🛠️ Customization

### Colors
Edit CSS variables in `css/styles.css`:
```css
:root {
    --color-primary: #1e3a5f;
    --color-accent: #d4af37;
    /* ... */
}
```

### Typography
Change font families in `css/styles.css`:
```css
--font-heading: 'Poppins', sans-serif;
--font-body: 'Inter', sans-serif;
```

### Content
- Update text content directly in HTML files
- Replace placeholder images with actual images
- Update contact information in footer and contact page

## 📚 Documentation

- **Style Guide**: See `STYLE_GUIDE.md` in project root
- **Design Documentation**: See `DESIGN_DOCUMENTATION.md` in project root
- **Wireframes**: See `WIREFRAMES.md` in project root

## 🔧 Browser Support

- Chrome (last 2 versions)
- Firefox (last 2 versions)
- Safari (last 2 versions)
- Edge (last 2 versions)

## 📝 Notes

### Images
- Currently using Font Awesome icons as placeholders
- Replace with actual images for production
- Use optimized, web-friendly formats (WebP, JPEG, PNG)
- Include proper alt text for accessibility

### Forms
- Contact form requires backend integration
- Form validation is client-side only
- Connect to your email service or backend API

### Content
- All content is placeholder/original
- Replace with actual DLC content
- Update contact information
- Add real testimonials and team member information

## 🚀 Integration with Laravel

To integrate this design into your Laravel application:

1. **Move files to Laravel structure**:
   ```
   resources/views/redesign/
   public/css/redesign/
   public/js/redesign/
   ```

2. **Convert HTML to Blade templates**:
   - Rename `.html` to `.blade.php`
   - Use Laravel's `asset()` helper for CSS/JS paths
   - Use Blade syntax for dynamic content

3. **Update routes** in `routes/web.php`:
   ```php
   Route::get('/', function () {
       return view('redesign.index');
   });
   ```

4. **Create controllers** for dynamic content (programs, events, team)

## 📄 License

This redesign is created as an inspiration-based redesign. All content is original and does not copy from the original website.

## 🤝 Support

For questions or issues, please refer to the documentation files or contact the development team.

---

**Created**: 2024  
**Version**: 1.0  
**Status**: Ready for customization and content integration

