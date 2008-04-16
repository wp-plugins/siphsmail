<?php

/*
Plugin Name: SiphsMail
Plugin URI: http://www.siphs.com/siphsmail.jsp
Description: Let visitors email your posts to others. A free siphs.com account also provides statistics regarding how viewers share your content.  Upgrade to customize these emails.
Version: 1.0
Author: Thomas Sharpton
Author URI: siphs.wordpress.com
*/

//CUSTOMIZE YOUR WIDGET HERE

//ADD THE WIDGET TO YOUR BLOG POST
//MUST ALSO HAVE EITHER TOP OR BOTTOM SET TO TRUE
define("ADDTOCONTENT", true);
//ADD WIDGET TO THE TOP OF YOUR POST BY SETTING THIS TO TRUE
define("ADDTOTOP", false);
//ADD WIDGET TO THE BOTTOM OF YOUR POST BY SETTING THIS TO TRUE
define("ADDTOBOTTOM", true);

//ADD THE WIDGET TO YOUR META SECTION
define("ADDTOMETA", false);

//DEFINE THE EMAIL-THIS IMAGE LINK
//default is https://www.siphs.com/images/siphsmail.png
define("LINKSOURCE",'https://www.siphs.com/images/siphs-email-badge.png');

//////////////////////////////////////////////////////////////////////////
//THIS CODE MAKES EVERYTHING WORK.  EDIT WITH CAUTION
//////////////////////////////////////////////////////////////////////////
function email_this($content) {
	$doit = false;
	$linksource = LINKSOURCE;
	//SET PERMALINK AND TITLE
	$perm = (get_permalink($post->ID));
	$title = the_title('','',FALSE);
	if (is_feed()) {
		$doit = false;
	}
	else if (ADDTOCONTENT) {
		$doit = true;
	}
	if ($doit && $type = "post") {
		$link = "<a href=\"#\" onclick=\"javascript:var txt='';if(window.getSelection){txt=window.getSelection();}else if(document.getSelection){txt = document.getSelection();} else if(document.selection){txt = document.selection.createRange().text;}else{txt='';}y='$perm';x='$title';window.open(encodeURI('http://www.siphs.com/processcontent?b=i&title=' + escape(x) + '&url=' + escape(y) + '&desc=' + escape(txt) + '&w=y')); return false;\">
					<img src=\"$linksource\">
		</a>";
		if(ADDTOTOP){
			$content = $link . $content;
		}
		if(ADDTOBOTTOM){
			$content = $content . $link;
		}
	}
	return $content;
}
function email_meta() {
	$linksource = LINKSOURCE;
         print ("<a href=\"#\" onclick=\"javascript:var txt='';if(window.getSelection){txt=window.getSelection();}else if(document.getSelection){txt = document.getSelection();} else if(document.selection){txt = document.selection.createRange().text;}else{txt='';}y=document.URL;x=document.title;window.open(encodeURI('http://www.siphs.com/processcontent?b=i&title='+escape(x)+'&url='+escape(y)+'&desc='+ escape(txt) + '&w=y')); return false;\">
			<img src=\"$linksource\">
		</a>");
}

//ADD THE BUTTON TO THE PAGE, IS DEPENDENT UPON VARIABLE SET IN THE HEADER
if(ADDTOCONTENT){
	add_action('the_content', 'email_this');
}
if(ADDTOMETA){
    add_action('wp_meta', 'email_meta');
}

?>