/**
 * Replaces some strings in some files
 * - strings in the gravity form XML import file
 * - strings in header.php (phone number)
 * - functions.child (define) 
 */
module.exports = {
	all: {
		options: {
			patterns: [
				{
					match: 'clientmail',
					replacement: 'xx<%= projectName %>'
				},
				{
					match: 'gravityform_xml_url',
					replacement: 'includes/gravityforms-contactform.xml'
				},
				{
					match: 'clientmail',
					replacement: 'xx<%= projectName %>'
				},
				{
					match: 'clientmail',
					replacement: 'xx<%= projectName %>'
				},
				{
					match: 'clientmail',
					replacement: 'xx<%= projectName %>'
				},
				{
					match: 'clientmail',
					replacement: 'xx<%= projectName %>'
				},
				
			]
		},
		files: [
			{
				expand: true, 
				flatten: false, 
				src: [
					'dev/php/includes/gravityforms-contactform.xml',
					'dev/php/templates/functions.php'
				
				], 
			}
		]
	}
};
