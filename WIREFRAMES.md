# DLC Website Redesign - Wireframes & Layout Descriptions

## Overview

This document describes the wireframe structure and layout for both desktop and mobile versions of the redesigned DLC website. Since we're working with text-based descriptions, these wireframes outline the structure, hierarchy, and component placement.

---

## Desktop Layout (1024px+)

### Header/Navigation
```
┌─────────────────────────────────────────────────────────────┐
│ [DLC Logo]  [Home] [About] [Team] [Programs] [Events] [Contact]  [Get Started Button] │
└─────────────────────────────────────────────────────────────┘
```
- **Sticky header** that remains visible on scroll
- Logo on the left with tagline
- Horizontal navigation menu
- CTA button on the right
- Clean, minimal design with subtle shadow

---

### Homepage - Hero Section
```
┌─────────────────────────────────────────────────────────────┐
│                                                               │
│         Transform Your Life Through                           │
│         Professional Coaching                                 │
│                                                               │
│    [Subheadline text describing value proposition]           │
│                                                               │
│    [Start Your Journey] [Learn More]                         │
│                                                               │
│    10,000+ Lives | 500+ Coaches | 50+ Programs               │
│                                                               │
│                    [Hero Image/Illustration]                  │
└─────────────────────────────────────────────────────────────┘
```
- **Two-column layout**: Content left, image right
- Large, impactful headline
- Two CTA buttons (primary and secondary)
- Statistics showcase
- Full-width section with gradient background

---

### Homepage - About Preview
```
┌─────────────────────────────────────────────────────────────┐
│                    Who We Are                                │
│         Empowering Lives Through Expert Coaching             │
│                                                               │
│    [Text Content]                    [Feature Cards]         │
│    [Learn More Button]              [Icon] Certified         │
│                                      [Icon] Expert Coaches   │
│                                      [Icon] Proven Results   │
└─────────────────────────────────────────────────────────────┘
```
- **Two-column grid**: Text content and feature cards
- Three feature cards with icons
- Light background color for contrast

---

### Homepage - Programs Section
```
┌─────────────────────────────────────────────────────────────┐
│                  Our Programs                                 │
│         Coaching Programs That Transform                     │
│                                                               │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐   │
│  │ [Icon]   │  │ [Icon]   │  │ [Icon]   │  │ [Icon]   │   │
│  │ Career   │  │ Life     │  │ Certif.  │  │ Corporate│   │
│  │ Coaching │  │ Coaching │  │ Program  │  │ Coaching │   │
│  │          │  │          │  │          │  │          │   │
│  │ [Features│  │ [Features│  │ [Features│  │ [Features│   │
│  │ [Learn   │  │ [Learn   │  │ [Learn   │  │ [Learn   │   │
│  │  More]   │  │  More]   │  │  More]   │  │  More]   │   │
│  └──────────┘  └──────────┘  └──────────┘  └──────────┘   │
│                                                               │
│                    [View All Programs]                        │
└─────────────────────────────────────────────────────────────┘
```
- **Four-column grid** (responsive, becomes 2x2 on tablet, stacked on mobile)
- Each card has icon, title, description, features list, and CTA
- Cards have hover effects (lift and shadow)

---

### Homepage - Why Choose Us
```
┌─────────────────────────────────────────────────────────────┐
│                 Why Choose Us                                │
│              What Sets Us Apart                              │
│                                                               │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐   │
│  │   01     │  │   02     │  │   03     │  │   04     │   │
│  │ Proven   │  │Personal. │  │ Expert   │  │ Ongoing  │   │
│  │ Method   │  │ Approach │  │ Coaches  │  │ Support  │   │
│  └──────────┘  └──────────┘  └──────────┘  └──────────┘   │
└─────────────────────────────────────────────────────────────┘
```
- **Four-column grid** with numbered items
- Large numbers as visual elements
- Light background section

---

