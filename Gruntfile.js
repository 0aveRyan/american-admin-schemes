module.exports = function(grunt) {

	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			colors: {
				options: {
					style: 'compact',
					noCache: true,
					sourcemap: false
				},
				expand: true,
				cwd: '.',
				dest: '.',
				ext: '.css',
				src: [
					'*/colors.scss'
				]
			}
		},

		rtlcss: {
			colors: {
				expand: true,
				cwd: '.',
				dest: '.',
				ext: '-rtl.css',
				src: [
					'./*/colors.css'
				]
			}
		},
		
		cssmin: {
  			target: {
    			files: [{
      				expand: true,
      				cwd: 'from-many-one/',
     				src: ['*.css', '!*.min.css'],
   				   	dest: 'from-many-one/',
   				   	ext: '.min.css'
   				},
   				{
      				expand: true,
      				cwd: 'nasa/',
     				src: ['*.css', '!*.min.css'],
   				   	dest: 'nasa/',
   				   	ext: '.min.css'
   				},
   				{
      				expand: true,
      				cwd: 'nasa-1976/',
     				src: ['*.css', '!*.min.css'],
   				   	dest: 'nasa-1976/',
   				   	ext: '.min.css'
   				},
   				{
      				expand: true,
      				cwd: 'old-glory/',
     				src: ['*.css', '!*.min.css'],
   				   	dest: 'old-glory/',
   				   	ext: '.min.css'
   				},
   				{
      				expand: true,
      				cwd: 'open-highway/',
     				src: ['*.css', '!*.min.css'],
   				   	dest: 'open-highway/',
   				   	ext: '.min.css'
   				},
   				{
      				expand: true,
      				cwd: 'shenandoah/',
     				src: ['*.css', '!*.min.css'],
   				   	dest: 'shenandoah/',
   				   	ext: '.min.css'
   				},]
   			}
   		},

		watch: {
			sass: {
				files: ['**/*.scss', ],
				tasks: ['sass:colors', 'rtlcss', 'cssmin']
			}
		}

	});

	// Default task(s).
	grunt.registerTask('default', ['sass','rtlcss']);

};
