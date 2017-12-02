let mix = require('laravel-mix')
let webpack = require('webpack')
let process = require('process')

mix.setPublicPath('dist/')

mix.webpackConfig({
  plugins: [
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': `"${process.env.NODE_ENV}"`
    })
  ]
})

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('app/index.js', 'todo.js')
    .sass('style.scss', 'todo.css')
