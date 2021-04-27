const {src, dest} = require("gulp");
const minify = require("gulp-minify");

function minifyjs() {

    return src('assets/*.js', {allowEmpty: true})
        .pipe(minify({
            noSource: true,
            ignoreFiles: ['*-min.js']
        }))
        .pipe(dest('assets'))
}

exports.default = minifyjs;
