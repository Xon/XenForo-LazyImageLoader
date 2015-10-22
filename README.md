XenForo-LazyImageLoader
======================

Provides lazy loaded image support via the Unveil.

A zero query method for per user-group lazy loading of the [img] and [attach] tags in threads and conversations with adjustable distance before images are loaded.

Uses a noscript tag around the original img tag.

Supports:
- Attachments, and images.
- '[Tinhte] Image Attachment Optimization & CDN Support' add-on

#Permissions

Adds the permission:
- Enable Lazy Load Images
For "Forum Permissions" and "Conversation Permissions" sections.



#Options

"Enable Outside threads/conversations" permits the lazy loading bbcode injection to run outside of those contexts. Inside those context it will still respect permissions.
May still not work for all cases outside threads/conversations.

"Force Lazy Loaded Spoiler" forces lazy loading for the contents of a spoiler tag even if permissions disable lazy loading.

#Known issues:

- Doesn't work with XenForo Media Gallery.
- Doesn't work with Resource Manager.
- May impact SEO due to the use of noscript to present the original image to users without scripting.
- Loading spinner is ugly, and not per style.


Unveil is MIT Licensed, as of 2015-01. 
Original source is https://github.com/luis-almeida/unveil
This project uses: https://github.com/Xon/unveil

loader.gif sourced from: http://www.ajaxload.info/ licensed under http://www.wtfpl.net/
