module.exports = function(grunt){
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        settings: {
            app: 'assets',
            distJs: 'javascript',
            distCss: 'css',
            temp: '.tmp'
        },
        banner: '/*!\n' +
            '* <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %>\n' +
            '*/\n',
        less: {
            dev: {
                src: [
                    '<%= settings.app %>/less/main.less',
                ],
                dest: '<%= settings.distCss %>/main.css',
            }
        },
        concat: {
            options: {
                stripBanners: true,
                banner: '<%= banner %>'
            },
            main: {
                src: [
                    '<%= settings.app %>/js/*.js'
                ],
                dest: '<%= settings.distJs %>/script.js',
            },
            libs: {
                src: [
                    '<%= settings.app %>/bower_components/jquery/dist/jquery.js',
                ],
                dest: '<%= settings.distJs %>/libs.js'
            }
        },
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            main: {
                src: ['<%= concat.main.dest %>'],
                dest: '<%= settings.distJs %>/scripts.min.js'
            },
            libs: {
                src: ['<%= concat.libs.dest %>'],
                dest: '<%= settings.distJs %>/libs.min.js'
            }
        },
        jshint: {
            gruntfile: ['Gruntfile.js'],
            beforeconcat: ['<%= settings.app %>/js/*.js'],
            afterconcat: ['<%= settings.distJs %>/script.js']
        },
        clean: {
            build: {
                src: [
                    "<%= settings.distJs %>",
                    "<%= settings.distCss %>",
                    "<%= settings.temp %>"
                ]
            }
        },
        autoprefixer: {
            dev: {
                src: '<%= settings.temp %>/css/main.css',
                dest: '<%= settings.distCss %>/main.css'
            }
        },
        cssmin: {
            minify: {
                expand: true,
                cwd: '<%= settings.distCss %>/',
                src: ['*.css', '!*.min.css'],
                dest: '<%= settings.distCss %>/',
                ext: '.min.css'
            }
        },
        watch: {
            less : {
                files : 'assets/less/**',
                tasks : [ 'less:dev' ]
            },
            autoprefixer : {
                files : '<%= settings.distCss %>/css/*.css',
                tasks : [ 'autoprefixer:dev' ]
            },
            gruntfile: {
                files: 'Gruntfile.js',
                tasks: ['jshint:gruntfile']
            },
            test: {
                files: '<%= concat.main.src %>',
                tasks: ['jshint:beforeconcat']
            },
            concat: {
                files: '<%= concat.main.src %>',
                tasks: ['concat']
            },
            min: {
                files: '<%= concat.main.dest %>',
                tasks: ['jshint:afterconcat']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('dp-grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('css', [
        'less:dev',
        'autoprefixer:single_file',
        'cssmin'
    ]);

    grunt.registerTask('js', [
        'concat',
        'uglify'
    ]);

    grunt.registerTask('testTarget', [
        //'clean'
    ]);

    grunt.registerTask('default', [
        'css',
        'js',
    ]);

};