### Homepage - Testimonials
```
┌─────────────────────────────────────────────────────────────┐
│                Success Stories                                │
│              What Our Clients Say                            │
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐       │
│  │ [Quote Icon] │  │ [Quote Icon] │  │ [Quote Icon] │       │
│  │              │  │              │  │              │       │
│  │ Testimonial │  │ Testimonial │  │ Testimonial │       │
│  │    Text     │  │    Text     │  │    Text     │       │
│  │              │  │              │  │              │       │
│  │ [Avatar]     │  │ [Avatar]     │  │ [Avatar]     │       │
│  │ Name, Role   │  │ Name, Role   │  │ Name, Role   │       │
│  └──────────────┘  └──────────────┘  └──────────────┘       │
└─────────────────────────────────────────────────────────────┘
```
- **Three-column grid** of testimonial cards
- Quote icon, testimonial text, author info with avatar

---

### Homepage - Events Preview
```
┌─────────────────────────────────────────────────────────────┐
│                Latest Updates                                 │
│              Events & Insights                                │
│                                                               │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐                   │
│  │ [Date]   │  │ [Date]   │  │ [Date]   │                   │
│  │ Event    │  │ Event    │  │ Event    │                   │
│  │ Title    │  │ Title    │  │ Title    │                   │
│  │ Desc.    │  │ Desc.    │  │ Desc.    │                   │
│  │ [Link]   │  │ [Link]   │  │ [Link]   │                   │
│  └──────────┘  └──────────┘  └──────────┘                   │
│                                                               │
│                    [View All Events]                         │
└─────────────────────────────────────────────────────────────┘
```
- **Three-column grid** of event cards
- Date badge, title, description, link
- Light background section

---

### Footer
```
┌─────────────────────────────────────────────────────────────┐
│  About DLC        Quick Links      Programs      Contact     │
│                                                               │
│  [Description]    Home            Career        Email        │
│  [Social Icons]   About           Life          Phone        │
│                   Team            Certif.       Location     │
│                   Programs        Corporate                  │
│                   Events                                     │
│                   Contact                                     │
│                                                               │
│  ─────────────────────────────────────────────────────────  │
│  © 2024 DLC                    Privacy | Terms              │
└─────────────────────────────────────────────────────────────┘
```
- **Four-column layout**
- Company info, links, programs, contact
- Social media icons
- Copyright and legal links at bottom
- Dark background (primary dark color)

---

## Mobile Layout (0-767px)

### Mobile Header
```
┌─────────────────────────────┐
│  [DLC Logo]        [☰ Menu] │
└─────────────────────────────┘
```
- Logo centered or left-aligned
- Hamburger menu icon on right
- Full-screen overlay menu when opened

---

### Mobile Hero Section
```
┌─────────────────────────────┐
│                             │
│   Transform Your Life        │
│   Through Professional       │
│   Coaching                  │
│                             │
│   [Subheadline text]        │
│                             │
│   [Start Your Journey]      │
│   [Learn More]              │
│                             │
│   10,000+ Lives             │
│   500+ Coaches              │
│   50+ Programs              │
│                             │
│   [Hero Image]              │
│                             │
└─────────────────────────────┘
```
- **Single column**, stacked layout
- Full-width buttons
- Statistics stacked vertically
- Image below content

---

### Mobile Content Sections
```
┌─────────────────────────────┐
│                             │
│   Section Title             │
│                             │
│   ┌─────────────────────┐   │
│   │   Card 1           │   │
│   └─────────────────────┘   │
│                             │
│   ┌─────────────────────┐   │
│   │   Card 2           │   │
│   └─────────────────────┘   │
│                             │
│   ┌─────────────────────┐   │
│   │   Card 3           │   │
│   └─────────────────────┘   │
│                             │
└─────────────────────────────┘
```
- All sections stack vertically
- Cards are full-width
- Consistent spacing between elements
- Touch-friendly tap targets (minimum 44x44px)

---

