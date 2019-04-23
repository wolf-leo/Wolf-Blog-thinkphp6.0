/***************************************************************** 
 * @file 			index.js
 * @description 	缂╃暐鍥惧脊鍑烘斁澶у乏鍙虫粦鍔ㄨ疆鎾璊S鎻掍欢(鏀寔H5鍙奝C)
 * @author 			zonda
 * @date 			2016-05-16
 * @license 		share
 * @version 		1.0.20160516
 *****************************************************************/

(function () {
    /* Private variables */
    var overlay = $('<div id="galleryOverlay">'),
      photoNum = $('<div class="photoNum"><span class="currentNum js-currentNum"></span><span class="sumNum js-sumNum"></span></div>'),
      slider = $('<div id="gallerySlider">'),
      prevArrow = $('<a id="prevArrow"></a>'),
      nextArrow = $('<a id="nextArrow"></a>'),
      photoThumbs = $('<div class="photo-thumbs"><ul></ul></div>'),
      overlayVisible = false;

    var defaults = {
        showIndex: false,
        showThumbs: false
    }


    /* Creating the plugin */

    $.fn.touchTouch = function (options) {
        options = options || {};
        var placeholders = $([]),
          thumbholders = $([]),
          showIndex = options.showIndex || defaults.showIndex,
          showThumbs = options.showThumbs || defaults.showThumbs,
          index = 0,
          items = this;

        // Appending the markup to the page
        overlay.hide().appendTo('body');
        slider.appendTo(overlay);

        // Creating a placeholder and thumbholders for each image
        items.each(function () {
            placeholders = placeholders.add($('<div class="placeholder">'));
            thumbholders = thumbholders.add($('<li class=""><a href="javascript:void(0);"><img src="' + $(this).attr('href') + '" /></a></li>'));
        });

        // Show index in the overlay page
        if (showIndex) {
            photoNum.appendTo(overlay);
            setSumPhotoNum(items);
        }

        // Add thumbholders to the overlay page
        if (showThumbs) {
            photoThumbs.find('ul').append(thumbholders);
            photoThumbs.find('li').on('click', function (e) {
                e.preventDefault();
                index = thumbholders.index(this);
                jumpTo(index);
            });
            photoThumbs.appendTo(overlay);
        }


        // Hide the gallery if the background is touched / clicked
        slider.append(placeholders).on('click', function (e) {
            if (!$(e.target).is('img')) {
                hideOverlay();
            }
        });

        // Listen for touch events on the body and check if they
        // originated in #gallerySlider img - the images in the slider.
        var startX;// original position
        $('body').on('touchstart', '#gallerySlider img', function (e) {
            console.log(e);
            var touch = e.originalEvent;
            startX = touch.changedTouches[0].pageX;

            slider.on('touchmove', function (e) {

                e.preventDefault();

                touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];

                if (touch.pageX - startX > 10) {
                    slider.off('touchmove');
                    showPrevious();
                } else if (touch.pageX - startX < -10) {
                    slider.off('touchmove');
                    showNext();
                }
            });

            // Return false to prevent image 
            // highlighting on Android
            return false;

        }).on('touchend', function (e) {
            slider.off('touchmove');
            // Hide the gallery if the images is touched / clicked, but not slide
            touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
            if (touch.pageX - startX == 0) {
                hideOverlay();
            }
        });

        // Listening for clicks on the thumbnails

        items.on('click', function (e) {
            e.preventDefault();

            // Find the position of this image
            // in the collection

            index = items.index(this);
            resetCurrentPhotoNum(index);
            setCurrentThumbsHighlight(index);
            showOverlay(index);
            showImage(index);

            // Preload the next image
            preload(index + 1);

            // Preload the previous
            preload(index - 1);

        });

        // If the browser does not have support 
        // for touch, display the arrows
        if (!("ontouchstart" in window)) {
            overlay.append(prevArrow).append(nextArrow);

            prevArrow.click(function (e) {
                e.preventDefault();
                showPrevious();
            });

            nextArrow.click(function (e) {
                e.preventDefault();
                showNext();
            });

            $('body').on('click', '#gallerySlider img', function (e) {
                e.preventDefault();
                hideOverlay();
            });
        }

        // Listen for arrow keys
        $(window).bind('keydown', function (e) {

            if (e.keyCode == 37) {
                showPrevious();
            } else if (e.keyCode == 39) {
                showNext();
            }

        });


        /* Private functions */
        function setSumPhotoNum(images) {
            // set the sum number of images
            if (images == null || images == '' || images.length == 0) {
                $('.js-sumNum').html('/0');
            } else {
                $('.js-sumNum').html('/' + images.length);
            }
        }

        function resetCurrentPhotoNum(index) {
            // set the current number of images
            $('.js-currentNum').html(index + 1);
            $('.photoNum').show();
            setTimeout(function () {
                $('.photoNum').hide();
            }, 2000);
        }

        function setCurrentThumbsHighlight(index) {
            // set the current thumbs highlight
            for (var i = 0; i < items.length; i++) {
                if (i == index) {
                    thumbholders.eq(index).addClass('active');
                } else {
                    setCurrentThumbsDisHighlight(i);
                }
            }
        }

        function setCurrentThumbsDisHighlight(index) {
            // set the current thumbs dishighlight
            thumbholders.eq(index).removeClass('active');
        }

        function showOverlay(index) {

            // If the overlay is already shown, exit
            if (overlayVisible) {
                return false;
            }

            // Show the overlay
            overlay.show();

            setTimeout(function () {
                // Trigger the opacity CSS transition
                overlay.addClass('visible');
            }, 100);

            // Move the slider to the correct image
            offsetSlider(index);

            // Raise the visible flag
            overlayVisible = true;
        }

        function hideOverlay() {
            // If the overlay is not shown, exit
            if (!overlayVisible) {
                return false;
            }

            // Hide the overlay
            overlay.hide().removeClass('visible');
            overlayVisible = false;
        }

        function offsetSlider(index) {
            // This will trigger a smooth css transition
            resetCurrentPhotoNum(index);
            slider.css('left', (-index * 100) + '%');
        }

        // Preload an image by its index in the items array
        function preload(index) {
            setTimeout(function () {
                showImage(index);
            }, 1000);
        }

        // Show image in the slider
        function showImage(index) {

            // If the index is outside the bonds of the array
            if (index < 0 || index >= items.length) {
                return false;
            }

            // Call the load function with the href attribute of the item
            loadImage(items.eq(index).attr('href'), function () {
                placeholders.eq(index).html(this);
            });
        }

        // Load the image and execute a callback function.
        // Returns a jQuery object

        function loadImage(src, callback) {
            var img = $('<img>').on('load', function () {
                callback.call(img);
            });

            img.attr('src', src);
        }

        function showNext() {

            // If this is not the last image
            if (index + 1 < items.length) {
                index++;
                offsetSlider(index);
                preload(index + 1);
                setCurrentThumbsHighlight(index);
            } else {
                // Trigger the spring animation

                slider.addClass('rightSpring');
                setTimeout(function () {
                    slider.removeClass('rightSpring');
                }, 500);
            }
        }

        function showPrevious() {

            // If this is not the first image
            if (index > 0) {
                index--;
                offsetSlider(index);
                preload(index - 1);
                setCurrentThumbsHighlight(index);
            } else {
                // Trigger the spring animation

                slider.addClass('leftSpring');
                setTimeout(function () {
                    slider.removeClass('leftSpring');
                }, 500);
            }
        }

        function jumpTo(index) {

            resetCurrentPhotoNum(index);
            setCurrentThumbsHighlight(index);
            showImage(index);

            // Preload the next image
            preload(index + 1);

            // Preload the previous
            preload(index - 1);
            offsetSlider(index);
        }
    };

})(jQuery);
