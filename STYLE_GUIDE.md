# DLC Website Redesign - Style Guide

## Color Palette

### Primary Colors
- **Primary Blue**: `#1e3a5f` - Trust, professionalism, stability
- **Primary Blue Dark**: `#0f1f35` - Headers, footer, deep accents
- **Primary Blue Light**: `#2d5a8a` - Hover states, secondary elements

### Secondary Colors
- **Accent Gold**: `#d4af37` - Highlights, CTAs, premium feel
- **Accent Gold Light**: `#e8c85a` - Hover states for gold elements
- **Accent Gold Dark**: `#b8941f` - Active states

### Neutral Colors
- **Background White**: `#ffffff` - Main background
- **Background Light**: `#f8f9fa` - Section backgrounds
- **Background Gray**: `#e9ecef` - Subtle dividers
- **Text Dark**: `#212529` - Primary text
- **Text Medium**: `#495057` - Secondary text
- **Text Light**: `#6c757d` - Tertiary text, captions

### Semantic Colors
- **Success**: `#28a745` - Success messages, positive indicators
- **Warning**: `#ffc107` - Warnings, important notices
- **Error**: `#dc3545` - Errors, alerts
- **Info**: `#17a2b8` - Informational messages

## Typography

### Font Families
- **Headings**: `'Poppins', sans-serif` - Modern, bold, professional
- **Body**: `'Inter', sans-serif` - Clean, readable, versatile
- **Accent**: `'Playfair Display', serif` - Elegant, for hero statements

### Font Sizes (Desktop)
- **H1**: `3.5rem` (56px) - Hero headlines
- **H2**: `2.5rem` (40px) - Section titles
- **H3**: `1.875rem` (30px) - Subsection titles
- **H4**: `1.5rem` (24px) - Card titles
- **H5**: `1.25rem` (20px) - Small headings
- **H6**: `1rem` (16px) - Smallest headings
- **Body Large**: `1.125rem` (18px) - Lead text
- **Body**: `1rem` (16px) - Standard text
- **Body Small**: `0.875rem` (14px) - Captions, fine print

### Font Sizes (Mobile)
- **H1**: `2.25rem` (36px)
- **H2**: `1.875rem` (30px)
- **H3**: `1.5rem` (24px)
- **H4**: `1.25rem` (20px)
- **Body**: `1rem` (16px)

### Font Weights
- **Light**: 300
- **Regular**: 400
- **Medium**: 500
- **Semi-Bold**: 600
- **Bold**: 700
- **Extra Bold**: 800

### Line Heights
- **Tight**: 1.2 - Headings
- **Normal**: 1.5 - Body text
- **Relaxed**: 1.75 - Long-form content

## Spacing System

Based on 8px grid system:
- **xs**: `0.25rem` (4px)
- **sm**: `0.5rem` (8px)
- **md**: `1rem` (16px)
- **lg**: `1.5rem` (24px)
- **xl**: `2rem` (32px)
- **2xl**: `3rem` (48px)
- **3xl**: `4rem` (64px)
- **4xl**: `6rem` (96px)

## Component Styles

### Buttons

#### Primary Button
- Background: `#1e3a5f` (Primary Blue)
- Text: `#ffffff` (White)
- Padding: `0.75rem 2rem`
- Border-radius: `0.5rem`
- Font-weight: `600`
- Hover: Background `#2d5a8a`, transform `scale(1.05)`
- Transition: `all 0.3s ease`

#### Secondary Button
- Background: `transparent`
- Border: `2px solid #1e3a5f`
- Text: `#1e3a5f`
- Padding: `0.75rem 2rem`
- Border-radius: `0.5rem`
- Hover: Background `#1e3a5f`, Text `#ffffff`

#### Accent Button (CTA)
- Background: `#d4af37` (Accent Gold)
- Text: `#0f1f35` (Dark)
- Padding: `1rem 2.5rem`
- Border-radius: `0.5rem`
- Font-weight: `700`
- Font-size: `1.125rem`
- Hover: Background `#e8c85a`, transform `scale(1.05)`

### Cards
- Background: `#ffffff`
- Border-radius: `0.75rem`
- Box-shadow: `0 4px 6px rgba(0, 0, 0, 0.1)`
- Padding: `2rem`
- Hover: Box-shadow `0 8px 16px rgba(0, 0, 0, 0.15)`, transform `translateY(-4px)`
- Transition: `all 0.3s ease`

### Input Fields
- Border: `1px solid #e9ecef`
- Border-radius: `0.5rem`
- Padding: `0.75rem 1rem`
- Focus: Border `#1e3a5f`, outline `none`, box-shadow `0 0 0 3px rgba(30, 58, 95, 0.1)`

### Navigation
- Background: `#ffffff` with `box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)`
- Sticky: `position: sticky`, `top: 0`, `z-index: 1000`
- Link hover: Color `#d4af37`, underline animation

## Layout

### Container Widths
- **Full**: `100%`
- **Wide**: `1400px` max-width
- **Standard**: `1200px` max-width
- **Narrow**: `800px` max-width

### Grid System
- **Desktop**: 12-column grid
- **Tablet**: 8-column grid
- **Mobile**: Single column, stacked

### Breakpoints
- **Mobile**: `0px - 767px`
- **Tablet**: `768px - 1023px`
- **Desktop**: `1024px+`
- **Large Desktop**: `1440px+`

## Shadows

- **Small**: `0 2px 4px rgba(0, 0, 0, 0.1)`
- **Medium**: `0 4px 6px rgba(0, 0, 0, 0.1)`
- **Large**: `0 8px 16px rgba(0, 0, 0, 0.15)`
- **XLarge**: `0 12px 24px rgba(0, 0, 0, 0.2)`

## Animations

### Transitions
- **Fast**: `0.15s ease`
- **Normal**: `0.3s ease`
- **Slow**: `0.5s ease`

### Keyframe Animations
- **Fade In**: `opacity 0 → 1`
- **Slide Up**: `translateY(20px) → translateY(0)`
- **Scale**: `scale(1) → scale(1.05)`

## Accessibility

### Contrast Ratios
- All text meets WCAG AA standards (4.5:1 minimum)
- Large text meets WCAG AAA standards (4.5:1 minimum)

### Focus States
- All interactive elements have visible focus indicators
- Focus ring: `3px solid #1e3a5f` with `rgba(30, 58, 95, 0.2)` background

### Semantic HTML
- Proper heading hierarchy (h1 → h2 → h3)
- ARIA labels where needed
- Alt text for all images
- Form labels properly associated

## Icons

- **Library**: Font Awesome 6 or Heroicons
- **Size**: `1rem` (16px) standard, `1.5rem` (24px) large
- **Color**: Inherit from parent or use primary colors

