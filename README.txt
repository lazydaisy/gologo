
Customisation using custom theme settings
-----------------------------------------

The settings page for the GoLogo theme can be located by navigating to:

Administration > Site Administration > Appearance > Themes > GoLogo

There are not that many settings in GoLogo, as I like to keep my themes easy to use and work with.
Also I think it better that wherever has permissions to create a course and edit it can also have some flexibility on how it is styled.

You will already know nodoubt that Moodle themes are built using Twitter Bootstrap LESS/CSS/jQuery, which does give you quite a selection componants which are well documneted, and at your disposal. Thus making customisation of your Moodle site pretty much a new experience, but one which I hope you will also have fun.

Customisation using the HTML Editor in Moodle
---------------------------------------------

This is all the HTML you will need to add a Carousel slider to your Moodle site.
Here are some simple steps:

1.  Go to the Home page of your Moodle site and choose 'Frontpage settings' from the Administration block,
    and proceed to enable 'Site topics' if it is not already enabled.

2.  Save settings and return to your site Frontpage and 'Turn editing on'.

3.  Open the 'Site topic' area. You should see a small icon that looks like 'cog wheel'.

4.  Next find the section that says 'Copy and Paste...' lower down this page. Next copy and paste the Carousel HTML from the bottom of this page, to the HTML part of the Editor, and save it.
4.  Now switch back to normal view in your editor and you should see four place-holder images. By just selecting each image in turn with your mouse you can edit it by clicking on the Image icon in your editor. Here you can choose an image of your own to upload. Any size will work but do take into consideration the size of your site topic area especially if you have blocks.
5. After adding your images save your work and sit back and watch how it works.
6. Once you are familiar with the editing part of this you can add your own captioss.
7. Remember too that this is only a prototype and as such is very basic, but it does demonstrate what can be done with the minimum of fuss.

<!-- COPY AND PASTE THIS CODE TO YOUR SITE TOPIC OR COURSE TOPIC -->
<div id="myslider" class="carousel slide"><!-- class of slide for animation -->
<div class="carousel-inner">
<div class="item active"><!-- class of active since it's the first item --> <img class="img-responsive" src="http://placehold.it/1200x200" alt="" />
<div class="carousel-caption">
<p>First caption text here</p>
</div>
</div>
<div class="item"><img class="img-responsive" src="http://placehold.it/1200x200" alt="" />
<div class="carousel-caption">
<p>Second caption text here</p>
</div>
</div>
<div class="item"><img class="img-responsive" src="http://placehold.it/1200x200" alt="" />
<div class="carousel-caption">
<p>Third caption text here</p>
</div>
</div>
<div class="item"><img class="img-responsive" src="http://placehold.it/1200x200" alt="" />
<div class="carousel-caption">
<p>Fourth caption text here</p>
</div>
</div>
</div>
<!-- /.carousel-inner --> <!--  Next and Previous controls below
        href values must reference the id for this carousel --> <a class="carousel-control left" href="#myslider" data-slide="prev">‹</a> <a class="carousel-control right" href="#myslider" data-slide="next">›</a></div>
<!-- / END -->

Moodle documentation
--------------------

Further information can be found on Moodle Docs: https://docs.moodle.org/31/en/GoLogo