### Mobile Navigation Overlay
```
┌─────────────────────────────┐
│  [X]                        │
│                             │
│  Home                       │
│  About Us                   │
│  Team                       │
│  Programs                   │
│  Events                     │
│  Contact                    │
│                             │
│  [Get Started Button]       │
│                             │
└─────────────────────────────┘
```
- Full-screen overlay
- Close button (X) top right
- Vertical list of links
- CTA button at bottom
- Dark overlay background

---

## Page-Specific Layouts

### About Page
- Hero section with page title
- Mission section (full-width text)
- Story section (full-width text)
- Values list (stacked items)
- Why Choose Us section (same as homepage)
- CTA section

### Team Page
- Hero section
- Leadership team grid (3 columns desktop, 1 column mobile)
- Coaches grid (6 items, responsive grid)
- CTA section

### Programs Page
- Hero section
- Each program in a detailed card:
  - Program header with icon
  - Two-column layout: Content left, sidebar right
  - Sidebar: Price, meta info, CTA button
- On mobile: Sidebar moves below content

### Events Page
- Hero section
- Upcoming events list (vertical cards)
- Each event card: Date badge, content, action button
- Blog section (3-column grid, becomes single column on mobile)

### Contact Page
- Hero section
- Two-column layout:
  - Left: Contact form
  - Right: Contact info cards
- FAQ section below
- On mobile: Form and info stack vertically

---

## Responsive Breakpoints

- **Mobile**: 0-767px
  - Single column layout
  - Stacked cards
  - Hamburger menu
  - Full-width buttons

- **Tablet**: 768-1023px
  - Two-column grids where appropriate
  - Adjusted spacing
  - May show hamburger menu or horizontal nav

- **Desktop**: 1024px+
  - Full multi-column layouts
  - Horizontal navigation
  - Maximum container width: 1200px

- **Large Desktop**: 1440px+
  - Centered container with max-width
  - Generous whitespace

---

## Component Specifications

### Buttons
- **Primary**: Blue background, white text
- **Secondary**: Transparent with blue border
- **Accent**: Gold background, dark text
- **Size**: Standard (0.75rem padding) or Large (1rem padding)
- **Hover**: Lift effect, shadow, color change

### Cards
- White background
- Border radius: 0.75rem
- Box shadow: Medium
- Padding: 2rem
- Hover: Lift up, larger shadow

### Forms
- Input fields: Border, rounded corners
- Focus: Blue border, subtle shadow
- Labels: Above inputs, bold
- Error states: Red border, error message below

### Typography
- Headings: Poppins, bold
- Body: Inter, regular
- Accent: Playfair Display for hero statements
- Line height: 1.6 for body, 1.2 for headings

---

## Visual Hierarchy

1. **Hero Section**: Largest, most prominent
2. **Section Titles**: Large, centered
3. **Card Titles**: Medium, left-aligned
4. **Body Text**: Standard size, readable
5. **Captions**: Smaller, lighter color

---

## Spacing System

- Consistent padding: 2rem (32px) between sections
- Card padding: 2rem internal
- Grid gaps: 2rem between cards
- Mobile: Reduced spacing (1.5rem sections, 1rem gaps)

---

## Color Usage

- **Primary Blue**: Headers, buttons, links
- **Accent Gold**: CTAs, highlights, icons
- **White**: Cards, backgrounds
- **Light Gray**: Section backgrounds
- **Dark**: Text, footer

---

## Accessibility Considerations

- Clear focus states on all interactive elements
- High contrast ratios (WCAG AA compliant)
- Semantic HTML structure
- Alt text for all images
- Keyboard navigation support
- Screen reader friendly

---

## Animation & Interactions

- **Scroll animations**: Elements fade in as user scrolls
- **Hover effects**: Buttons lift, cards elevate
- **Smooth transitions**: 0.3s ease for all interactions
- **Mobile menu**: Slide-in animation
- **Respects reduced motion**: Animations disabled if user prefers

---

This wireframe structure ensures a clean, professional, and user-friendly experience across all devices while maintaining the core purpose and content organization of the original DLC website.

