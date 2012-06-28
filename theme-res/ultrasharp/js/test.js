(function() {  
	
	// CREATES THE PLUGIN
    tinymce.create('tinymce.plugins.quote', {  
	
        init : function(ed, url) { 
			
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mcequote', function() {
				
				ed.windowManager.open({
					
					file : url + '/window.php',
					width : 400 + ed.getLang('quote.delta_width', 0),
					height : 500 + ed.getLang('quote.delta_height', 0),
					inline : 1
					
				}, {
					
					plugin_url : url // Plugin absolute URL
					
				});
				
			}); 
		
			// Register example button
			ed.addButton('quote', {
				
				title : 'Add Button',
				cmd : 'mcequote',
				image : url + '/quote.png'
				
			});
		
        }
		 
    }); 
	 
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);  
	
})();  