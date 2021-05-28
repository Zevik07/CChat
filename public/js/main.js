/*Sự kiện cho các nút điều khiển chính*/
function showChat(){
    $('#inner-left').css('display','block');
    $('#friend-holder').addClass('friend-holder--column');
}
function showFriend(){
    $('#inner-left').css('display','none');
    $('#friend-holder').removeClass('friend-holder--column');
}
$('#user-menu__chat').click(
    function(){
        showChat();
    }
)
$('#user-menu__friend').click(
    function(){
        showFriend();
    }
)
$('#user-menu__logout').click(
    function(){
        window.location="./Login/Logout"
    }
)
/*Sự kiện khi click vào liên hệ*/
$('.friend-profile').click(
    function(){
        IdCurrentFriend = this.id;
        $.ajax({
            type:"POST",
            url: './Home/getMessage',
            data: {'friendEmail':IdCurrentFriend},
            //dataType: "JSON",
            success:function(feedback){
                alert(JSON.parse(feedback));
            },
            error: function(feedback) {
                alert('Lỗi gửi dữ liệu lên server');
             }
        });
    }
)

