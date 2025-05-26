# SLAC (Student Learning & Activity Center) Website

This project implements an interactive web platform for Wenzhou-Kean University's Student Learning & Activity Center based on the requirements specified in the PRD document.

## Project Structure

```
/
├── index.html              # Main entry point
├── css/                    # Stylesheets
│   ├── style.css           # Main stylesheet
│   └── responsive.css      # Responsive design styles
├── js/                     # JavaScript files
│   ├── main.js             # Main JavaScript file
│   ├── floorplan.js        # Floor plan interaction logic
│   └── auth.js             # Authentication logic
├── img/                    # Image assets
│   ├── floor-plans/        # Floor plan images
│   └── locations/          # Location images
├── php/                    # PHP backend files
│   ├── config.php          # Database configuration
│   ├── auth/               # Authentication scripts
│   ├── contact/            # Contact form processing
│   └── db/                 # Database scripts
└── db/                     # Database schema
    └── schema.sql          # SQL schema definition
```

## Features

- Interactive floor plan navigation system
- User authentication system
- Contact form functionality
- Responsive design for multi-device accessibility

## Technologies Used

- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP
- Database: MySQL
- Responsive Design: Bootstrap
- Interactive Elements: SVG/Image maps

## Setup Instructions

1. Clone the repository
2. Set up a local web server with PHP and MySQL support
3. Import the database schema from `/db/schema.sql`
4. Configure database connection in `/php/config.php`
5. Access the website through your local web server

## Development Timeline

As specified in the PRD, the project is developed within a compressed timeline:

- **Hours 1-2:** Setup, planning, and basic structure
- **Hours 3-5:** Core floor plan functionality
- **Hours 6-8:** User authentication and database integration
- **Hours 9-10:** Contact form and additional features
- **Hours 11-12:** Testing, refinement, and deployment

## References

- WKU Library website design: https://library.wku.edu.cn/zh-hans/hours-spaces
- WKU branding guidelines