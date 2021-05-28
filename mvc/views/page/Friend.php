<div id="inner-left" style="display:none">
</div>
<div id="inner-right">
    <div class="friend-holder">
        <?php
            if (isset($data['Friend'])){
                $decode = json_decode($data['Friend'],true);
                foreach ($decode as $value){
        ?>
        <div id="<?php echo $value['email']?>" class="friend-profile">
            <img class="friend-img" src="<?php echo $value['image']?>" alt="Avatar">
            <h5 class="friend-name"><?php echo $value['userName']?></h5>
            <p class="friend-email"><?php echo $value['email']?></p>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>