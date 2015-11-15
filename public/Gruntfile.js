module.exports = function(grunt) {

    var base = 'javascript/';
    var dest = 'built/';
    var scss = 'stylesheet/scss/*.scss';
    var css = 'stylesheet/';

    grunt.initConfig({
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: [base + 'app.js', base + '*/*/*.js'],
                dest: dest + 'built.js'
            }
        },
        uglify: {
            options: {
                separator: ';'
            },
            dist: {
                src: dest+'built.js',
                dest: dest+'built.js'
            }
        },
        watch: {
            compass: {
                files: scss,
                options: {
                    dest: css,
                    outputstyle: 'compressed',
                    linecomments: false,
                    forcecompile: true,
                    debugsass: false,
                    relativeassets: true
                }
            },
            scripts: {
                files: ['<%= concat.dist.src %>'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');

    grunt.registerTask('default', ['watch']);
    grunt.registerTask('compile', ['concat', 'uglify']);

};