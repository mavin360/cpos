
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" >
    <title>Cloud Pos</title>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->request->getAttribute("webroot"); ?>css/kitchen-style.css">
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="main-container">
      <ul class="grid-list" id="Completed-list"  style="display: none;">
        <li>
          <div class="head-sec">
            <div class="left-sec">Walkin <span>4</span></div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <h3><span class="num">1</span><span class="title">superbiotic</span></h3>
            <ul class="menu-list">
              <li><span>Crust: Gluten Free</span></li>
              <li><span>Size: Medium</span></li>
              <li><span>- Tomato Sauce (Full)</span></li>
              <li><span>+ BBQ Sauce (Full)</span></li>
              <li><span>+ Feta (Full)</span></li>
            </ul>
          </div>
          <div class="footer-sec">
            <div class="item-progress">--#149441 continued--</div>
          </div>
        </li>
        <li>
          <div class="head-sec">
            <div class="left-sec">continuation</div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <ul class="menu-list">
              <li><span>+ Beef Sausage (Add Extra) (Full)</span></li>
              <li><span>+ Chicken (Add Extra) (Full)</span></li>
            </ul>
            <h3><span class="num">2</span><span class="title">green apple &amp; feta salad</span></h3>
            <ul class="menu-list">
              <li><span>+ Balsamic &amp; Basil Sauce</span></li>
              <li><span>+ Rocket Leaves (Add Extra)</span></li>
              <li><span>+ Cucumber (Add Extra)</span></li>
            </ul>
          </div>
          <div class="footer-sec">
            <div class="item-progress">--#149441 continued--</div>
          </div>
        </li>
        <li>
          <div class="head-sec">
            <div class="left-sec">continuation</div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <h3><span class="num">2</span><span class="title">diet pepsi</span></h3>
            <h3><span class="num">3</span><span class="title">sun blast orange</span></h3>
          </div>
          <div class="footer-sec">
            <div class="left-sec">07:17:52</div>
            <!--<div class="right-sec"><a href="javascript:void(0)">Ready</a> <a href="javascript:void(0)">Collected?</a></div>-->
          </div>
        </li>
      </ul>
      <ul class="grid-list" id="Current-list">
        <li>
          <div class="head-sec">
            <div class="left-sec">continuation</div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <h3><span class="num">1</span><span class="title">superbiotic</span></h3>
            <ul class="menu-list">
              <li><span>Crust: Gluten Free</span></li>
              <li><span>Size: Medium</span></li>
              <li><span>- Tomato Sauce (Full)</span></li>
              <li><span>+ BBQ Sauce (Full)</span></li>
              <li><span>+ Feta (Full)</span></li>
            </ul>
          </div>
          <div class="footer-sec">
            <div class="item-progress">--#149441 continued--</div>
          </div>
        </li>
        <li>
          <div class="head-sec">
            <div class="left-sec">continuation</div>
            <div class="right-sec">#149441</div>
          </div>
          <div class="body-sec">
            <span class="order-no">1</span>
            <ul class="menu-list">
              <li><span>+ Beef Sausage (Add Extra) (Full)</span></li>
              <li><span>+ Chicken (Add Extra) (Full)</span></li>
            </ul>
            <h3><span class="num">2</span><span class="title">diet pepsi</span></h3>
            <h3><span class="num">3</span><span class="title">sun blast orange</span></h3>
          </div>
          <div class="footer-sec">
            <div class="left-sec">07:17:52</div>
            <div class="right-sec"><a href="javascript:void(0)">Ready</a> <a href="javascript:void(0)">Collected?</a></div>
          </div>
        </li>
      </ul>
    </div>
    <footer>
      <span>Dispatch Screen</span>
      <!--<span class="order-no">Order1</span>-->
      <ul>
        <li><a href="javascript:void();" onclick="fullscreen()"><i class="fa fa fa-arrows-alt"></i></a></li>
        <li><a href="javascript:void();" class="tab" id="Completed">Completed Order</a></li>
        <li><a href="javascript:void();" class="tab active" id="Current">Current Order</a></li>
        <li><a href="javascript:void();"><i class="fa fa fa-chevron-left"></i> Prev</a></li>
        <li><a href="javascript:void();">next <i class="fa fa fa-chevron-right"></i></a></li>
      </ul>
    </footer>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
      $("#Completed").on('click', function() {
   $("#Completed-list").fadeIn();
   $("#Current-list").fadeOut();
   $("#Current").removeClass('active');
   $("#Completed").addClass('active');
});
$("#Current").on('click', function() {
   $("#Current-list").fadeIn();
   $("#Completed-list").fadeOut();
   $("#Completed").removeClass('active');
   $("#Current").addClass('active');
});
});
      function fullscreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
  }
    </script>
  </body>
</html>