module.exports = function(grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    copy: {
      parentstyles: {
        files: [
          {src: '../salient/css/rgs.css', dest: 'lib/less/parent-css/rgs.css'},
          {src: '../salient/css/font-awesome.min.css', dest: 'lib/less/parent-css/font-awesome.min.css'},
          {src: '../salient/css/responsive.css', dest: 'lib/less/parent-css/responsive.css'},
          {src: '../salient/css/ascend.css', dest: 'lib/less/parent-css/ascend.css'},
          {src: '../salient/style.css', dest: 'lib/less/parent-css/style.css'}
        ],
        options: {
          process: function(content,srcpath){
            content = content.replace(/css\/fonts/g, '../../../salient/css/fonts');
            content = content.replace(/fonts\/fontawesome/g, '../../../salient/css/fonts/fontawesome');
            content = content.replace(/..\/img/g, '../../../salient/img');
            content = content.replace(/img\/textures/g, '../../../salient/img/textures');
            content = content.replace(/img\/icons/g, '../../../salient/img/icons');
            content = content.replace(/img\/transparent/g, '../../../salient/img/transparent');
            return content;
          }
        }
      }
    },
    less: {
      development: {
        options: {
          compress: false,
          yuicompress: false,
          optimization: 2,
          sourceMap: true,
          sourceMapFilename: 'lib/css/main.css.map',
          sourceMapBasepath: 'lib/less',
          sourceMapURL: 'main.css.map',
          sourceMapRootpath: '../../lib/less'
        },
        files: {
          // target.css file: source.less file
          'lib/css/main.css': 'lib/less/main.less'
        }
      },
      production: {
        options: {
          compress: true,
          yuicompress: true,
          optimization: 2
        },
        files: {
          'lib/css/main.css': 'lib/less/main.less'
        }
      }
    },
    cssmin: {
      target: {
        files: {
          'lib/css/main.css': ['lib/css/main.css']
        }
      }
    },
    watch: {
      styles: {
        files: ['lib/less/**/*.less'], // which files to watch
        tasks: ['less:development'],
        options: {
          nospawn: true
        }
      },
      js: {
        files: ['lib/js/**/*.js'],
        options: {
          nospawn: true
        }
      }
    },
    browserSync: {
      dev: {
        bsFiles: {
          src: [
            "lib/less/**/*.less",
            "lib/js/**/*.js"
          ]
        },
        options: {
          "proxy": "provisionproton.dev",
          "watchTask": true
        }
      }
    }
  });

  grunt.registerTask('default', ['browserSync', 'watch']);
  grunt.registerTask('build', ['less:production','cssmin']);
  grunt.registerTask('builddev', ['less:development']);
  grunt.registerTask('copystyles', ['copy:parentstyles']);
};