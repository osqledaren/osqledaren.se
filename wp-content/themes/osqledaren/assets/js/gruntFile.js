module.exports = function(grunt){

    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-browserify");
    grunt.loadNpmTasks("grunt-react");

    grunt.initConfig({

        browserify:{
            //Common is all the dependencies bundled together. The alias-option exposes them.
            standard:{
                src:["./standard/exportFile.js"],
                dest:"./compiled/standard.js",
                options:{
                    minifiy:true,
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
            }

        }
    })

    grunt.registerTask("default",["browserify:standard","browserify:podcast","watch"])
}
