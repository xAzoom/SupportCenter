var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')

    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/static', to: 'static'}
    ]))

    .enableBuildNotifications()
    .autoProvidejQuery()

    .addEntry('admin', './assets/js/admin/admin_react.js')

    .enableSourceMaps(!Encore.isProduction())
    .enableReactPreset()
;

module.exports = Encore.getWebpackConfig();