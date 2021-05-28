<div id="inner-left">
    <div id="message-tab">
        <div id="message-holder" class="message-holder">
            <div class="message message-left">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text"> CCSS này là gì ?
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                </div> 
            </div>
            <div class="message message-right">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text">This CSS should give me the exact(100%) dimensions of the viewport. But it is apparently too large because it's causing an overflow on the page.
                        It is not padding, margin, or outline because I removed all of that.
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                    <span></span>
                </div> 
            </div>
            <div class="message message-right">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text">This CSS should give me the exact(100%) dimensions of the viewport. But it is apparently too large because it's causing an overflow on the page.
                        It is not padding, margin, or outline because I removed all of that.
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                    <span></span>
                </div> 
            </div>
            <div class="message message-right">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text">This CSS should give me the exact(100%) dimensions of the viewport. But it is apparently too large because it's causing an overflow on the page.
                        It is not padding, margin, or outline because I removed all of that.
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                    <span></span>
                </div> 
            </div>
            <div class="message message-right">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text">This CSS should give me the exact(100%) dimensions of the viewport. But it is apparently too large because it's causing an overflow on the page.
                        It is not padding, margin, or outline because I removed all of that.
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                    <span></span>
                </div> 
            </div>
            <div class="message message-right">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text">This CSS should give me the exact(100%) dimensions of the viewport. But it is apparently too large because it's causing an overflow on the page.
                        It is not padding, margin, or outline because I removed all of that.
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                    <span></span>
                </div> 
            </div>
            <div class="message message-right">
                <div class="message-info">
                    <img class="message-img" src="public/image/male.jpg" alt="">
                    <p class="message-user-name">Phú</p>
                </div>
                <div class="message-content">
                    <p class="message-text">This CSS should give me the exact(100%) dimensions of the viewport. But it is apparently too large because it's causing an overflow on the page.
                        It is not padding, margin, or outline because I removed all of that.
                    </p>
                    <p class="message-time">10 giờ 19/10</p>
                    <i class="fas fa-trash-alt message-delete"></i>
                    <span></span>
                </div> 
            </div>
        </div>
        <div class="message-control">
            <i class="message-control__image fas fa-images"></i>
            <form class="message-form">
                <input id="message-input" class="message-input" name="message-input" type="text" placeholder="Nhập nội dung tin nhắn">
                <input id="message-submit" type="submit" value="Gửi">
            </form>
        </div>
    </div>
</div>
<div id="inner-right">
    <div id="friend-holder" class="friend-holder friend-holder--column">
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
        <div id="<?php echo $value['email']?>" class="friend-profile">
            <img class="friend-img" src="<?php echo $value['image']?>" alt="Avatar">
            <h5 class="friend-name"><?php echo $value['userName']?></h5>
            <p class="friend-email"><?php echo $value['email']?></p>
        </div>
        <div id="<?php echo $value['email']?>" class="friend-profile">
            <img class="friend-img" src="<?php echo $value['image']?>" alt="Avatar">
            <h5 class="friend-name"><?php echo $value['userName']?></h5>
            <p class="friend-email"><?php echo $value['email']?></p>
        </div>
        <div id="<?php echo $value['email']?>" class="friend-profile">
            <img class="friend-img" src="<?php echo $value['image']?>" alt="Avatar">
            <h5 class="friend-name"><?php echo $value['userName']?></h5>
            <p class="friend-email"><?php echo $value['email']?></p>
        </div>
        <div id="<?php echo $value['email']?>" class="friend-profile">
            <img class="friend-img" src="<?php echo $value['image']?>" alt="Avatar">
            <h5 class="friend-name"><?php echo $value['userName']?></h5>
            <p class="friend-email"><?php echo $value['email']?></p>
        </div>
    </div>
</div>