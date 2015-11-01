#XenForo-LazyImageLoader

Provides lazy loaded image support via the Lazysizes.

A zero query method for per user-group lazy loading of the [img] and [attach] tags in threads and conversations.


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
- Users without javascipt will not see any images.


Lazysizes  is MIT Licensed, as of 2015-11-01. 
Original source is https://github.com/aFarkas/lazysizes
