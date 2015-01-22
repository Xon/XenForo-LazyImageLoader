XenForo-LazyImageLoader
======================

Provides lazy loaded image support via the Unveil.

A zero query method for per user-group lazy loading of the [img] and [attach] tags in threads and conversations with adjustable distance before images are loaded.

Uses a noscript tag around the original img tag.

Interacts a little wonky with the Spoiler tag, see known issues for details.

#Permissions

Adds the permission:
- Enable Lazy Load Images
For "Forum Permissions" and "Conversation Permissions" sections.



#Options

"Enable Outside threads/Conversations" permits the lazy loading bbcode injection to run outside of those contexts. Inside those context it will still respect permissions.

#Known issues:

- Interaction with the Spoiler tag means you need to move the viewport after opening the spoiler box before the lazy loader realises it should load those images.
- Doesn't work with XenForo Media Gallery.
- Requires "Enable Outside threads/Conversations" set to true to work with Resource Manager.
- May impact SEO due to the use of noscript to present the original image to users without scripting. Will display the spinner too.
- Loading spinner is ugly, and not per style.


Unveil is MIT Licensed, as of 2015-01. 
Original source is https://github.com/luis-almeida/unveil
This project uses: https://github.com/Xon/unveil

loader.gif sourced from: http://www.ajaxload.info/ licensed under http://www.wtfpl.net/
