$(document).ready(function(){
	
	
	
	var defaultSize = parseFloat($('body').css('fontSize'));
	var maxSize = defaultSize + 6;
	var minSize = defaultSize - 6;
	var wikiLinks = ["https://en.wikipedia.org/wiki/Service_Portfolio_(ITIL)","https://en.wikipedia.org/wiki/ITIL#Change_management","https://en.wikipedia.org/wiki/ITIL#Release_and_deployment_management","https://en.wikipedia.org/wiki/Event_Management_(ITIL)"];
	
	//inserts main switcher
	$('body').prepend(createSwitcher);
	
	//inserts subheader switchers - wiki links - back to top links - side panels - drop text links
	$("[id $= 'Management']").each(function(index){
		
		//insert drop text anchors
		$(this).after("<a href='#'>Show Less</a>");
		
		//retrieves the text of the first paragraph for each management div 
		var $sidePanel = $(this).children('p').eq(0).text();
		
		//reduces the width of the management divs
		var width = parseFloat($(this).width()) - 300 + "px";
		$(this).children().css({width:width});
		
		//creates wiki links, back to top links, subheader switchers, and side panels
		$(this).before("<hr>")
		.append(['<a id = "' + this.id + "-wikiLink-" + index + '" href = "',wikiLinks[index],'">',wikiLinks[index],'</a>'].join(""))
		.append("<br><a href = '#main'>Back to top</a><br>")
		.before(createSwitcher)
		.prepend('<div id = "'+this.id+'-sidePanel-'+index+'" class = "border right">'+$sidePanel+'</div>');
		
		
	});
	
	//drop text functionality
	//if an anchor readin gshow more or show less is clicked, the previous sibling element is either slided up or down and the anchor tag text is changed accordingly
	$('a[href="#"]').click(function(event){
		
		$(event.target).prev().slideToggle();
		
		if($(event.target).text() == "Show Less"){
			$(event.target).text("Show More");
		}else{
			$(event.target).text("Show Less");
		}
		return false;
	});
	
	//appends the footnotes section to the document body
	$('body').append("<hr><div id = 'footer'><h3 align = 'center'>Footnotes</h3><ol id = 'footnotes'></ol></div>")

	
	//moves any wiki links into the footnote's ordered list
	$('[id *= "wikiLink"]').each(function(){
		$(this).before("<a href = '#"+this.id+"'>To footnotes</a>").appendTo('#footnotes').wrap('<li></li>');
	});
	

	//create switchers
	function createSwitcher(){
		//alert(this.id);
		
		var size;
		var buttons;
	
		if($(this).is('body')){
			size = 3;
			//creates main document body switcher which modifies the text size for the entire docuement
			buttons = ["Increase-font-size","Decrease-font-size","Default-font-size"];
		}else{
			size = 2;
			//creates sub-heading switchers which highlight or unhighlight the contents of a sub-header
			buttons = ["Highlight-text","Unhighlight-text"];
		}
		
		//alert(buttons[0]);
 
		var element = "<div id = '" + this.id + "-switcher'>";
		//alert(element);
		for(var i = 0; i < size;++i){
			//alert(i);		
			element += "<button id = '" + this.id + "-button-" + buttons[i] + "'>" + buttons[i] + "</button>";
		}
		
		element += "</div>";
		//alert(element);
		return element;
		
	}
	
	//switcher functionality
	$('[id $= switcher] button').click(function(event){
		
			
			var parentID = event.target.id.split('-')[0];
			var font = parseFloat($('body').css('fontSize'));
			//alert(font);
			
			/*functionality more main body switcher
				modifies text size */
			if(parentID == "main"){
				
					if(event.target.id.indexOf("Increase-font-size") != -1 && !(font >= maxSize)){
						font += 2;
						//alert(font);
					}else if(event.target.id.indexOf("Decrease-font-size") != -1 && !(font <= minSize)){
						font -= 2;
					}else if(event.target.id.indexOf("Default-font-size") != -1){
						font = defaultSize;
					}
					$('body').animate({fontSize: font+"px"});
				
				
				
				//alert(event.target.id.indexOf("Increase-font-size"));
				
				
				
			/*functionality for sub-heading switcher
				highlights or unhighlights contents of sub-headers within the document*/
			}else{
				if(event.target.id.indexOf("Highlight-text") != -1){

					$(this).parent().next().addClass('subHeader');
				}else if(event.target.id.indexOf("Unhighlight-text") != -1){
					$(this).parent().next().removeClass('subHeader');
				}
			}
		
	});
	
	
	//stops event bubbling when an anchor tag is clicked
	$('a').click(function(event){		
		event.stopPropagation()	
	});
	

	//enhanced change management
	//turns the contents of the change management sub-header ed when the cursor hovers over it
	$('#body-changeManagement').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	});
	/*changes the contents of the change management subheader:
		to be either left or center aligned
		adds or removes a grey boorder
		changes the text to italic or times new roman
	when clicked by the cursor*/
	$("#body-changeManagement").toggle(function(){
			$(this).attr({align:"center"}).addClass('borderV2 italic');
	},function(){
			$(this).attr({align:"left"}).removeClass('borderV2 italic');
	});
	
	//enhanced event management capability
	//turns the contents of the event management sub-header ed when the cursor hovers over it
	$('#body-eventManagement').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	});
	/*changes the contents of the event management subheader:
		to be either left or center aligned
		adds or removes a grey boorder
		changes the text to italic or times new roman
	when clicked by the cursor*/
	$('#body-eventManagement').toggle(function(event){
			$(this).attr({align:"center"}).addClass('borderV2 italic');
	},function(){
			$(this).attr({align:"left"}).removeClass('borderV2 italic');
	});

});