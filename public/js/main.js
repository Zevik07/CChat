//JS thực thi khi vừa load xong trang
$(document).ready(
    function(){
        /*Sự kiện cho các nút điều khiển chính*/
        function showChat(){
            $('#inner-left').css('display','block');
            $('#friend-holder').addClass('friend-holder--column');

            $('#friend-holder').addClass('friend-holder--column');
            $('#friend-holder').find('.request-denie').css('display','none');

            $('#friend-manager').css('display','none');
            $('#friend-request').css('display','none');
        }
        function showFriend(){
            $('#inner-left').css('display','none');

            $('#friend-holder').removeClass('friend-holder--column');
            $('#friend-holder').find('.request-denie').css('display','block');

            $('#friend-manager').css('display','flex');
            $('#friend-request').css('display','block');
        }
        //showFriend();
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
                            $('#message-holder').html('<p class="message-holder-status">Nhắn gì đó với '+EmailCurrentFriend+'</p>');
                            showChat();
                            refeshChat();
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
            },2000)
            
        }
        //send mesg
        $("#message-form").submit(
            function(e) {
                e.preventDefault();
                MsgText = $('#message-input').val();
                //Xóa status "Nhắn gì đó với "
                $('.message-holder-status').remove();   
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
                                    $('#message-holder').animate({ scrollTop: $('#message-holder').prop("scrollHeight")}, 1000);
                                    $('#message-input').val('');
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
        )


        //accept kết bạn
        $('.request-accept').click(
            function(){
                //Lấy id user đã chọn
                emailRequest = $(this).parent().parent().attr('id');
                
                //Gửi yêu cầu chấp nhận kết bạn
                $.ajax({
                    type:"POST",
                    url: './Home/addFriend',
                    data: {'emailRequest': emailRequest},
                    dataType: "JSON",
                    success:function(){
                        // let friendProfile = '<div id="'+friend.email+'" class="friend-profile">'+
                        //         '<img class="friend-img" src="'+friend.image+'" alt="Avatar">'+
                        //         '<h5 class="friend-name">'+friend.userName+'</h5>'+
                        //         '<p class="friend-email">'+friend.email+'</p>'+
                        //     '</div>';
                        // //Xoa request truoc
                        // $(`#${emailRequest}`).remove();
                        // //Thêm vào khung bạn
                        // $('#friend-holder').append(friendProfile); 
                        location.reload();
                    },
                    error: function(friend) {
                        alert('Lỗi gửi dữ liệu lên server');
                    }
                });
            }
        )
        //Hủy kết bạn hoặc hủy yêu cầu kết bạn
        $('.request-denie').click(
            function(){
                //Lấy id user đã chọn
                emailRequest = $(this).parent().parent().attr('id');
                //Phân biệt xem hủy bạn hay hủy yêu cầu
                classParent = $(this).parent().parent().attr('class');
                type = 'friend';
                if (classParent != 'friend-profile')
                {
                    type = 'request';
                }
                //Gửi yêu cầu chấp nhận kết bạn
                $.ajax({
                    type:"POST",
                    url: './Home/removeFriendRequest',
                    data: {'emailRequest': emailRequest, 'type': type},
                    dataType: "JSON",
                    success:function(){
                        location.reload();
                        if (feedback.status == 'error'){
                            alert(feedback.message);
                            return;
                        }
                        else{
                            window.location = window.location;
                        }
                        
                    },
                    error: function(friend) {
                        alert('Lỗi gửi dữ liệu lên server');
                    }
                });
            }
        )


        //Gửi lời mời kết bạn
        $('#requestFriendBtn').click(
            function(e){
                e.preventDefault();
                //Lấy id user đã chọn
                requestEmail= $('#requestFriendEmail').val();
                if (requestEmail == ''){
                    alert('Vui lòng nhập email cần kết bạn !');
                    return;
                }
                
                //Gửi yêu cầu chấp nhận kết bạn
                $.ajax({
                    type:"POST",
                    url: './Home/sendRequest',
                    data: {'emailRequest': requestEmail},
                    dataType: "JSON",
                    success:function(feedback){
                        // let friendProfile = '<div id="'+friend.email+'" class="friend-profile">'+
                        //         '<img class="friend-img" src="'+friend.image+'" alt="Avatar">'+
                        //         '<h5 class="friend-name">'+friend.userName+'</h5>'+
                        //         '<p class="friend-email">'+friend.email+'</p>'+
                        //     '</div>';
                        // //Xoa request truoc
                        // $(`#${emailRequest}`).remove();
                        // //Thêm vào khung bạn
                        // $('#friend-holder').append(friendProfile); 
                        if (feedback.status == 'error'){
                            alert(feedback.message);
                        }
                        else{
                            alert('Gửi lời mời thành công !');
                        }
                    },
                    error: function(friend) {
                        alert('Lỗi gửi dữ liệu lên server');
                    }
                });
            }
        )


        //Tạo nhóm
        $('#groupdBtn').click(
            function(e){
                e.preventDefault();
                //Lấy id user đã chọn
                groupName = $('#groupName').val();
                if (groupName.match(".*\\d.*") || groupName == ''){
                    alert('Tên không được chứa số hoặc để trống');
                    return;
                }
                //Gửi yêu cầu chấp nhận kết bạn
                $.ajax({
                    type:"POST",
                    url: './Home/createGroup',
                    data: {'groupName': groupName},
                    dataType: "JSON",
                    success:function(feedback){
                        if (feedback.status == 'error'){
                            alert(feedback.message);
                        }
                        else{
                            alert('Đã thêm nhóm thành công !');
                            window.location = window.location;
                        }
                    },
                    error: function(friend) {
                        alert('Lỗi gửi dữ liệu lên server');
                    }
                });
            }
        )
    }
)
