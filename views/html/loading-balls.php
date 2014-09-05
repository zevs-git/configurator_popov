<?php
$loadScript = <<<"LOADING"
        jQuery('#fountainG').hide();
        $(document).on('pjax:send', function(event) {
           jQuery('#fountainG').show();
        });
        $(document).on('pjax:complete', function(event) {
           jQuery('#fountainG').hide();
        });
LOADING;

$this->registerJs($loadScript);
?>


    <div class = 'loading-bals' id="fountainG">
        <div id="fountainG_1" class="fountainG">
        </div>
        <div id="fountainG_2" class="fountainG">
        </div>
        <div id="fountainG_3" class="fountainG">
        </div>
        <div id="fountainG_4" class="fountainG">
        </div>
        <div id="fountainG_5" class="fountainG">
        </div>
        <div id="fountainG_6" class="fountainG">
        </div>
        <div id="fountainG_7" class="fountainG">
        </div>
        <div id="fountainG_8" class="fountainG">
        </div>
    </div>
