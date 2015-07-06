Slick Example Module
================================================================================
Provides samples for Optionsets, Image styles, Views blocks and a few supported
alters.

Please do not use this module for your works, instead use it to learn how to
make the most out of Slick module. This module will be updated at times to
reflect the best shot Slick can give, so it may not keep your particular use.


REQUIREMENTS
--------------------------------------------------------------------------------
- field_image, as available with Standard install.
- field_images, must be created before seeing this example useful immediately.
- node/3 containing field_images.

All requirements may be adjusted to available instances, see below.

To have various slick displays, recommended to put both "field_image" and
"field_images" at the same content type. This allows building nested slick or
asNavFor at its very basic usage. You can later use the pattern to build more
complex nested slick with video/audio via Media file fields or SCALD atom
reference when using with Field collection.

Shortly, you have to add, or adjust the fields manually if you need to learn
from this example.

Adjust the example references to images accordingly at the Views edit page.

See "admin/reports/fields" for the list of your fields.

The Slick example is just providing basic samples of the Slick usage:
- Several optionsets prefixed with "X" available at "admin/config/media/slick".
  You can clone what is needed, and make them disabled, or uninstalled later.

- Several view blocks available at "admin/structure/views".
  You can clone it to make it yours, and ajust anything accordingly.

- Several slick image styles at "admin/config/media/image-styles".
  You can re-create your own styles, and adjust the sample Views accordingly
  after cloning them.

You may want to edit the Views before usage, adjust possible broken settings:
admin/structure/views/view/slick_x/edit

The first block depends on node ID 3 which is expected to have "field_images":
admin/structure/views/view/slick_x/edit/block

If you don't have such node ID, adjust the filter criteria to match your site
node ID containing images.
If you don't have "field_images", simply change the broken reference into yours.

Slick grid set to have at least 10 visible images per slide to a total of 40.
Be sure to have at least 12 visible images/ nodes with image, or so to see the
grid work which results in at least 2 visible slides.

See slick_example.module for more exploration on available hooks.

And don't forget to uninstall this module at production. This only serves as
examples, no real usage, nor intended for production.
