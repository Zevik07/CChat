<?php
    //Giai ma Json thanh du lieu ban dau
    if (isset($data['User']))
    {
        $decode = json_decode($data['User'], true);
    }
    $value = $decode;
    //foreach($decode as $value)
    //{
?>
<div class="user-info">
    <img id="user-image" class="user-image" src="<?php echo $value['image'];?>">
    <span id="user-name" class="user-name"><?php echo $value['userName'];?></span>
    <span id="user-email" class="user-email"><?php echo $value['email'];?></span>
    <ul id="user-menu" class="user-menu" >
        <li id="user-menu__chat"> Chat <i class="far fa-comments"></i></li>
        <li id="user-menu__friend"> Friend <i class="far fa-address-card"></i></li>
        <li id="user-menu__setting"> Settings <i class="fas fa-user-cog"></i></li>
        <li id="user-menu__logout"> Logout <i class="fas fa-sign-out-alt"></i></li>
    </ul>
</div>
<?php
   // }
?>