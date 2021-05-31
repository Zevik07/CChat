//JS thực thi khi vừa load xong trang
$(document).ready(
    function(){
        /*Sự kiện cho các nút điều khiển chính*/
        function showChat(){
            $('#inner-left').css('display','block');
            $('#friend-holder').addClass('friend-holder--column');

            
            //$('#friend-holder').find('.request-denie').css('display','none');

            $('#friend-manager').css('display','none');
            $('#friend-request').css('display','none');
        }
        function showFriend(){
            $('#inner-left').css('display','none');

            $('#friend-holder').removeClass('friend-holder--column');
            //$('#friend-holder').find('.request-denie').css('display','block');

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
        userEmail = $('#user-email').text();
        userName = $('#user-name').text();
        // Biến lưu bạn đang chat hiện tại và id tin nhắn cuối cùng
        EmailCurrentFriend = '';
        lastMsgId = 0;
        nameCurrentChat = '';
        /*Sự kiện khi click vào bất kì bạn hoặc nhóm nào*/
        $('.friend-profile').on('click',
            function(e){
                //Lấy id user đã chọn
                dateCreate = $(this).attr('datecreate');
                member = $(this).attr('member');
                EmailCurrentFriend = this.id;
                nameCurrentChat = $(this).children('.friend-name').text();
                //Đánh dấu lại user đang chat
                $('#message-holder').html('');
                $('#message-holder').attr("currentFriendChat", EmailCurrentFriend);
                //Hiện bar thông tin
                $('#infoBox').css('display','flex');
                $('#infoBox .info-name').html(nameCurrentChat);
                $('#infoBox .info-group').css('display','none');
                $('#infoBox .info-manager').css('display','none');
                
                        //Nếu là nhóm
                        if (!EmailCurrentFriend.match(/@/))
                        {
                            $('#infoBox .info-manager').css('display','block');
                            $('#infoBox .info-group').css('display','flex');
                            $('#infoBox .info-group .info-date').html('Ngày tạo: '+dateCreate);
                            $('#infoBox .info-group .info-member').html('Thành viên: '+ member);
                        }
                //Nhận tin nhắn
                $.ajax({
                    type:"POST",
                    url: './Home/getMessage',
                    data: {'friendEmail':EmailCurrentFriend},
                    dataType: "JSON",
                    success:function(feedback){
                        if (feedback == undefined || feedback == null || feedback.length == 0){
                            //Nếu không có tin nhắn
                                //Nếu là nhóm 
                                $('#message-holder').html(
                                        '<div id="message-holder-status">'+
                                            '<h3>Hãy nhắn gì đó với '+nameCurrentChat+'</h3>' +
                                            '<img src="public/image/status.gif" alt="">' +
                                        '</div>');
                            
                            showChat();
                            refeshChat();
                            return;
                        }
                        //Nếu có tin nhắn
                        $.each(feedback, function(i, item) {
                            optionClass='';
                            if (item.msgDeleted == 1){
                                optionClass = 'message-deleted';
                                item.message = '---Tin nhắn này đã được xóa---';
                            }
                            let msg = '<div id="'+item.id+'" class="message">'+
                                            '<div class="message-info">'+
                                                '<img class="message-img" src="'+item.image+'" alt="">'+
                                                '<p class="message-user-name">'+ item.userName +'</p>'+
                                            '</div>'+
                                            '<div class="message-content">'+
                                                '<p class="'+optionClass+' message-text">'+ item.message + '</p>'+
                                                '<p class="message-time">'+item.date+'</p>'+
                                                '<i class="fas fa-trash-alt message-delete"></i>'+
                                            '</div>'+
                                        '</div>';
                            
                            if (item.sender == userEmail){
                                $('#message-holder').append(msg); 
                                $('#message-holder').children().last().addClass('message-right');
                                
                            }
                            else {
                                $('#message-holder').append(msg); 
                                $('#message-holder').children().last().addClass('message-left');
                                
                            }
                            
                            
                        });
                        setTimeout(function(){
                            $("#message-holder").animate({ scrollTop: $("#message-holder")[0].scrollHeight}, 1000)
                          }, 100);
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
                            let msg = '<div userSend="'+item.sender+'" id="'+item.id+'" class="message">'+
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
                            if (item.sender != userEmail)
                            {
                                $('#message-holder').append(msg); 
                                $('#message-holder').children().last().addClass('message-left');
                                $("#message-holder").animate({ scrollTop: $("#message-holder")[0].scrollHeight}, 1000);
                            }
                            // else {
                            //     $('#message-holder').append(msg); 
                            //     $('#message-holder').children().last().addClass('message-right');
                            // }
                            //$('#message-holder').animate({ scrollTop: $('#message-holder').prop("scrollHeight")}, 1000);
                            //Cập nhật tin nhắn cuối
                            lastMsgId = parseInt(item.id);
                        });
                        
                    },
                    error: function(feedback) {
                    
                    }
                });
            },2000)
            
        }
        //send message
        $("#message-form").submit(
            function(e) {
                e.preventDefault();
                MsgText = $('#message-input').val();
                //Xóa status "Nhắn gì đó với "
                $('#message-holder-status').remove();   
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
                                    $("#message-holder").animate({ scrollTop: $("#message-holder")[0].scrollHeight}, 1000);
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
        //Hủy kết bạn hoặc hủy yêu cầu kết bạn hoặc xóa nhóm
        $('.request-denie').click(
            function(e){
                e.stopPropagation();
                //Lấy id user hoặc nhóm đã chọn
                emailRequest = $(this).parent().parent().attr('id');
                //Phân biệt xem hủy bạn hay hủy yêu cầu
                classParent = $(this).parent().parent().attr('class');
                type = 'friend';
                if (classParent != 'friend-profile')
                {
                    type = 'request';
                }
                //Nếu là xóa nhóm
                if (!emailRequest.match(/@/))
                {
                    type = 'group';
                    alertTxt = confirm('Bạn sẽ rời nhóm nhưng các thành viên còn lại vẫn hoạt động, bạn chắc chứ ?')
                    if (alertTxt == false){
                        return;
                    }
                }
                if (type == 'friend'){
                    alertTxt = confirm('Bạn muốn hủy kết bạn với người này chứ ?')
                    if (alertTxt == false){
                        return;
                    }
                }
                //Gửi yêu cầu chấp nhận kết bạn
                $.ajax({
                    type:"POST",
                    url: './Home/removeFriendRequest',
                    data: {'emailRequest': emailRequest, 'type': type},
                    dataType: "JSON",
                    success:function(feedback){
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
        $('#requestFriendBtn').on('click',
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
        $('#groupBtn').click(
            function(e){
                e.preventDefault();
                //Lấy id group đã chọn
                groupName = $('#groupName').val();
                if (groupName.match(/^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/) || groupName == ''){
                    alert('Tên không được chứa ký tự đặc biệt hoặc để trống');
                    return;
                }
                //Gửi yêu cầu tạo
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
                    error: function() {
                        alert('Lỗi gửi dữ liệu lên server');
                    }
                });
            }
        )


        //Thêm thành viên vào nhóm
        $('#info-manager').on("click",
            function(e){
                if ($(this).text() == 'Xong'){
                    $(this).text('Thêm thành viên');
                    //Hiện tích thêm vào
                    $('#friend-holder [type="friend"] .add-member').remove();
                    return;
                }
                $(this).text('Xong');
                //Hiện tích thêm vào
                $('#friend-holder [type="friend"]').append(
                    '<span href="#" class="add-member"><i class="fas fa-user-plus"></i></span>'    
                );
                //Khi click vào nút thêm
                $('.add-member').click(
                    function(e){
                        e.stopPropagation();
                        //Lấy id của người được thêm
                        idFriend = $(this).parent().attr("id");
                        member =  $('#info-member').text();
                        index = $('#info-member').text().indexOf(idFriend);
                        //Nếu member đã tồn tại
                        if(index>=0){
                            alert('Người này đã ở trong nhóm');
                        }
                        else{
                            $.ajax({
                                type:"POST",
                                url: './Home/addMember',
                                data: {'groupId': EmailCurrentFriend, 'friendId': idFriend},
                                dataType: "JSON",
                                success:function(feedback){
                                    if (feedback.status == 'error'){
                                        alert(feedback.message);
                                    }
                                    else{
                                        $('#info-member').text(member+','+idFriend);
                                        $('#info-manager').text('Thêm thành viên');
                                        //Hiện tích thêm vào
                                        $('#friend-holder [type="friend"] .add-member').remove();
                                    }
                                },
                                error: function() {
                                    alert('Lỗi gửi dữ liệu lên server');
                                }
                            });
                        }
                    }
                ) 
            }
        )


        //Xoa tin nhan
        $('#message-holder').delegate('.message .message-content .message-delete','click',
            function deleteMessage(e){
                let alertText = confirm('Bạn muốn xóa tin nhắn này chứ ?');
               
                msgId = $(this).parent().parent().attr('id');
                if (alertText == false){
                    return;
                }
                $.ajax({
                    type:"POST",
                    url: './Home/deleteMessage',
                    data: {'msgId': msgId},
                    dataType: "JSON",
                    success:function(feedback){
                        if (feedback.status == 'error'){
                            alert(feedback.message);
                        }
                        else{
                            $('#'+msgId+' .message-content .message-text').html('---Tin nhắn này đã được xóa---');
                            $('#'+msgId+' .message-content .message-text').addClass('message-deleted');
                        }
                    },
                    error: function() {
                        alert('Lỗi gửi dữ liệu lên server');
                    }
                });
            }
        )


        
    }
)
