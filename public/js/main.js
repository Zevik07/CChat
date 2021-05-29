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
//Biến lưu thông tin user
userEmail = $('#user-email').val();
userName = $('#user-email').val();
// Biến lưu bạn đang chat hiện tại và id tin nhắn cuối cùng
EmailCurrentFriend = '';
lastMsgId = 0;
/*Sự kiện khi click vào bất kì liên hệ nào*/
$('.friend-profile').click(
    function(){
        //Lấy id user đã chọn
        EmailCurrentFriend = this.id;
        //Đánh dấu lại user đang chat
        $('#message-holder').html('');
        $('#message-holder').attr("currentFriendChat", EmailCurrentFriend);
        //Nhận tin nhắn
        $.ajax({
            type:"POST",
            url: './Home/getMessage',
            data: {'friendEmail':EmailCurrentFriend},
            dataType: "JSON",
            success:function(feedback){
                if (feedback == undefined || feedback == null || feedback.length == 0){
                    //Nếu không có tin nhắn
                    $('#message-holder').html('Nhắn gì đó với '+EmailCurrentFriend);
                    showChat();
                    return;
                }
                //Nếu có tin nhắn
                $.each(feedback, function(i, item) {
                    let msg = '<div id="'+item.id+'" class="message">'+
                                    '<div class="message-info">'+
                                        '<img class="message-img" src="'+item.image+'" alt="">'+
                                        '<p class="message-user-name">'+ item.userName +'</p>'+
                                    '</div>'+
                                    '<div class="message-content">'+
                                        '<p class="message-text">'+ item.message + '</p>'+
                                        '<p class="message-time">'+item.date+'</p>'+
                                        '<i class="fas fa-trash-alt message-delete"></i>'+
                                    '</div>'+
                                '</div>';
                    if (item.sender == EmailCurrentFriend){
                        $('#message-holder').append(msg); 
                        $('#message-holder').children().last().addClass('message-left');
                    }
                    else {
                        $('#message-holder').append(msg); 
                        $('#message-holder').children().last().addClass('message-right');
                    }
                    
                });
                //Cập nhật lại tin nhắn cuối cùng
                lastMsgId = $('#message-holder').children().last().attr('id');
                showChat();
                refeshChat();
            },
            error: function(feedback) {
                alert('Lỗi gửi dữ liệu lên server');
             }
        });
    }
)

//refresh chat
function refeshChat(){
    setInterval(function(){
        $.ajax({
            type:"POST",
            url: './Home/getMessageCurrent',
            data: {'friendEmail': EmailCurrentFriend, 'lastMessage': lastMsgId},
            dataType: "JSON",
            success:function(feedback){
                if (feedback == undefined || feedback == null || feedback.length == 0){
                    //alert(lastMsgId);
                    return;
                }
                $.each(feedback, function(i, item) {
                    let msg = '<div id="'+item.id+'" class="message">'+
                                    '<div class="message-info">'+
                                        '<img class="message-img" src="'+item.image+'" alt="">'+
                                        '<p class="message-user-name">'+ item.userName +'</p>'+
                                    '</div>'+
                                    '<div class="message-content">'+
                                        '<p class="message-text">'+ item.message + '</p>'+
                                        '<p class="message-time">'+item.date+'</p>'+
                                        '<i class="fas fa-trash-alt message-delete"></i>'+
                                    '</div>'+
                                '</div>';
                    if (item.sender == EmailCurrentFriend){
                        $('#message-holder').append(msg); 
                        $('#message-holder').children().last().addClass('message-left');
                    }
                    // else {
                    //     $('#message-holder').append(msg); 
                    //     $('#message-holder').children().last().addClass('message-right');
                    // }

                    //Cập nhật tin nhắn cuối
                    lastMsgId = parseInt(item.id);
                });
            },
            error: function(feedback) {
               
             }
        });
    },5000)
    
}

$("#message-form").validate({
    rules: {
        "message-input" : {
            required: true
        }
    },
    messages: {
        "message-input" : {
            required: 'Vui lòng nhập nội dung tin nhắn'
        }
    },
    submitHandler: function(form) {
        MsgText = $('#message-input').val();
        $.ajax({
            type:"POST",
            url: './Home/sendMessage',
            dataType: "JSON", 
            data: {'friendEmail': EmailCurrentFriend, 'MsgText': MsgText},
            success:function(feedback){
                if (feedback.status == 'success')
                {
                    lastMsgId = parseInt(lastMsgId) + 1;
                    let msg = '<div id="'+lastMsgId+'" class="message">'+
                                    '<div class="message-info">'+
                                        '<img class="message-img" src="empty" alt="">'+
                                        '<p class="message-user-name">'+userName+'</p>'+
                                    '</div>'+
                                    '<div class="message-content">'+
                                        '<p class="message-text">'+ MsgText + '</p>'+
                                        '<p class="message-time">'+ feedback.date +'</p>'+
                                        '<i class="fas fa-trash-alt message-delete"></i>'+
                                    '</div>'+
                                '</div>';
                            $('#message-holder').append(msg); 
                            $('#message-holder').children().last().addClass('message-right');
                }
                else{
                    alert(feedback.message);
                }
            },
            error: function(feedback) {
                alert('Lỗi gửi dữ liệu lên server');
             }
        });
    }
})