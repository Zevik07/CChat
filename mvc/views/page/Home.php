<div id="inner-left" style ="display:none">
    <div id="message-tab" >
        <div id='infoBox' class="infoBox" style = "display:none">  
            <h3 class="info-name"></h3>
            <div class="info-group" style="display:none">
                <p id="info-date" class="info-date">Ngay tao:</p>
                <p id="info-member" class="info-member"></p>
            </div>
            <button id="info-manager" class="info-manager"  style="display:none" type="button">Thêm</button>
        </div>
        <div id="message-holder" class="message-holder" currentFriendChat="">
            <div id="message-holder-status">
                <h3>Hãy chọn ai đó để trò chuyện</h3>
                <img src="public/image/status.gif" alt="">
            </div>
        </div>
        <div class="message-control">
            <i class="message-control__image fas fa-images"></i>
            <form id="message-form" class="message-form">
                <input id="message-input" class="message-input" name="message-input" type="text" placeholder="Nhập nội dung tin nhắn">
                <!-- <button type="button" id="message-add"> <i class="fas fa-user-plus"></i> </button> -->
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
                <div id="<?php echo $value['email'];?>" class="friend-profile" type="friend">
                    <img class="friend-img" src="<?php echo $value['image'];?>" alt="Avatar">
                    <h5 class="friend-name"><?php echo $value['userName'];?></h5>
                    <p class="friend-email">
                        <?php echo $value['email'];?>
                    </p>
                    <div class="request-control friend">
                        <span href="#" id="request-denie" class="request-denie"><i class="fas fa-window-close"></i></span>
                    </div>
                </div>
            <?php
                    }    
                }
            ?>

            <?php
                if (isset($data['Group'])){
                    $decodeGroup = json_decode($data['Group'],true);
                    foreach ($decodeGroup as $value){
            ?>
                <div id="<?php echo $value['groupId'];?>" type="group" class="friend-profile" dateCreate="<?php echo $value['groupDate'];?>" member="<?php echo $value['groupMember'];?>">
                    <img class="friend-img" src="<?php echo $value['groupImage'];?>" alt="Avatar">
                    <h5 class="friend-name"><?php echo $value['groupName'];?></h5>
                    <div class="request-control">
                        <span href="#" id="request-denie" class="request-denie"><i class="fas fa-window-close"></i></span>
                    </div>
                </div>
            <?php
                    }    
                }
            ?>

        </div>
        <div id="friend-manager" class="friend-manager">
            <form class="friend-add">
                <input id="requestFriendEmail" type="text" placeholder="Nhập email người bạn muốn kết bạn">
                <input id="requestFriendBtn" type="submit" value = "Gửi lời mời">
            </form>
            <i class="fas fa-users"></i> 
            <form class="group-add">
                <input id="groupName" type="text" placeholder="Nhập tên nhóm cần tạo">
                <input id="groupBtn" type="submit" value = "Tạo">
            </form>
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