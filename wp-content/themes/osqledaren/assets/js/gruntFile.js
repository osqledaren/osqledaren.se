module.exports = function(grunt){

    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-browserify");
    grunt.loadNpmTasks("grunt-react");
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.initConfig({

        browserify:{
            //Common is all the dependencies bundled together. The alias-option exposes them.
            standard:{
                src:["./standard/exportFile.js"],
                dest:"./compiled/standard.js",
                options:{
                    alias:['jquery'] //other files can use this files ref to jquery.
                }
            },

            //Podcast-page JS.
            podcast:{
                src:["./podcast/exportFile.js"],
                dest:"./compiled/podcast.js",
                options:{
                    external:["jquery"],
                    transform: [ require('grunt-react').browserify ],
                }
            },

            adv_cal:{
                src:["./osq-advent-calendar/exportFile.js"],
                dest:"./compiled/adv_cal.js",
                options:{
                    external:["jquery"]
                }
            }
        },

        uglify:{
            build:{
                files: {
                    "./compiled/podcast.js":["./compiled/podcast.js"],
                    "./compiled/standard.js":["./compiled/standard.js"]
                }
            }
        },

        //Loaded with grunt-contrib-watch
        //Watches changes in files and performs tasks.

        watch:{

            standard:{
                files:["./standard/**/*.js"],
                tasks:["browserify:standard","watch"],
            },

            podcast:{
                files:["./podcast/**/*.js"],
                tasks:["browserify:podcast","watch"]
            },

            adv_cal:{
                files:["./osq-advent-calendar/**/*.js"],
                tasks:["browserify:adv_cal","watch"]
            }

        }
    })

    grunt.registerTask("default", ["browserify:standard","browserify:podcast","browserify:adv_cal","watch"])
    grunt.registerTask("build", ["browserify:standard","browserify:podcast","uglify"]);
}
