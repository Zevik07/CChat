<div id="inner-left" style ="display:none">
    <div id="message-tab" >
        <div id="message-holder" class="message-holder" currentFriendChat="">
            <p class="messag-holder-title">
                Chọn ai đó để trò chuyện
            </p> 
        </div>
        <div class="message-control">
            <i class="message-control__image fas fa-images"></i>
            <form id="message-form" class="message-form">
                <input id="message-input" class="message-input" name="message-input" type="text" placeholder="Nhập nội dung tin nhắn">
                <button type="button" id="message-add"> <i class="fas fa-user-plus"></i> </button>
                <input id="message-submit" type="submit" value="Gửi">
            </form>
           
        </div>
    </div>
</div>
<div id="inner-right">
    <div class="friend-box">
        <div id="friend-holder" class="friend-holder">
            <h3 class="friend-heading">Danh sách bạn bè và nhóm</h3>
            <?php
                if (isset($data['Friend'])){
                    $decodeFriend = json_decode($data['Friend'],true);
                    foreach ($decodeFriend as $value){
            ?>
                <div id="<?php echo $value['email'];?>" class="friend-profile">
                    <img class="friend-img" src="<?php echo $value['image'];?>" alt="Avatar">
                    <h5 class="friend-name"><?php echo $value['userName'];?></h5>
                    <p class="friend-email">
                        <?php echo $value['email'];?>
                    </p>
                </div>
            <?php
                    }    
                }
            ?>
        </div>
        <div id="friend-manager" class="friend-manager">
            <div class="friend-add">
                <input type="text" placeholder="Kết bạn với người bạn biết">
                <input type="button" value = "Gửi lời mời">
            </div>
            <i class="fas fa-users"></i> 
            <div class="group-add">
                <input type="text" placeholder="Nhập tên nhóm cần tạo">
                <input type="button" value = "Tạo">
            </div>
        </div>
    </div>
    <div id="friend-request" class="friend-request" >
        <h3 class="request-heading">
            Lời mời kết bạn
        </h3>
        <?php
            if (isset($data['Request'])){
                $decodeRequest = json_decode($data['Request'],true);
                foreach ($decodeRequest as $value){
        ?>
            <div id="<?php echo $value['email'];?>" class="request-profile">
                <img class="friend-img" src="<?php echo $value['image'];?>" alt="Avatar">
                <h5 class="friend-name"><?php echo $value['userName'];?></h5>
                <p class="friend-email">
                    <?php echo $value['email'];?>
                </p>
                <div class="request-control">
                    <span href="#" class="request-accept"><i class="fas fa-check-square"></i></span>
                    <span href="#" class="request-denie"><i class="fas fa-window-close"></i></span>
                </div>
            </div>
        <?php
                }    
            }
        ?>
    </div>
</div>