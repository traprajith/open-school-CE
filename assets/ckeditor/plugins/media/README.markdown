# Installation

* download ckMedia archive (http://forge.clermont-universite.fr/attachments/download/64/media.zip)
* unzip it in CKEditor plugins folder
* download the last version of JW Player (http://www.longtailvideo.com/)
* unzip it in ckMedia folder
* customize pathes in the ckMedia's plugins.js
 <pre>
 player: CKEDITOR.basePath + 'plugins/media/mediaplayer-viral/player-viral.swf', 
 replacement: CKEDITOR.basePath + 'plugins/media/images/replacement.gif',
 swfobject: CKEDITOR.basePath + 'plugins/media/mediaplayer-viral/swfobject.js',
 yt: CKEDITOR.basePath + 'plugins/media/mediaplayer-viral/yt.swf',
 </pre>
 to match your installtion
* Add the ckMedia button to Basic toolbar
 <pre>
 CKEDITOR.config.toolbar_Basic = [ [ 'Source', '-', 'Bold', 'Italic', '-', 'Media' ] ];
 </pre>
* Enable the ckMedia plugin
 <pre>
 CKEDITOR.config.extraPlugins = 'Media';
 </pre>
* Enable the ckMedia context menu on replacement images
 <pre>
config.menu_groups = 'clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea,removeMedia';
 </pre>

# License MIT

## Bug fixes & new Features

2010/06/07

- compatibility for IE8 (still height problems for IE7)
- can enable Google Analytics plugin (http://www.longtailvideo.com/addons/plugins/107/Google-Analytics-Pro) and set a Google Account Id