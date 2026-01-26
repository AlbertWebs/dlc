# Content Placement Guide - DLC Website Redesign

## Overview

This guide explains where to insert real content, images, and data in the redesigned website, and how to update or expand the site.

---

## 📍 Content Replacement Areas

### 1. **Images & Graphics**

#### Homepage (`index.html`)
- **Hero Section**: Replace `hero__image-placeholder` with actual hero image
  - Location: Line ~80-85
  - Recommended: High-quality image (1920x1080px or larger)
  - Format: WebP or optimized JPEG
  - Alt text: "DLC Life Coaching - Transform Your Life"

- **Feature Icons**: Currently using Font Awesome icons
  - Can replace with custom icons or images
  - Location: Feature cards in About Preview section

#### Team Page (`team.html`)
- **Team Member Avatars**: Replace placeholder icons with actual photos
  - Location: `team-card__avatar` divs
  - Recommended: Square images (400x400px minimum)
  - Format: JPEG or PNG
  - Alt text: "Photo of [Team Member Name]"

#### Program Pages
- **Program Icons**: Can replace Font Awesome icons with custom graphics
- **Hero Images**: Add program-specific hero images if desired

---

### 2. **Text Content**

#### Homepage (`index.html`)
- **Hero Headline**: Line ~70
  - Current: "Transform Your Life Through Professional Coaching"
  - Replace with actual DLC value proposition

- **Hero Description**: Line ~73
  - Current: Placeholder description
  - Replace with actual DLC mission statement

- **Statistics**: Lines ~85-95
  - Current: "10,000+ Lives Transformed", "500+ Coaches", "50+ Programs"
  - Replace with actual DLC statistics

- **About Preview**: Lines ~105-120
  - Replace placeholder text with actual DLC about content

- **Program Descriptions**: Lines ~140-200
  - Update with actual program details

- **Testimonials**: Lines ~250-290
  - Replace with real client testimonials
  - Include actual names, roles, and photos

#### About Page (`about.html`)
- **Mission Statement**: Replace placeholder
- **Company Story**: Replace with actual DLC history
- **Values List**: Update with actual DLC values

#### Team Page (`team.html`)
- **Team Member Names**: Replace placeholder names
- **Team Member Roles**: Update with actual roles
- **Team Member Bios**: Replace with real biographies
- **Credentials**: Update with actual certifications

#### Programs Pages
- **Program Details**: Update all program descriptions
- **Pricing**: Replace placeholder prices (KES amounts)
- **Schedules**: Update with actual program schedules
- **Features/Lists**: Update with actual program features

#### Events Page (`events.html`)
- **Event Listings**: Replace with actual upcoming events
- **Event Dates**: Update with real dates
- **Event Descriptions**: Replace with actual event details
- **Blog Posts**: Replace with real blog content

#### Contact Page (`contact.html`)
- **Contact Information**: Already includes placeholder info
  - Email: info@dlc.co.ke
  - Phone: +254 722 992 111
  - Location: Nairobi, Kenya
- **Office Hours**: Update with actual hours
- **FAQ**: Replace with actual frequently asked questions

---

### 3. **Forms & Functionality**

#### Contact Form (`contact.html`)
- **Form Action**: Line ~45
  - Current: `action="#"` (placeholder)
  - Update to: Backend endpoint or email service
  - Example: `action="/contact/submit"` or `action="mailto:info@dlc.co.ke"`

- **Form Fields**: Currently includes:
  - Name, Email, Phone, Subject, Message
  - Add additional fields as needed

#### My Account Page (`my-account.html`)
- **Login Form**: Requires backend authentication
- **Registration Form**: Requires user registration system
- **Password Reset**: Needs backend implementation

---

### 4. **Links & Navigation**

#### Navigation Menu
- **All Pages**: Update navigation links if page structure changes
- **Active States**: Ensure correct page shows as "active" in navigation

#### Footer Links
- **Social Media**: Update with actual social media URLs
  - Facebook, Twitter, LinkedIn, Instagram
- **Legal Links**: Add actual Privacy Policy and Terms pages
- **Internal Links**: Verify all internal links work correctly

---

## 🎨 Styling Customization

### Colors (`css/styles.css`)
Update CSS variables at the top of `styles.css`:
```css
:root {
    --color-primary: #1e3a5f;        /* Change primary color */
    --color-accent: #d4af37;          /* Change accent color */
    /* ... */
}
```

### Fonts (`css/styles.css`)
Update font imports in HTML `<head>`:
```html
<link href="https://fonts.googleapis.com/css2?family=YourFont..." rel="stylesheet">
```

