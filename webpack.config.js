var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')

    .enableBuildNotifications()
    .autoProvidejQuery()

    .addEntry('admin', './assets/js/admin/admin.js')

    .enableSourceMaps(!Encore.isProduction())
    .enableReactPreset()
;

module.exports = Encore.getWebpackConfig();