# Sage + Vite Theme
Advanced WordPress starter theme with Tailwind CSS, Laravel Blade and Vite
## Documentation

 - [Sage](https://roots.io/sage/docs/)
 - [Vite](https://vitejs.dev/)
 - [Tailwind](https://tailwindcss.com/docs/installation)


## Requirements

 - [Acorn](https://roots.io/acorn/docs/installation/) v4
 - [PHP](https://secure.php.net/manual/en/install.php) >= 8.1
 - [Node](http://nodejs.org/) >= 16.0.0
 - [Yarn](https://yarnpkg.com/en/docs/install)
 - WSL is not required


## Installation

Rename .env.example to .env and set the url for your site in ```APP_URL```, also you can configurate the Hot Module Replacement in ```HMR_HOST``` and ```HMR_PORT```

Make sure you have all the requirements, then clone the repository and inside of the folder run the follows commands.

First run:
```bash
  yarn
```
Then:
```bash
  composer install
```
Once you have all the dependencies you have to build the assets:
```bash
  yarn build
```
And Finally just run:
```bash
  yarn dev
```


## Recomended libraries

- [ACF Composer](https://github.com/Log1x/acf-composer) for the advanced custom fields, (AFC Pro required)
- [Navi](https://github.com/Log1x/navi) Easy way to handle the WordPress menus, I also hate the WordPress NavWalker xD
- [Poet](https://github.com/Log1x/poet) provides simple configuration-based post type, taxonomy, editor color palette, block category, block pattern and block registration/modification.

