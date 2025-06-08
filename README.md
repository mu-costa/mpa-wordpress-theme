
Built by https://www.blackbox.ai

---

```markdown
# MPA Theme

## Project Overview
The MPA Theme is a custom WordPress theme developed for the movement of small farmers (Movimento dos Pequenos Agricultores) in Brazil. It provides a responsive and engaging user experience, tailored for news articles, TV shows, radio shows, and events related to MPA. The theme includes various custom post types and is fully compatible with WordPress.

## Installation

To install the MPA Theme, follow these steps:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/username/mpa-theme.git
   ```

2. **Upload the Theme**:
   - Compress the theme folder into a `.zip` file.
   - In your WordPress admin panel, go to **Appearance > Themes > Add New > Upload Theme**. 
   - Choose the `.zip` file and click **Install Now**.

3. **Activate the Theme**:
   - After installation, click **Activate** to set the MPA Theme as your active theme.

4. **Setup Required Plugins** (if any are specified).

## Usage

Once the theme is activated:

- Navigate to **Appearance > Customize** to set up your site's identity, menus, and various other options available in the WordPress Customizer.
- Add content through **Posts** for news articles and utilize **Custom Post Types** for News, TV Shows, Radio Shows, and Events.

### Navigation

The theme supports a primary navigation menu that can be set through **Appearance > Menus**.

## Features

- **Responsive Design**: The theme is mobile-friendly and adapts to different screen sizes.
- **Custom Post Types**: Easily manage and display News, TV Shows, Radio Shows, and Events.
- **Custom Taxonomies**: Categorize news articles and event types for better organization.
- **Widgets**: Sidebar and footer widgets for additional content management.
- **Cookie Consent**: Implemented cookie consent functionality to comply with user privacy regulations.
- **Social Media Integration**: Easily shareable posts with social media icons.

## Dependencies

The theme includes the following dependencies:
- **Open Sans** from Google Fonts for improved typography.
- **Font Awesome** for icons.

These are enqueued in the theme using the `functions.php` file.

## Project Structure

```plaintext
mpa-theme/
│
├── assets/
│   ├── css/
│   └── js/
│
├── languages/
│
├── template-parts/
│
├── archive-noticias.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── 404.php
├── page.php
├── search.php
├── searchform.php
├── single-noticias.php
├── style.css
```

- **style.css**: Contains theme information and styles for the layout.
- **functions.php**: Contains all theme setup functions including enqueue scripts, register custom post types, and theme support.
- **header.php**: Defines the main header structure of the site.
- **footer.php**: Contains the footer structure.
- **front-page.php**: The homepage layout.
- **archive-noticias.php**: The template for displaying news articles in an archive format.
- **single-noticias.php**: The template for displaying single news articles.
- **404.php**: Custom error page for not found content.
- **page.php**: Standard template for displaying static pages.

## License
The MPA Theme is licensed under the GNU General Public License v2 or later. See the [LICENSE](http://www.gnu.org/licenses/gpl-2.0.html) for more details.
```

This README file provides a thorough outline of the MPA Theme, its installation instructions, usage, features, dependencies, and project structure, designed to assist both users and developers.