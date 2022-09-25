const path = require('path');

module.exports = { 
    module: {
        rules: [
            {
                test: /\.m?jsx?$/,
                resolve: {
                    fullySpecified: false
                },
            }
        ]
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
        extensions: ['.wasm', '.mjs', '.js', '.jsx', '.json'],
    },
};
