(function ($) {
//This is so Bullshit :) need to remove

  const animationDuration = 300,
      $body = $('html');
  let prevPosition = window.pageYOffset;

  function getScrollbarWidth() {
    let div = document.createElement('div');

    div.style.overflowY = 'scroll';
    div.style.width = '50px';
    div.style.height = '50px';

    document.body.append(div);
    let scrollWidth = div.offsetWidth - div.clientWidth;

    div.remove();

    return (scrollWidth);
  }

  $(document).mousewheel(function (e1, delta1) {
    e1.preventDefault();

    const curPositionDelta = window.pageYOffset - prevPosition;

    prevPosition = window.pageYOffset;

    // window.requestAnimationFrame(function () {
    const wWidth = document.documentElement.clientWidth,
        wHeight = document.documentElement.clientHeight,
        scrollbarWidth = getScrollbarWidth(),
        slider = $('.dobroSlider')[0],
        sliderRect = slider.getBoundingClientRect(),
        sliderTop = sliderRect.y,
        sliderHeight = sliderRect.height,
        sliderWidth = slider.scrollWidth,
        sliderContainerWidth = slider.closest('.dobroSlider__container').clientWidth,
        approxHeightDelta = wHeight * 0.2,
        leftShift = wWidth * 0.05,
        sliderMiddle = sliderTop + (sliderHeight / 2),
        windowMiddle = wHeight / 2;

    if (
        sliderMiddle > windowMiddle - approxHeightDelta &&
        sliderMiddle < windowMiddle + approxHeightDelta &&
        (
            (curPositionDelta > 0 && parseInt($(slider).css('left')) !== sliderWidth - sliderContainerWidth) ||
            (curPositionDelta < 0 && parseInt($(slider).css('left')) !== 0)
        )
    ) {
      let deltaCounter = -parseInt($(slider).css('left')),
          animationInProgress = false;

      $body.addClass('noscroll').css('padding-right', scrollbarWidth);

      function changeSlider(e2, delta2) {
        e2.preventDefault();

        const $background = $(slider).find('.crazy-bg'),
            $foreground = $(slider).find('.crazy-bg:nth-child(2)');

        $(slider).stop();
        $background.stop();
        $foreground.stop();

        function updateSliderPos() {
          animationInProgress = true;
          $(slider).animate({'left': -deltaCounter}, animationDuration, function(){
            animationInProgress = false;
          });
          $background.css({'transform': 'rotate(' + -deltaCounter + 'deg)'}, animationDuration);
          $foreground.css({'transform': 'rotate(' + deltaCounter + 'deg)'}, animationDuration);
        }

        if (delta2 < 0) {
          if (deltaCounter < (sliderWidth - sliderContainerWidth - leftShift)) {
            deltaCounter += leftShift;
            updateSliderPos()
          } else {
            deltaCounter = sliderWidth - sliderContainerWidth;
            updateSliderPos()
            $body.removeClass('noscroll').css('padding-right', 0);
            $(document).off('mousewheel', changeSlider);
          }
        } else {
          if (deltaCounter > leftShift) {
            deltaCounter -= leftShift;
            updateSliderPos()
          } else {
            deltaCounter = 0;
            updateSliderPos()
            $body.removeClass('noscroll').css('padding-right', 0);
            $(document).off('mousewheel', changeSlider);
          }
        }
      }

      $(document).on('mousewheel', changeSlider);
    }
    // });

    return false;
  });

})(jQuery);