Then update CSS variables:
```css
--font-heading: 'YourFont', sans-serif;
--font-body: 'YourFont', sans-serif;
```

### Logo
- **Location**: Navigation header on all pages
- **Current**: Text-based logo "DLC"
- **Replace**: Add `<img>` tag with actual logo
  - Recommended size: 200x60px
  - Format: SVG (preferred) or PNG

---

## 📱 Adding New Pages

### Step-by-Step Process

1. **Create HTML File**
   - Copy structure from existing page (e.g., `about.html`)
   - Update page title and meta description
   - Change navigation active state

2. **Update Navigation**
   - Add link to new page in navigation menu
   - Update on all existing pages

3. **Update Footer**
   - Add link to new page in footer (if appropriate)
   - Update on all existing pages

4. **Add Content**
   - Follow existing page structure
   - Use existing CSS classes for consistency
   - Add new CSS if needed

5. **Test**
   - Check responsive design (mobile, tablet, desktop)
   - Verify all links work
   - Test form submissions (if applicable)

---

## 🔧 Backend Integration

### Contact Form Integration

**Option 1: Email Service**
```javascript
// Add to contact form submission
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    // Send to email service (e.g., EmailJS, Formspree)
});
```

**Option 2: Backend API**
```javascript
// Send to Laravel backend
const response = await fetch('/api/contact', {
    method: 'POST',
    body: JSON.stringify(formData)
});
```

### My Account Integration

Requires:
- User authentication system
- Database for user accounts
- Session management
- Course/content management system

---

## 📊 Dynamic Content

### Events Listing
To make events dynamic:
1. Create events database/JSON file
2. Use JavaScript to populate events
3. Add filtering/categorization
4. Implement pagination if needed

### Blog Posts
To add blog functionality:
1. Create blog post template
2. Add blog listing page
3. Implement categories/tags
4. Add search functionality

### Testimonials
To make testimonials dynamic:
1. Create testimonials database/JSON
2. Use JavaScript to rotate/display
3. Add testimonial submission form
4. Implement moderation system

---

## 🖼️ Image Optimization

### Before Uploading Images

1. **Resize Images**
   - Hero images: 1920x1080px (or larger)
   - Team photos: 400x400px (square)
   - Program icons: 200x200px
   - Thumbnails: 300x200px

2. **Optimize Format**
   - Use WebP for photos (with JPEG fallback)
   - Use SVG for icons/logos
   - Compress images (TinyPNG, ImageOptim)

3. **Lazy Loading**
   - Images already set up for lazy loading
   - Add `data-src` attribute for lazy-loaded images
   - JavaScript handles loading on scroll

---

## 📝 SEO Optimization

### Meta Tags
Update on each page:
- `<title>`: Unique, descriptive titles
- `<meta name="description">`: 150-160 characters
- `<meta name="keywords">`: Relevant keywords

### Open Graph Tags (Add to `<head>`)
```html
<meta property="og:title" content="Page Title">
<meta property="og:description" content="Page Description">
<meta property="og:image" content="URL to image">
<meta property="og:url" content="Page URL">
```

### Structured Data
Add JSON-LD structured data for:
- Organization
- Events
- Courses/Programs
- Reviews/Testimonials

---

## 🚀 Performance Optimization

### Before Launch

1. **Minify CSS/JS**
   - Use build tools (Vite, Webpack)
   - Or online minifiers

2. **Optimize Images**
   - Compress all images
   - Use appropriate formats
   - Implement lazy loading

3. **Enable Caching**
   - Set cache headers
   - Use CDN for assets

4. **Test Performance**
   - Use Google PageSpeed Insights
   - Test on various devices
   - Check load times

---

## 🔄 Maintenance

### Regular Updates

1. **Content Updates**
   - Update events regularly
   - Add new blog posts
   - Update testimonials
   - Refresh team information

2. **Security**
   - Keep forms secure
   - Update dependencies
   - Monitor for vulnerabilities

3. **Analytics**
   - Add Google Analytics
   - Track user behavior
   - Monitor conversions

---

## 📞 Support & Resources

### Documentation Files
- `STYLE_GUIDE.md` - Complete style guide
- `DESIGN_DOCUMENTATION.md` - Design rationale
- `WIREFRAMES.md` - Layout descriptions
- `SITE_MAP.md` - Complete site structure
- `README.md` - Usage instructions

### Code Structure
- HTML: Semantic, accessible markup
- CSS: Organized, maintainable styles
- JavaScript: Modular, efficient code

---

**Last Updated**: 2024  
**Version**: 1.0

